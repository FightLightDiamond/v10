<?php


namespace App\Http\Services\Wise\AddTransfer\AddTransfer;


use App\Http\Services\Wise\WiseAbstract;

class UpdateQuoteWithSelectedRecipient extends WiseAbstract
{
    public string $method = 'PATCH';

    public function getUrl()
    {
        return "{{host}}/v3/profiles/{{active-profile-id}}/quotes/{{new-quote-id}}";
    }

    public function getBody()
    {
        return [
            "targetAccount" => $this->getNewRecipientId()
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
