<?php


namespace App\Http\Services\Wise\CompleteAndFund;


use App\Http\Services\Wise\WiseAbstract;

class GetBatchGroupVersion extends WiseAbstract
{
    public function getUrl()
    {
        return "{{host}}/v3/profiles/{{active-profile-id}}/batch-groups/{{batch_group_id}}";
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
