<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomerWallet extends Model
{
    use HasFactory;

    protected $table = 'customer_wallets';

    protected $fillable = [
        'uuid',
        'pin',
        'customer_code',
        'point',
        'balance',
        'customer_uuid',
    ];

    protected $hidden = [
        'pin',
    ];

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model['uuid']           = Str::uuid();
            $model['customer_code']  = Str::upper(uniqid());
            return $model;
        });
    }
}
