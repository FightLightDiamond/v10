<?php


namespace App\Http\Services\Wise;


use Illuminate\Support\Facades\Http;
use JetBrains\PhpStorm\ArrayShape;

abstract class WiseAbstract implements WiseInterface
{
    protected string $host = 'https://api.sandbox.transferwise.tech';
    protected string $token = 'ddeedb14-c4e4-4293-bbf3-a9afa6288fc6';
    protected string $activeProfileId = '16969701';
    protected static string $batchGroupId;
    protected string $sourceCurrency = "SGD";
    protected string $targetCurrency = "USD";
    public string $method = 'GET';
    protected static string $newRecipientId = '';
    public static string $quoteId = '';
    public static string $idempotencyGuid = '';
    public static string $batchGroupVersion = '';

    public array $actions = [
        'GET' => 'get',
        'POST' => 'post',
        'PATCH' => 'patch',
    ];

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


    public function patch()
    {
        return $this->http()->patch($this->getUrl(), $this->getBody());
    }

    public function get()
    {
        return $this->http()->get($this->getUrl(), [
            'query' => $this->getQuery(),
        ]);
    }

    /**
     * @throws \Laravel\Octane\Exceptions\DdException
     */
    public function call()
    {
        $action = $this->actions[$this->getMethod()];
        return call_user_func([$this, $action]);
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getProfileUrl(): string
    {
        return "{$this->getHost()}/v2/profiles";
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
        return static::$batchGroupId;
    }

    public function setBatchGroupId($batchGroupId)
    {
        return static::$batchGroupId = $batchGroupId;
    }

    public function getSourceCurrency(): string
    {
        return $this->sourceCurrency;
    }

    public function getTargetCurrency(): string
    {
        return $this->targetCurrency;
    }

    public function getNewRecipientId(): string
    {
        return static::$newRecipientId;
    }

    public function setNewRecipientId($newRecipientId)
    {
        return static::$newRecipientId = $newRecipientId;
    }

    public function getQuoteId(): string
    {
        return static::$quoteId;
    }

    public function setQuoteId($quoteId)
    {
        return static::$quoteId = $quoteId;
    }

    public function getIdempotencyGuid(): string
    {
        return static::$idempotencyGuid;
    }

    public function setIdempotencyGuid($idempotencyGuid)
    {
        return static::$idempotencyGuid = $idempotencyGuid;
    }

    public function getBatchGroupVersion(): string
    {
        return static::$batchGroupVersion;
    }

    public function setBatchGroupVersion($batchGroupVersion)
    {
        return static::$batchGroupVersion = $batchGroupVersion;
    }
}
