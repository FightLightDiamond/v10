<?php


namespace App\Http\Services\Wise\CompleteAndFund;


use App\Http\Services\Wise\WiseAbstract;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;

class CompleteBatchGroup extends WiseAbstract
{
    public string $method = 'PATCH';

    #[Pure] public function getUrl()
    {
        return "{$this->getHost()}/v3/profiles/{$this->getActiveProfileId()}/batch-groups/{$this->getBatchGroupId()}";
    }

    #[ArrayShape(["status" => "string", "version" => "string"])] public function getBody(): array
    {
        return [
            "status" =>  "COMPLETED",
	        "version" => $this->getBatchGroupVersion()
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
