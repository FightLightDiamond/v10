<?php


namespace App\Http\Services\Wise;


interface WiseInterface
{
    public function getMethod();
    public function get();
    public function post();
    public function http();
    public function getUrl();
    public function call();
}
