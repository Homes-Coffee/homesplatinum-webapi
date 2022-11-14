<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $table = 'stores';

    protected $primaryKey = 'uuid';
    protected $keyType  = 'string';

    public $incrementing = false;

    protected $fillable = [
        'uuid',
        'name',
        'address',
        'image',
        'phone',
        'instagram_id',
        'location',
    ];

    protected $cats = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
    ];

    protected $appends = [
        'image_link',
        'location_link',
        'instagram_link'
    ];

    public function getImageLinkAttribute()
    {
        if ($this->image != null ) {
            return asset('storage/' . $this->image);
        }

        return '';
    }

    public function getInstagramLinkAttribute()
    {
        if ($this->instagram_id == null) {
            return "https://instagram.com/homes.headoffice/";
        }

        return "instagram.com/".$this->instagram_id."/";
    }

    public function getLocationLinkAttribute()
    {
        if ($this->location == null) {
            return "";
        }

        $location = json_decode($this->location);

        return "https://maps.google.com/?q=".$location->lat.",".$location->lng;
    }
}
