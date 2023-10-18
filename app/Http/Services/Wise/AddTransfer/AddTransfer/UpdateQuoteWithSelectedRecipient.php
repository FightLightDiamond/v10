<?php


namespace App\Http\Services\Wise\AddTransfer\AddTransfer;


use App\Http\Services\Wise\WiseAbstract;

class UpdateQuoteWithSelectedRecipient extends WiseAbstract
{
    public string $method = 'PATCH';

    public function getUrl()
    {
        return "{$this->getHost()}/v3/profiles/{$this->getActiveProfileId()}/quotes/{$this->getQuoteId()}";
    }

    public function getBody(): array
    {
        return [
            "targetAccount" => $this->getNewRecipientId(),
            "quoteUuid" => $this->getQuoteId(),
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
        dump($data->json());
    }
}
