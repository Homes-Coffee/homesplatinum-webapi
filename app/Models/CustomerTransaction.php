<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerTransaction extends Model
{
    protected $table = 'customer_transactions';

    protected $fillable = [
        'uuid',
        'name',
        'description',
        'total',
        'customer_uuid',
        'user_id',
    ];
}
