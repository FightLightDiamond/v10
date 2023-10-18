<?php


namespace App\Http\Services\Wise\CompleteAndFund;


use App\Http\Services\Wise\WiseAbstract;

class GetBatchGroupVersion extends WiseAbstract
{
    public function getUrl()
    {
        return "{$this->getHost()}/v3/profiles/{$this->getActiveProfileId()}/batch-groups/{$this->getBatchGroupId()}";
    }

    public function getQuery()
    {
        return [];
    }

    /**
     * @throws \Laravel\Octane\Exceptions\DdException
     */
    public function call()
    {
        $data = parent::call();
        $this->setBatchGroupVersion($data->json('version'));
        dump($data->json());
    }
}
