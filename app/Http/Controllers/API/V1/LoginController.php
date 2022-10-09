<?php

namespace App\Http\Controllers\API\V1;

use Carbon\Carbon;
use App\Models\OTP;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\JsonResponser;
use App\Http\Requests\API\LoginRequest;
use App\Http\Resources\CustomerResource;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        try {
            $customer = Customer::where('whatsapp', $request->whatsapp)->firstOrFail();

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

            return (new JsonResponser())->success('Whatsapp ditemukan, masukan OTP', ['customer' => new CustomerResource($customer)]);
        } catch (\Throwable $th) {
            return (new JsonResponser())->exception($th);
        }
    }
}
