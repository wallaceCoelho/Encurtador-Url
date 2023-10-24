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
    protected $userId;

    public function __construct(User $user, QrCodes $qrCode) {
        $auth = auth()->user();
        $this->userId = $auth['id'];

        $this->user = $user;
        $this->qrCode = $qrCode;
    }

    public function generateQrCode(string $url) 
    {
        try
        {
            $urlDb = Urls::where('short_url', $url)
            ->where('user_id', $this->userId)->first();
            
            return isset($urlDb) ? self::storeQrCode( $urlDb['id'], $url) :
                "Ocorreu um erro ao ler a URL!";
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

    private function storeQrCode($urlDb, $url)
    {
        $qrCodeDb = self::findQrCode($urlDb);

        if(!isset($qrCodeDb))
        {
            $svg = self::svgQrCode($url);
            $svgName = self::saveDirectorySvg($svg);
            
            $this->qrCode->create([
                'dir_code' => $svgName,
                'url_id' => $urlDb,
                'user_id' => $this->userId
            ])->save();
            return $svg;
        }
        else
        {
            return Storage::get($qrCodeDb['dir_code']);
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

    private function findQrCode($urlId)
    {
        try
        {
            return QrCodes::where('url_id', $urlId)
                ->where('user_id', $this->userId)->first();
        }
        catch(ModelNotFoundException $e)
        {
            return null;
        }
    } 
}