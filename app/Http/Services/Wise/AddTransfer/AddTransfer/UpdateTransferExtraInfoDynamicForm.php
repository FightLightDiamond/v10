<?php


namespace App\Http\Services\Wise\AddTransfer\AddTransfer;


use App\Http\Services\Wise\WiseAbstract;

class UpdateTransferExtraInfoDynamicForm extends WiseAbstract
{
    public string $method = 'POST';

    public function getUrl()
    {
        return "{{host}}/v1/transfer-requirements";
    }

    public function getBody(): array
    {
        return [
            "targetAccount" => $this->getNewRecipientId(),
            "quoteUuid" => "{{new-quote-id}}",
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
        dd($data);
    }

  public function getQuery(): array

    {

        return [];

    }
}
