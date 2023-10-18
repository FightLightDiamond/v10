<?php

namespace App\Http\Controllers;

use App\Http\Services\Wise\AddTransfer\AddTransfer\CreateBatchGroupTransfer;
use App\Http\Services\Wise\AddTransfer\AddTransfer\GenerateGUIDForIdempotency;
use App\Http\Services\Wise\AddTransfer\AddTransfer\GetTransferExtraInfoDynamicForm;
use App\Http\Services\Wise\AddTransfer\AddTransfer\UpdateQuoteWithSelectedRecipient;
use App\Http\Services\Wise\AddTransfer\ChooseOrCreateRecipient\LoadAccount;
use App\Http\Services\Wise\AddTransfer\CreateQuote\CreateQuote;
use App\Http\Services\Wise\CompleteAndFund\CompleteBatchGroup;
use App\Http\Services\Wise\CompleteAndFund\FundBatchGroup;
use App\Http\Services\Wise\CompleteAndFund\GetBatchGroupVersion;
use App\Http\Services\Wise\NewBatchGroup\CreateBatchGroup;
use App\Http\Services\Wise\TransferStatus\GetTransferStatus;
use App\Http\Services\Wise\TransferStatus\GetUpdatedDeliveryEstimation;
use JetBrains\PhpStorm\ArrayShape;

class WiseController extends Controller
{
    protected string $uri = 'https://api.sandbox.transferwise.tech';
    protected string $token = 'ddeedb14-c4e4-4293-bbf3-a9afa6288fc6';
    protected string $activeProfileId = '16969701';

    #[ArrayShape(['Authorization' => "string"])] protected function getHeader()
    {
        return [
            'Authorization' => "Bearer {$this->token}"
        ];
    }

    public function exec()
    {
        (new CreateBatchGroup())->call();

        (new CreateQuote())->call();

        (new LoadAccount())->call();

        (new UpdateQuoteWithSelectedRecipient())->call();
        (new GetTransferExtraInfoDynamicForm())->call();
        (new UpdateQuoteWithSelectedRecipient())->call();

        (new GenerateGUIDForIdempotency())->call();
        (new CreateBatchGroupTransfer())->call();

        (new GetBatchGroupVersion())->call();
        (new CompleteBatchGroup())->call();
        (new FundBatchGroup())->call();

        (new GetTransferStatus())->call();
        (new GetUpdatedDeliveryEstimation())->call();
    }

    public function getProfileUrl(): string
    {
        return "{$this->uri}/v2/profiles";
    }
}
