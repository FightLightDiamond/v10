<?php


namespace App\Http\Services\Wise\AddTransfer\ChooseOrCreateRecipient;


use App\Http\Services\Wise\WiseAbstract;

class CreateAccount extends WiseAbstract
{

    public function getUrl()
    {
        return "{{host}}/v3/profiles/{{active-profile-id}}/quotes";
    }

    public function getBody()
    {
        return [
            "sourceCurrency" => $this->getSourceCurrency(),
            "targetCurrency" => $this->getTargetCurrency(),
            "sourceAmount" => 100,
            "targetAmount" => null
        ];
    }

    public function call()
    {
        // TODO: Implement call() method.
    }
}
