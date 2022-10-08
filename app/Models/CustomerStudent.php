<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerStudent extends Model
{
    protected $table = 'customer_student';

    protected $fillable = [
        'name',
        'email',
        'whatsapp',
        'phone',
        'school_name',
        'semester',
        'customer_uuid',
    ];

}
