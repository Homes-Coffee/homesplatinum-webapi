<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Card;
use Illuminate\Http\Request;
use App\Models\CustomerWallet;
use App\Http\Controllers\Controller;
use App\Http\Responses\JsonResponser;
use App\Http\Resources\CustomerResource;

class WalletController extends Controller
{
    public function create_pin(Request $request)
    {
        try {
            $request->validate([
                'pin' => 'required'
            ]);

            $customer = auth()->user();

            $card = Card::where('uuid', $customer->card_uuid)->firstOrFail();

            if ($card->title == 'Student') {
                $customerCode = '22' . str_pad((CustomerWallet::count() + 1), 4, 0, STR_PAD_LEFT);
            } else {
                $customerCode = '11' . str_pad((CustomerWallet::count() + 1), 4, 0, STR_PAD_LEFT);
            }

            $wallet = CustomerWallet::create([
                'pin'           => bcrypt($request->pin),
                'customer_code' => $customerCode,
                'point'         => 0,
                'balance'       => 0,
                'customer_uuid' => $customer->uuid,
            ]);

            return (new JsonResponser())->success('Pin Berhasil Diatur', ['customer' => new CustomerResource($customer), 'wallet' => $wallet]);

        } catch (\Throwable $th) {
            return (new JsonResponser())->exception($th);
        }
    }

    public function change_pin(Request $request)
    {
        $request->validate([
            'pin' => 'required'
        ]);

        $customer = auth()->user()->wallet()->first();

        return response()->json($customer);
    }
}
