<?php


namespace App\Http\Services\Wise;


use Illuminate\Support\Facades\Http;
use JetBrains\PhpStorm\ArrayShape;

abstract class WiseAbstract implements WiseInterface
{
    protected string $host = 'https://api.sandbox.transferwise.tech';
    protected string $token = 'ddeedb14-c4e4-4293-bbf3-a9afa6288fc6';
    protected string $activeProfileId = '16969701';
    protected string $batchGroupId;
    protected string $batchVersionGroup;
    protected string $sourceCurrency = "GBP";
    protected string $targetCurrency = "EUR";

    public string $method = 'GET';

    #[ArrayShape(['Authorization' => "string"])] protected function getHeader()
    {
        return [
            'Authorization' => "Bearer {$this->getToken()}"
        ];
    }

    public function http(): \Illuminate\Http\Client\PendingRequest
    {
        return Http::withHeaders($this->getHeader());
    }

    public function post()
    {
        return $this->http()->post($this->getUrl(), $this->getBody());
    }


    public function get()
    {
        return $this->http()->get($this->getUrl(), [
            'query' => $this->getQuery(),
        ]);
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getProfileUrl(): string
    {
        return "{$this->host}/v2/profiles";
    }

    public function getHost(): string
    {
        return $this->host;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function getActiveProfileId(): string
    {
        return $this->activeProfileId;
    }

    public function getBatchGroupId(): string
    {
        return $this->batchGroupId;
    }

    public function setBatchGroupId($batchGroupId)
    {
        return $this->batchGroupId = $batchGroupId;
    }

    public function getBatchVersionGroup(): string
    {
        return $this->batchVersionGroup;
    }

    public function getSourceCurrency(): string
    {
        return $this->sourceCurrency;
    }

    public function getTargetCurrency(): string
    {
        return $this->targetCurrency;
    }
}
