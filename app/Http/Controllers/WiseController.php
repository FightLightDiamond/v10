<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use JetBrains\PhpStorm\ArrayShape;

class WiseController extends Controller
{
    protected string $uri = 'https://api.sandbox.transferwise.tech';
    protected string $token = 'ddeedb14-c4e4-4293-bbf3-a9afa6288fc6';
    protected string $activeProfileId = '16969701';

    #[ArrayShape(['Authorization' => "string"])] protected function getHeader()
    {
        return [
            'Authorization' => "Bearer {$this->token}"
        ];
    }

    public function exec()
    {
        Http::withHeaders($this->getHeader())
            ->get();
    }

    public function getProfileUrl(): string
    {
        return "{$this->uri}/v2/profiles";
    }

    public function getCreateBatchGroupUrl(): string
    {
        return "{$this->uri}/v3/profiles/{$this->activeProfileId}/batch-groups";
    }

    public function getCreateBatchGroupBody(): array
    {
        return [
            "sourceCurrency" => "GBP",
            "name" => "Test Batch"
        ];
    }

    public function getCreateQuoteUrl(): string
    {
        return "{$this->uri}/v3/profiles/{$this->activeProfileId}/quotes";
    }

    public function getCreateQuoteBody(): array
    {
        return [
            "sourceCurrency" => "GBP",
            "targetCurrency" => "EUR",
            "sourceAmount" => 100,
            "targetAmount" => null
        ];
    }

    public function getLoadAccountUrl()
    {

    }
}
