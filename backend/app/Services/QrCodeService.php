<?php

namespace App\Services;

use App\Models\QrCodes;
use App\Models\User;
use App\Models\Urls;
use App\Services\Interfaces\IQrCodeService;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use ErrorException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;

class QrCodeService implements IQrCodeService
{
    protected User $user;
    protected QrCodes $qrCode;

    public function __construct(User $user, QrCodes $qrCode) {
        $this->user = $user;
        $this->qrCode = $qrCode;
    }

    public function generateQrCode(string $url) 
    {
        try
        {
            $urlCode = explode("=", $url);
            
            $urlDb = Urls::where('short_url', $urlCode[1])
            ->where('user_id', 1)->firstOrFail();
            

            if(isset($urlDb))
            {
                $qrCodeDb = self::findQrCode($urlDb['id'], 1);
                
                if(!isset($qrCodeDb))
                {
                    $svg = self::svgQrCode("http://localhost:90/api/?uri=".$url);
                    $svgName = self::saveDirectorySvg($svg);
                    
                    $this->qrCode->create([
                        'dir_code' => $svgName,
                        'url_id' => $urlDb['id'],
                        'user_id' => 1
                    ])->save();
    
                    return $svg;
                }
                else
                {
                    return Storage::get($qrCodeDb['dir_code']);
                }
            }
            return "Ocorreu um erro ao ler a URL!";
        }
        catch (QueryException $e)
        {
            return "Erro na consulta ao banco: ".$e->getMessage();
        }
        catch(ErrorException $e)
        {
            return "Algo deu errado: ".$e->getMessage();
        }
    }

    private static function svgQrCode(string $url)
    {
        $renderer = new ImageRenderer(
            new RendererStyle(400),
            new SvgImageBackEnd()
        );
        $writer = new Writer($renderer);
        return $writer->writeString($url);
    }

    private static function saveDirectorySvg($svg)
    {
        $svgName = uniqid().'_qrCode.svg';

        Storage::disk('local')->put($svgName, $svg);

        return $svgName;
    }

    private static function findQrCode($url_id, $user_id)
    {
        try
        {
            return QrCodes::where('url_id', $url_id)
                ->where('user_id', $user_id)->firstOrFail();
        }
        catch(ModelNotFoundException $e)
        {
            return null;
        }
    } 
}