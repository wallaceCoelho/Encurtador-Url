<?php

namespace App\Services\Interfaces;

interface IQrCodeService
{
    public function generateQrCode(string $url);
}