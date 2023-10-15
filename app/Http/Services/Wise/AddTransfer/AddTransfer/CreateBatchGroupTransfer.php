<?php


namespace App\Http\Services\Wise\AddTransfer\AddTransfer;


use App\Http\Services\Wise\WiseAbstract;

class CreateBatchGroupTransfer extends WiseAbstract
{
    public string $method = 'POST';

    public function getUrl(): string
    {
        return "{{host}}/v3/profiles/{{active-profile-id}}/batch-groups/{{batch_group_id}}/transfers";
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
            "quoteUuid" => "{{new-quote-id}}",
            "customerTransactionId" => "{{idempotency-guid}}",
            "details" => [
                "reference" => "{{new-recipient-id}}",
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
