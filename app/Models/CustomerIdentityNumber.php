<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerIdentityNumber extends Model
{
    use HasFactory;

    protected $table = 'identity_numbers';

    protected $fillable = [
        'identity_number',
        'identity_number_file',
        'customer_uuid',
    ];
}
