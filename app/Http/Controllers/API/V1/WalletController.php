<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\CustomerWallet;
use App\Http\Controllers\Controller;
use App\Http\Responses\JsonResponser;
use App\Http\Resources\CustomerResource;
use App\Http\Requests\API\CreatePINRequest;
use App\Http\Requests\API\ValidatePinRequest;

class WalletController extends Controller
{
    /**
     * Create PIN or Change PIN
     *
     * If Wallet was Exist PIN WILL BE CHANGED
     *
     * CREATE PIN ON BODY IS ONLY PIN
     * BUT CHANGE PIN ON BODY IS PIN AND OLD_PIN IN NUMERIC
     */
    public function create_pin(CreatePINRequest $request)
    {
        try {

            $customer = auth()->user();

            if ($customer->wallet()->first()) {
                // check old pin with current pin
                if (! Hash::check($request->old_pin, $customer->wallet()->first()->pin) ) {
                    // pin is not same
                    return (new JsonResponser())->failure('Pin Lama Tidak Cocok', null, 400);
                }

                // pin match and update new pin
                $wallet = $customer->wallet()->first();
                $wallet->pin = bcrypt($request->pin);
                $wallet->save();

                // return success with code 200
                return (new JsonResponser())->success('Pin Berhasil Diubah', null, 200);
            } else {

                // firstly check type of membership
                $card = Card::where('uuid', $customer->card_uuid)->firstOrFail();
                if ($card->title == 'Student') {
                    $customerCode = '22' . str_pad((CustomerWallet::count() + 1), 4, 0, STR_PAD_LEFT);
                } else {
                    $customerCode = '11' . str_pad((CustomerWallet::count() + 1), 4, 0, STR_PAD_LEFT);
                }

                // create new wallet because wallet doesnt exist
                $wallet = CustomerWallet::create([
                    'pin'           => bcrypt($request->pin),
                    'customer_code' => $customerCode,
                    'point'         => 0,
                    'balance'       => 0,
                    'customer_uuid' => $customer->uuid,
                ]);

                // return with status code 200
                return (new JsonResponser())->success('Pin Berhasil Diatur', null);
            }

        } catch (\Throwable $th) {
            return (new JsonResponser())->exception($th);
        }
    }

    /**
     * Check PIN
     *
     *
     */
    public function check_pin()
    {
        try {
            $customer = auth()->user();
            $wallet   = $customer->wallet()->first();

            if ($wallet != null) {
                return (new JsonResponser())->success('PIN HAS BEEN SET', ['customer' => new CustomerResource($customer), 'wallet' => $wallet]);
            } else {
                return (new JsonResponser())->failure('PIN NOT SET', null, 403);
            }

        } catch (\Throwable $th) {
            return (new JsonResponser())->exception($th);
        }
    }

    /**
     * Check PIN OR VALIDATE
     *
     * If Wallet was Exist PIN OR NOT
     *
     * CREATE PIN BODY ONLY PIN
     * BUT CHANGE PIN BODY PIN AND OLD_PIN IN NUMERIC
     */
    public function vallidate_pin(ValidatePinRequest $request)
    {
        try {
            $customer = auth()->user();

            $wallet = CustomerWallet::where('customer_uuid', $customer->uuid)->firstOrFail();

            if (Hash::check($request->pin, $wallet->pin)) {
                return (new JsonResponser())->success('PIN MATCH', ['customer' => new CustomerResource($customer), 'wallet' => $wallet]);
            } else {
                return (new JsonResponser())->failure('PIN NOT MATCh', null, 403);
            }

        } catch (\Throwable $th) {
            return (new JsonResponser())->exception($th);
        }
    }


}
