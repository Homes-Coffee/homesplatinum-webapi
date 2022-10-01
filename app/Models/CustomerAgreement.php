<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerAgreement extends Model
{
    use HasFactory;

    protected $table = 'customer_aggrements';

    protected $fillable = [
        'type_of_aggrement',
        'is_agree',
        'agreed',
        'customer_uuid',
    ];
}
