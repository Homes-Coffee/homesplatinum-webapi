<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Promo;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\JsonResponser;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        try {
            $id = auth()->user()->uuid;

            $customer = Customer::where('uuid', $id)->with('wallet')->get();
            $promo    = Promo::where('pinned', 1)->orderBy('created_at', 'desc');

            return (new JsonResponser())->success('Home', [
                'customer' => $customer,
                'card' => $customer->card()->first(),
                'promo' => $promo,
                'homes_fact' => false,
                'new_rewards' => false,
                'new_promo' => false
            ]);

        } catch (\Throwable $th) {
            return (new JsonResponser())->exception($th);
        }
    }
}
