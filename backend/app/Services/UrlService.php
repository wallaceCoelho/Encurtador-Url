<?php

namespace App\Services;

use App\Models\Urls;
use App\Models\User;
use App\Services\Interfaces\IUrlService;
use ErrorException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;

class UrlService implements IUrlService
{
    protected Urls $url;
    protected User $user;
    protected $userId;

    public function __construct(User $user, Urls $url) {
        $auth = auth()->user();
        $this->userId = $auth['id'];

        $this->url = $url;
        $this->user = $user;
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
            return self::createCode($longUrl);
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
            return auth()->check() ? self::listUrl() : [];
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

    private function createCode(string $longUrl) : array
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
            'short_url' => "http://localhost:90/api/?uri=".$urlCode,
            'user_id' => $this->userId
        ])->save();
        
        return ([
            'long_url' => $longUrl,
            'short_url' => "http://localhost:90/api/?uri=".$urlCode
        ]);
    }

    private function listUrl() : array
    {
        $response = [];
        $count = 0;

        $res = $this->url->join('qr_codes', function ($join) {
            $join->on('urls.id', '=', 'qr_codes.url_id')
                    ->where('urls.user_id', '=', $this->userId);
        })
        ->select('urls.*', 'qr_codes.dir_code')
        ->get();

        foreach($res as $item)
        {
            $response[$count] = [
                'url' => $item->url,
                'short_url' => $item->short_url,
                'code' => Storage::get($item->dir_code)
            ];
            $count++;
        }

        return $response;
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