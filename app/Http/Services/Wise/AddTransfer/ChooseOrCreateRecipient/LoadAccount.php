<?php


namespace App\Http\Services\Wise\AddTransfer\ChooseOrCreateRecipient;


use App\Http\Services\Wise\WiseAbstract;

class LoadAccount extends WiseAbstract
{

    public function getUrl()
    {
        return "{$this->getHost()}/v2/accounts/?currency={$this->getTargetCurrency()}";
    }

    /**
     * @throws \Laravel\Octane\Exceptions\DdException
     */
    public function call()
    {
        $data = parent::call();
        dd($data);
    }
}