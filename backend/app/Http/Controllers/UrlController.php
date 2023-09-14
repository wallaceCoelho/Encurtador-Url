<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\IQrCodeService;
use App\Services\Interfaces\IUrlService;
use Illuminate\Http\Request;

class UrlController extends Controller
{
    protected IUrlService $url;
    protected IQrCodeService $qrCode;

    public function __construct(IUrlService $url, IQrCodeService $qrCode) 
    {
        $this->url = $url;
        $this->qrCode = $qrCode;
    }

    public function redirectUrl(Request $request)
    {
        return $request->get('uri') != null ?  
            response()->json([
                header('Location: '.$this->url->redirect($request->get('uri')))
            ]) 
            :
            response()->json([
                'url' => "Url não encontrada!"
            ]);
    }

    public function shortUrl(Request $request)
    {
        $responseUrl = $this->url->compactUrl($request->get('data'));
        $responseQrCode = $this->qrCode->generateQrCode($responseUrl['short_url']);

        return response()->json([
            'long_url' => $responseUrl['long_url'],
            'short_url' => $responseUrl['short_url'],
            'qr_code' => $responseQrCode
        ], 200);
    }
}
