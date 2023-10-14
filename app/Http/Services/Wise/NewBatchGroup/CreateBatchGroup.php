<?php


namespace App\Http\Services\Wise\NewBatchGroup;


use App\Http\Services\Wise\WiseAbstract;

class CreateBatchGroup extends WiseAbstract
{
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

    public function call()
    {
        // TODO: Implement call() method.
    }
}
