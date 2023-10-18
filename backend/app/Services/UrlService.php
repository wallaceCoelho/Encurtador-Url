<?php

namespace App\Services;

use App\Models\Urls;
use App\Models\User;
use App\Services\Interfaces\IUrlService;
use ErrorException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class UrlService implements IUrlService
{
    protected Urls $url;
    protected $userId;

    public function __construct(Urls $url) {
        $user = auth()->user();
        $this->url = $url;
        $this->userId = $user['id'];
    }

    public function redirect(string $url) : string
    {
        try
        {
            $urlDb = $this->url->where('short_url', $url)
            ->where('user_id', $this->userId)->firstOrFail();
            
            return $urlDb['url'];
        }
        catch(ModelNotFoundException $e)
        {
            return "Erro: ".$e->getMessage();
        }
    }

    public function compactUrl(string $longUrl) : array
    {   
        try
        {
            $urlDb = $this->url->where('url', $longUrl)
                ->where('user_id', $this->userId)->first();
            
            if(isset($urlDb))
            {
                return ([
                    'long_url' => $urlDb['url'],
                    'short_url' => "http://localhost:90/api/?uri=".$urlDb['short_url']
                ]);   
            }

            $urlCode = self::generateRandonCode();
            
            $this->url->create([
                'url' => $longUrl,
                'short_url' => $urlCode,
                'user_id' => 1
            ])->save();
            
            return ([
                'long_url' => $longUrl,
                'short_url' => "http://localhost:90/api/?uri=".$urlCode
            ]);
        }
        catch (QueryException $e)
        {
            return ([
                'long_url' => $e->getMessage(),
                'short_url' => $e->getMessage(),
            ]);
        }
        catch(ErrorException $e)
        {
            return ([
                'long_url' => $e->getMessage(),
                'short_url' => $e->getMessage(),
            ]);
        }
    }

    public function getAllUrls() : array
    {
        try
        {
            return auth()->check() ? array($this->url->where('user_id', $this->userId)->get()) : [];
        }
        catch(ModelNotFoundException $e)
        {
            return (['error' => 'ERRO: '. $e->getMessage()]);
        }
        catch(ErrorException $e)
        {
            return (['error' => 'ERRO: '. $e->getMessage()]);
        }
    }

    private static function generateRandonCode(int $length = 6) : string
    {
        $char = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code = '';
        for ($i = 0; $i < $length; $i++) {
            $code .= $char[rand(0, strlen($char) - 1)];
        }
        return $code;
    }
}