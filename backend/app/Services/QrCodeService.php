<?php

namespace App\Services;

use App\Models\Urls;
use App\Services\Base\ServiceBase;
use App\Services\Interfaces\IQrCodeService;
use ErrorException;
use Illuminate\Database\QueryException;

class QrCodeService extends ServiceBase implements IQrCodeService
{
    protected $userId;

    public function __construct() {
        $auth = auth()->user();
        $this->userId = $auth['id'];
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
}