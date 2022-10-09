<?php

namespace App\Http\Controllers\API\V1;

use Carbon\Carbon;
use App\Models\OTP;
use App\Models\Card;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\CustomerLoyalty;
use App\Models\CustomerStudent;
use App\Http\Controllers\Controller;
use App\Http\Responses\JsonResponser;
use App\Http\Resources\CustomerResource;
use App\Http\Requests\API\RegisterRequest;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request, $type = 'loyalty')
    {
        try {
            $card = Card::find($request->card_uuid);

            if (!$card) {
                return (new JsonResponser())->failure('Memberhsip Tidak Ditemukan', (object) ['message' => 'card membership tidak ditemukan'], 404);
            }

            $customer = Customer::create([
                'name'      => $request->name,
                'email'     => $request->email,
                'whatsapp'  => $request->whatsapp,
                'card_uuid' => $request->card_uuid
            ])->fresh();

            if ($type == 'student') {

                CustomerStudent::create([
                    'name'          => $request->name,
                    'email'         => $request->email,
                    'whatsapp'      => $request->whatsapp,
                    'phone'         => $request->phone,
                    'city'          => $request->city ?? 'Banjarmasin',
                    'school_name'   => $request->school_name,
                    'semester'      => $request->semester,
                    'customer_uuid' => $customer->uuid,
                ]);

            } elseif ($type == 'loyalty') {

                if ($request->hasFile('struct')) {
                    $struct = $request->struct->store('struct', 'public');
                }

                CustomerLoyalty::create([
                    'name'          => $request->name,
                    'email'         => $request->email,
                    'whatsapp'      => $request->whatsapp,
                    'phone'         => $request->phone,
                    'city'          => $request->city ?? 'Banjarmasin',
                    'struct'        => $struct ?? null,
                    'customer_uuid' => $customer->uuid,
                ]);
            }

            // sent OTP
            $code   = str_pad(mt_rand(0, 9999), 4, 0, STR_PAD_LEFT);
            $exp    = Carbon::now()->addMinutes(5)->timestamp;

            $otp = OTP::create([
                'send_with'     => 1,
                'code'          => $code,
                'time_exp'      => $exp,
                'has_been_used' => false,
                'user_id'       => $customer->uuid,
            ]);

            // WaBlast::sendWA([
            //     'phone'     => $data->nohp,
            //     'message'   => 'Berikut Kode OTP anda ' . $code . ' Harap rahasiakan kode OTP anda!',
            //     'secret'    => false, // or true
            //     'priority'  => false
            // ]);

            return (new JsonResponser())->success('Registrasi berhasil, masukan OTP', new CustomerResource($customer->fresh()), 200);
        } catch (\Throwable $th) {
            return (new JsonResponser())->exception($th, 500);
        }
    }

}
