<?php


namespace App\Http\Services\Wise\AddTransfer\AddTransfer;


use App\Http\Services\Wise\WiseAbstract;

class UpdateTransferExtraInfoDynamicForm extends WiseAbstract
{
    public string $method = 'POST';

    public function getUrl()
    {
        return "{$this->getHost()}/v1/transfer-requirements";
    }

    public function getBody(): array
    {
        return [
            "targetAccount" => $this->getNewRecipientId(),
            "quoteUuid" => "{$this->getQuoteId()}",
            "details" => [
                "reference" => "my ref",
                "sourceOfFunds" => "verification.source.of.funds.other"
            ]
        ];
    }

    /**
     * @throws \Laravel\Octane\Exceptions\DdException
     */
    public function call()
    {
        $data = parent::call();
        dd($data->json());
    }

    public function getQuery(): array
    {
        return [];
    }
}
