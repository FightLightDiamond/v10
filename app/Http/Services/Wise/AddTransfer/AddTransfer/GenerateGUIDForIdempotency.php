<?php


namespace App\Http\Services\Wise\AddTransfer\AddTransfer;


use App\Http\Services\Wise\WiseAbstract;

class GenerateGUIDForIdempotency extends WiseAbstract
{

    public function getUrl(): string
    {
        return "https://www.uuidgenerator.net/api/guid";
    }

    /**
     * @throws \Laravel\Octane\Exceptions\DdException
     */
    public function call()
    {
        $data = parent::call();
        $this->setIdempotencyGuid($data->body());
    }

    public function getBody(): array
    {
        return [];
    }

    public function getQuery(): array
    {
        return [];
    }
}
