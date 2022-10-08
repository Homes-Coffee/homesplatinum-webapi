<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerLoyalty extends Model
{
    use HasFactory;

    protected $table = 'customer_loyalty';

    protected $fillable = [
        'name',
        'email',
        'whatsapp',
        'phone',
        'city',
        'struct',
        'customer_uuid',
    ];
}
