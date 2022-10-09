<?php

namespace App\Http\Controllers\API\V1;

use Carbon\Carbon;
use App\Models\OTP;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Resources\OTPResource;
use App\Http\Controllers\Controller;
use App\Http\Responses\JsonResponser;
use App\Http\Resources\CustomerResource;
use App\Http\Requests\API\CheckOTPRequest;
use App\Http\Requests\API\ResendOTPRequest;

class OTPController extends Controller
{
    public function check_otp(CheckOTPRequest $request)
    {
        try {

            $otp = OTP::where('user_id', $request->customer_uuid)
                    ->where('code', $request->otp)
                    ->where('has_been_used', 0)->first();

            if (!$otp) {
                return (new JsonResponser())->failure('otp tidak ditemukan', (object) ['message' => 'otp not found'], 404);
            }

            if (Carbon::now()->timestamp > $otp->time_exp) {
                $otp->has_been_used = 1;
                $otp->save();

                return (new JsonResponser())->success('otp kada luarsa', (object) ['message' => 'otp expired'], 401);
            }

            $otp->has_been_used = 1;
            $otp->save();

            $user = Customer::where('uuid', $request->customer_uuid)->firstOrFail();
            $user->phone_verified_at = Carbon::now()->format('Y-m-d h:i:s');
            $user->save();

            $token  = $user->createToken(md5('homes'))->plainTextToken;

            return (new JsonResponser())->success('success', (object) ['access_token' => $token, 'customer' => new CustomerResource($user)], 200);
        } catch (\Throwable $th) {
            return (new JsonResponser())->exception($th);
        }
    }

    public function resend_otp(ResendOTPRequest $request)
    {
        try {
            $code   = str_pad(mt_rand(0, 9999), 4, 0, STR_PAD_LEFT);
            $exp    = Carbon::now()->addMinutes(5)->timestamp;

            $otp = OTP::create([
                'send_with'     => 1,
                'code'          => $code,
                'time_exp'      => $exp,
                'has_been_used' => false,
                'user_id'       => $request->customer_uuid,
            ]);

            // WaBlast::sendWA([
            //     'phone'     => $data->nohp,
            //     'message'   => 'Berikut Kode OTP anda ' . $code . ' Harap rahasiakan kode OTP anda!',
            //     'secret'    => false, // or true
            //     'priority'  => false
            // ]);

            return (new JsonResponser())->success('success', (object) ['message' => 'OTP has been sent'], 200);
        } catch (\Throwable $th) {
            return (new JsonResponser())->exception($th);
        }
    }
}
