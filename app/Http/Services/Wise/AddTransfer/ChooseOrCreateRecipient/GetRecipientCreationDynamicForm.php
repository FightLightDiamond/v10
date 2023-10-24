<?php


namespace App\Http\Services\Wise\AddTransfer\ChooseOrCreateRecipient;


use App\Http\Services\Wise\WiseAbstract;

class GetRecipientCreationDynamicForm extends WiseAbstract
{

    public function getUrl()
    {
        return "{$this->getHost()}/v1/quotes/{$this->getQuoteId()}/account-requirements";
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
