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
}
