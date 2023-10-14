<?php


namespace App\Http\Services\Wise\AddTransfer\ChooseOrCreateRecipient;


use App\Http\Services\Wise\WiseAbstract;

class LoadAccount extends WiseAbstract
{

    public function getUrl()
    {
        return "{{host}}/v2/accounts/?currency={$this->getTargetCurrency()}";
    }

    public function call()
    {
        // TODO: Implement call() method.
    }
}
