<?php


namespace App\Http\Services\Wise\NewBatchGroup;


use App\Http\Services\Wise\WiseAbstract;

class CreateBatchGroup extends WiseAbstract
{
    public string $method = 'POST';

    public function getUrl(): string
    {
        return "{$this->getHost()}/v3/profiles/{$this->getActiveProfileId()}/batch-groups";
    }

    public function getBody(): array
    {
        return [
            "sourceCurrency" => $this->getSourceCurrency(),
            "name" => "Test Batch"
        ];
    }

    public function post()
    {
        return $this->http()->post($this->getUrl(), $this->getBody());
    }

    /**
     * @throws \Laravel\Octane\Exceptions\DdException
     */
    public function call()
    {
        $res = parent::call();
        $this->setBatchGroupId($res->json('id'));
    }

    public function getQuery(): array
    {
        return [];
    }
}
