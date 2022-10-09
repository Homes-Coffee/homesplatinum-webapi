<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Models\CustomerTransaction;
use App\Http\Controllers\Controller;
use App\Http\Responses\JsonResponser;

class CustomerTransactionController extends Controller
{
    public function history_transaction()
    {
        try {
            $history = CustomerTransaction::where('customer_uuid', auth()->user()->uuid)->orderBy('created_at', 'desc')->get();
            return (new JsonResponser())->success('Customer Transaction', $history);
        } catch (\Throwable $th) {
            return (new JsonResponser())->exception($th);
        }
    }
}
