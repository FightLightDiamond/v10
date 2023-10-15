<?php


namespace App\Http\Services\Wise\AddTransfer\ChooseOrCreateRecipient;


use App\Http\Services\Wise\WiseAbstract;

class UpdateFormIfAnyFieldRequireRefresh extends WiseAbstract
{
    public string $method = 'POST';

    public function getUrl()
    {
        return "{{host}}/v1/quotes/{{new-quote-id}}/account-requirements";
    }

    public function getBody()
    {
        return [
            "type" => "aba",
            "details" => [
                "legalType" => "PRIVATE",
                "address" => [
                        "country" => "US"
                ]
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
}
