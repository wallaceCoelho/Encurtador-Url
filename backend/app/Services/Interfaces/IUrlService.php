<?php

namespace App\Services\Interfaces;

interface IUrlService
{
    public function redirect(string $url) : string;

    public function compactUrl(string $url) : array;

    public function getAllUrls() : array;
}