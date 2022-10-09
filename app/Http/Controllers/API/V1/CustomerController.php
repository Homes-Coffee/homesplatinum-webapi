<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\JsonResponser;
use App\Http\Resources\CustomerResource;
use App\Http\Requests\API\ChangeImageRequest;
use App\Http\Requests\API\CustomerFCMRequest;
use App\Http\Requests\API\ChangeProfileRequest;
use App\Http\Requests\API\ChangePasswordRequest;

class CustomerController extends Controller
{
    public function show()
    {
        try {
            $customer = auth()->user();
            return (new JsonResponser())->success('Customer Profile', new CustomerResource($customer));
        } catch (\Throwable $th) {
            return (new JsonResponser())->exception($th);
        }
    }

    public function logout()
    {
        try {
            auth()->user()->tokens()->delete();
            return (new JsonResponser())->success('Logout Success', null);
        } catch (\Throwable $th) {
            return (new JsonResponser())->exception($th);
        }
    }

    public function fcm(CustomerFCMRequest $request)
    {
        try {
            $customer = Customer::findOrFail(auth()->user()->uuid);
            $customer->fcm = $request->fcm;
            $customer->save();

            return (new JsonResponser())->success('FCM Success', $customer);

        } catch (\Throwable $th) {
            return (new JsonResponser())->exception($th);
        }
    }

    public function change_image(ChangeImageRequest $request)
    {
        try {
            if ($request->hasFile('image_picture')) {
                $path = $request->image_picture->store('image_profile', 'public');
            }

            $customer = Customer::findOrFail(auth()->user()->uuid);
            $customer->photo = $path;
            $customer->save();

            return (new JsonResponser())->success('Change Image Success', $customer);
        } catch (\Throwable $th) {
            return (new JsonResponser())->exception($th);
        }
    }

    public function change_password(ChangePasswordRequest $request)
    {
        try {
            $customer = Customer::findOrFail(auth()->user()->uuid);
            $customer->password = bcrypt($request->password);
            $customer->save();

            return (new JsonResponser())->success('Change Password Success', $customer);

        } catch (\Throwable $th) {
            return (new JsonResponser())->exception($th);
        }
    }

    public function change_profile(ChangeProfileRequest $request)
    {
        try {
            $customer = Customer::findOrFail(auth()->user()->uuid);
            $customer->email = $request->email;
            $customer->name  = $request->name;
            $customer->save();

            return (new JsonResponser())->success('Change Profil', $customer);

        } catch (\Throwable $th) {
            return (new JsonResponser())->exception($th);
        }
    }

    public function delete_account()
    {
        try {
            $customer = auth()->user();
            @unlink("storage/" . $customer->photo);

            $customer->tokens()->delete();
            $customer->delete();

            return (new JsonResponser())->success('Customer data has been deleted', null);
        } catch (\Throwable $th) {
            return (new JsonResponser())->exception($th);
        }
    }
}
