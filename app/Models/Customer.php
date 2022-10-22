<?php

namespace App\Models;

use App\Models\Card;
use Illuminate\Support\Str;
use App\Models\CustomerReward;
use App\Models\CustomerWallet;
use App\Models\CustomerLoyalty;
use App\Models\CustomerStudent;
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

    protected $appends = ['image_link'];

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
     * Get the card that owns the Customer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function card()
    {
        return $this->belongsTo(Card::class, 'card_uuid');
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

    /**
     * Get all of the customerLoyalty for the Customer
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function hasCustomerLoyalty()
    {
        return $this->hasMany(CustomerLoyalty::class, 'customer_uuid', 'uuid');
    }

    /**
     * Get all of the customerStudent for the Customer
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function hasCustomerStudent()
    {
        return $this->hasMany(CustomerStudent::class, 'customer_uuid', 'uuid');
    }

    public function customerNeedVerification()
    {
        return Customer::where('is_active', 0)->with('hasCustomerStudent')->with('hasCustomerLoyalty');
    }


}
