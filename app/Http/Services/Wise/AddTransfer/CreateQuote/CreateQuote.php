<?php


namespace App\Http\Services\Wise\AddTransfer\CreateQuote;


use App\Http\Services\Wise\WiseAbstract;

class CreateQuote extends WiseAbstract
{
    public string $method = 'POST';

    public function getUrl(): string
    {
        return "{$this->getHost()}/v3/profiles/{$this->getActiveProfileId()}/quotes";
    }

    public function getBody(): array
    {
        return [
            "sourceCurrency" => $this->getSourceCurrency(),
            "targetCurrency" => $this->getTargetCurrency(),
            "sourceAmount" => 100,
            "targetAmount" => null
        ];
    }

    /**
     * @throws \Laravel\Octane\Exceptions\DdException
     */
    public function call()
    {
        $data = parent::call();
        $this->setQuoteId($data->json('id'));
    }
}
