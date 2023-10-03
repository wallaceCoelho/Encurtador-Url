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
    protected User $user;
    protected Urls $url;

    public function __construct(User $user, Urls $url) {
        $this->user = $user;
        $this->url = $url;
    }

    public function redirect(string $url) : string
    {
        try
        {
            $urlDb = Urls::where('short_url', $url)
            ->where('user_id', 1)->firstOrFail();
            
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
            $urlDb = Urls::where('url', $longUrl)
                ->where('user_id', 1)->first();
            
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