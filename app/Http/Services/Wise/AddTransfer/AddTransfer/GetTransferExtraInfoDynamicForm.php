<?php


namespace App\Http\Services\Wise\AddTransfer\AddTransfer;


use App\Http\Services\Wise\WiseAbstract;

class GetTransferExtraInfoDynamicForm extends WiseAbstract
{
    public string $method = 'POST';

    public function __construct()
    {

    }

    public function getUrl()
    {
        return "{{host}}/v1/transfer-requirements";
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
