<?php

namespace App\Services\Base;

use App\Models\QrCodes;
use App\Models\Urls;
use App\Models\User;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ServiceBase
{
    protected Urls $url;
    protected User $user;
    protected $userId;
    protected $urlId;

    public function __construct(User $user, Urls $url) {
        $auth = auth()->user();
        $this->userId = $auth['id'];

        $this->url = $url;
        $this->user = $user;
    }

    //URL HELPERS
    public function createCode(string $longUrl) : array
    {
        $urlDb = $this->url->where('url', $longUrl)
            ->where('user_id', $this->userId)->first();

        if(isset($urlDb))
        {
            return ([
                'long_url' => $urlDb['url'],
                'short_url' => $urlDb['short_url']
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
    
    public function firstUrl(int $id) : array
    {
        $this->urlId = $id;
        $res = $this->url->join('qr_codes', function ($join) {
            $join->on('urls.id', '=', 'qr_codes.url_id')
                    ->where('urls.user_id', '=', $this->userId)
                    ->where('urls.id', '=', $this->urlId);
        })
        ->select('urls.*', 'qr_codes.dir_code')
        ->first();

        return $res ? [
            'id' => $res['id'],
            'url' => $res['url'],
            'short_url' => $res['short_url'],
            'code' => Storage::get($res['dir_code'])
        ] : [];
    }

    public function listUrl() : array
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
                'id' => $item->id,
                'url' => $item->url,
                'short_url' => $item->short_url,
                'code' => Storage::get($item->dir_code)
            ];
            $count++;
        }

        return $response;
    }

    public static function generateRandonCode(int $length = 6) : string
    {
        $char = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code = '';
        for ($i = 0; $i < $length; $i++) {
            $code .= $char[rand(0, strlen($char) - 1)];
        }
        return $code;
    }

    //QR CODE HELPERS
    public function storeQrCode($urlDb, $url)
    {
        $qrCodeDb = self::findQrCode($urlDb);

        if(!isset($qrCodeDb))
        {
            $svg = self::svgQrCode($url);
            $svgName = self::saveDirectorySvg($svg);
            
            QrCodes::create([
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

    public static function svgQrCode(string $url)
    {
        $renderer = new ImageRenderer(
            new RendererStyle(400),
            new SvgImageBackEnd()
        );
        $writer = new Writer($renderer);
        return $writer->writeString($url);
    }

    public static function saveDirectorySvg($svg)
    {
        $svgName = uniqid().'_qrCode.svg';

        Storage::disk('local')->put($svgName, $svg);

        return $svgName;
    }

    public function findQrCode($urlId)
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


    //USER HELPERS
    public function storeUser(array $request) : bool
    {
        $userExists = $this->user->where('email', $request['email'])->first();

        if(!isset($userExists))
        {
            $this->user->create([
                'name' => $request['name'],
                'email' => $request['email'],
                'nickname' => $request['nickname'],
                'active' => $request['active'],
                'password' => Hash::make($request['password'])
            ])->save();
            return true;
        }
        return false;
    }
}