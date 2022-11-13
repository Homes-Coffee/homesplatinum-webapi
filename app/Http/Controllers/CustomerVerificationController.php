<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\DataTables\CustomerVerificationDataTable;

class CustomerVerificationController extends Controller
{
    public function index(CustomerVerificationDataTable $datatable)
    {
        return $datatable->render('customer_verification.index', [
            'title' => 'Customer Verification'
        ]);
    }

    public function update($id, $is_active) {
        // validate user

        $customer = Customer::findOrFail($id);
        $customer->is_active = $is_active;
        $customer->save();

        return redirect()->back()->with('success', 'User has been verification');
    }
}
