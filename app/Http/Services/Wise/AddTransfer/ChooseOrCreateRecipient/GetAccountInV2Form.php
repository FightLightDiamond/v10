<?php


namespace App\Http\Services\Wise\AddTransfer\ChooseOrCreateRecipient;


use App\Http\Services\Wise\WiseAbstract;

class GetAccountInV2Form extends WiseAbstract
{

    public function getUrl()
    {
        return "{{host}}/v2/accounts/{{new-recipient-id}}";
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
