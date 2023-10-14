<?php


namespace App\Http\Services\Wise\AddTransfer\CreateQuote;


use App\Http\Services\Wise\WiseAbstract;

class CreateQuote extends WiseAbstract
{
    public function getUrl(): string
    {
        return "{$this->host}/v3/profiles/{$this->activeProfileId}/quotes";
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

    public function call()
    {
        // TODO: Implement call() method.
    }
}
