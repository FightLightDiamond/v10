<?php


namespace App\Http\Services\Wise\AddTransfer\ChooseOrCreateRecipient;


use App\Http\Services\Wise\WiseAbstract;

class CreateAccount extends WiseAbstract
{

    public function getUrl(): string
    {
        return "{$this->getHost()}/v1/accounts";
    }

    public function getBody()
    {
        return [
            "accountHolderName" => "Person USD",
            "currency" => "USD",
            "type" => "ABA",
            "details" => [
                "address" => [
                    "city" => "New York",
                    "countryCode" => "US",
                    "postCode" => "10025",
                    "state" => "NY",
                    "firstLine" => "158 Wall Street"
                ],
                "legalType" => "PRIVATE",
                "abartn" => "064000020",
                "accountType" => "CHECKING",
                "accountNumber" => "40000000000",
                "email" => "example@foobar.com"
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
}
