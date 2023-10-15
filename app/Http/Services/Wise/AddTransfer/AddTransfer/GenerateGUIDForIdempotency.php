<?php


namespace App\Http\Services\Wise\AddTransfer\AddTransfer;


use App\Http\Services\Wise\WiseAbstract;

class GenerateGUIDForIdempotency extends WiseAbstract
{

    public function getUrl()
    {
        return "https://www.uuidgenerator.net/api/guid";
    }

    /**
     * @throws \Laravel\Octane\Exceptions\DdException
     */
    public function call()
    {
        $data = parent::call();
        dd($data);
    }

    public function getBody(): array
    {
        // TODO: Implement getBody() method.
    }

  public function getQuery(): array

    {

        return [];

    }
}
