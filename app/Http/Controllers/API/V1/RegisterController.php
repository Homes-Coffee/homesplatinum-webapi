<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\CustomerLoyalty;
use App\Models\CustomerStudent;
use App\Http\Controllers\Controller;
use App\Http\Responses\JsonResponser;
use App\Http\Resources\CustomerResource;

class RegisterController extends Controller
{
    public function register(Request $request, $type)
    {
        $request->validate([
            'name'      => 'required|string',
            'email'     => 'required|string|unique:customers,email',
            'whatsapp'  => 'required|string|unique:customers,whatsapp',
            'password'  => 'required|min:8',
            'card_uuid' => 'required'
        ]);

        $customer = Customer::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'whatsapp'  => $request->whatsapp,
            'password'  => $request->password,
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

        // kirim otp


        return (new JsonResponser())->success('registrasi berhasil, masukan OTP', new CustomerResource($customer->fresh()));
    }

}
