<?php


namespace App\Http\Services\Wise\AddTransfer\AddTransfer;


use App\Http\Services\Wise\WiseAbstract;

class GetTransferExtraInfoDynamicForm extends WiseAbstract
{
    public string $method = 'POST';

    public function getUrl()
    {
        return "{$this->getHost()}/v1/transfer-requirements";
    }

    public function getBody()
    {
        return [
            "targetAccount" => $this->getNewRecipientId(),
            "quoteUuid" => $this->getQuoteId()
        ];
    }

    /**
     * @throws \Laravel\Octane\Exceptions\DdException
     */
    public function call()
    {
        $data = parent::call();
//        dd($data->json());
    }
}
