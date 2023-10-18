<?php


namespace App\Http\Services\Wise\CompleteAndFund;


use App\Http\Services\Wise\WiseAbstract;

class FundBatchGroup extends WiseAbstract
{
    public string $method = 'POST';

    public function getUrl()
    {
        return "{$this->getHost()}/v3/profiles/{$this->getActiveProfileId()}/batch-payments/{$this->getBatchGroupId()}/payments";
    }

    public function getBody()
    {
        return [
            'type' => "BALANCE"
        ];
    }

    /**
     * @throws \Laravel\Octane\Exceptions\DdException
     */
    public function call()
    {
        $data = parent::call();
        dd($data->json());
    }
}
