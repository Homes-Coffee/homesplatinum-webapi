<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Models\CustomerReward;
use App\Models\CustomerWallet;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory, HasApiTokens;

    protected $table = 'customers';

    protected $primaryKey = 'uuid';
    protected $keyType  = 'string';

    public $incrementing = false;

    protected $fillable = [
        'uuid',
        'name',
        'email',
        'whatsapp',
        'card_uuid'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    protected $append = ['image_link'];

    public function getImageLinkAttribute()
    {
        if ($this->photo != null ) {
            return asset('storage/' . $this->photo);
        }

        return '';
    }

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model['uuid']      = Str::uuid();
            return $model;
        });
    }

    /**
     * Get the wallet associated with the Customer
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function wallet()
    {
        return $this->hasOne(CustomerWallet::class, 'customer_uuid');
    }

    /**
     * Get all of the rewards for the Customer
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rewards()
    {
        return $this->hasMany(CustomerReward::class, 'customer_uuid');
    }
}
