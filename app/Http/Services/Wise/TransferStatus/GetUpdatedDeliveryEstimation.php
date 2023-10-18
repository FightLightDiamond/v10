<?php

namespace App\Http\Services\Wise\TransferStatus;

use App\Http\Services\Wise\WiseAbstract;

class GetUpdatedDeliveryEstimation extends WiseAbstract
{
    public function getUrl()
    {
        return "{$this->getHost()}/v1/delivery-estimates/{$this->getBatchGroupId()}";
    }

    public function call()
    {
        $data = parent::call();
        dump($data->json());
    }
}
