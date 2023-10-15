<?php


namespace App\Http\Services\Wise\AddTransfer\ChooseOrCreateRecipient;


use App\Http\Services\Wise\WiseAbstract;

class GetRecipientCreationDynamicForm extends WiseAbstract
{

    public function getUrl()
    {
        return "{{host}}/v1/quotes/{{new-quote-id}}/account-requirements";
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
