<?php


namespace App\Http\Services\Wise\AddTransfer\ChooseOrCreateRecipient;


use App\Http\Services\Wise\WiseAbstract;

class GetAccountInV2Form extends WiseAbstract
{

    public function getUrl()
    {
        return "{$this->getHost()}/v2/accounts/{$this->getNewRecipientId()}";
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
