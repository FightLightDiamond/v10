<?php


namespace App\Http\Services\Wise;


interface WiseInterface
{
    public function getMethod(): string;
//    public function getBody(): array;
//    public function getQuery(): array;
    public function get();
    public function post();
    public function http();
    public function getUrl();
    public function call();
}
