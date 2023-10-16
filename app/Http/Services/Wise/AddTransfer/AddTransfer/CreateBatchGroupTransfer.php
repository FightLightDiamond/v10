<?php


namespace App\Http\Services\Wise\AddTransfer\AddTransfer;


use App\Http\Services\Wise\WiseAbstract;

class CreateBatchGroupTransfer extends WiseAbstract
{
    public string $method = 'POST';

    public function getUrl(): string
    {
        return "{$this->getHost()}/v3/profiles/{$this->getActiveProfileId()}/batch-groups/{$this->getBatchGroupId()}/transfers";
    }

    /**
     * @throws \Laravel\Octane\Exceptions\DdException
     */
    public function call()
    {
        dump('123');
        dd($this->method);
//        $data = parent::call();
        dd($data);
    }

    public function getBody(): array
    {
        return [
            "targetAccount" => $this->getNewRecipientId(),
            "quoteUuid" => "{$this->getQuoteId()}",
            "customerTransactionId" => "{{idempotency-guid}}",
            "details" => [
                "reference" => "{$this->getNewRecipientId()}",
                "transferPurpose" => "Other",
                "sourceOfFunds" => "Salary"
            ]
        ];
    }

    public function getQuery(): array
    {
        return [];
    }
}
