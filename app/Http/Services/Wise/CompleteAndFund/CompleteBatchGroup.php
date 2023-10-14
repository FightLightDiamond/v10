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

    #[ArrayShape(["status" => "string", "version" => "string"])] public function getBody()
    {
        return [
            "status" =>  "COMPLETED",
	        "version" => $this->getBatchVersionGroup()
        ];
    }

    public function call()
    {
        // TODO: Implement call() method.
    }
}
