<?php


namespace App\Http\Services\Wise\CompleteAndFund;


use App\Http\Services\Wise\WiseAbstract;

class FundBatchGroup extends WiseAbstract
{
    public string $method = 'POST';

    public function getUrl()
    {
        return "{$this->getHost()}/v3/profiles/{{active-profile-id}}/batch-payments/{{batch_group_id}}/payments";
    }

    public function getBody()
    {
        return [
            'type' => "BALANCE"
        ];
    }

    public function call()
    {
        // TODO: Implement call() method.
    }
}
