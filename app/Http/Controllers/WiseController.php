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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
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
        (new GenerateGUIDForIdempotency())->call();
        (new UpdateQuoteWithSelectedRecipient())->call();
        (new GetTransferExtraInfoDynamicForm())->call();
        (new CreateBatchGroupTransfer())->call();
        (new GetBatchGroupVersion())->call();
        (new CompleteBatchGroup())->call();
        (new FundBatchGroup())->call();
    }

    public function getProfileUrl(): string
    {
        return "{$this->uri}/v2/profiles";
    }
}
