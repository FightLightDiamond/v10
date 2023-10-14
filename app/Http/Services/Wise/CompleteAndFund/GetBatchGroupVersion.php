<?php


namespace App\Http\Services\Wise\CompleteAndFund;


use App\Http\Services\Wise\WiseAbstract;

class GetBatchGroupVersion extends WiseAbstract
{
    public function getUrl()
    {
        return "{{host}}/v3/profiles/{{active-profile-id}}/batch-groups/{{batch_group_id}}";
    }

    public function call()
    {
        // TODO: Implement call() method.
    }
}
