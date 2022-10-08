<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\CustomerWallet;
use Illuminate\Database\Seeder;
use App\Models\CustomerAgreement;
use Illuminate\Support\Facades\Hash;
use App\Models\CustomerIdentityNumber;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $counter = 100;
        Customer::factory($counter)->create()->each( function ($customer, $counter) {

            CustomerAgreement::create([
                'type_of_aggrement' => 'terms_of_conditions',
                'is_agree' => true,
                'agreed' => now(),
                'customer_uuid' => $customer->uuid,
                'policy_uuid' => null
            ]);

        });
    }
}
