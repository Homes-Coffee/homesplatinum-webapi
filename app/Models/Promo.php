<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use HasFactory;

    protected $table = 'promo';

    protected $primaryKey = 'uuid';
    protected $keyType    = 'string';

    public $incrementing = false;

    protected $fillable = [
        'uuid',
        'title',
        'description',
        'image',
        'thumbnail',
    ];

    protected $appends = ['image_link', 'thumbnail_link'];

    public function getImageLinkAttribute()
    {
        if ($this->image != null ) {
            return asset('storage/' . $this->image);
        }

        return null;
    }

    public function getThumbnailLinkAttribute()
    {
        if ($this->thumbnail != null ) {
            return asset('storage/' . $this->thumbnail);
        }

        return null;
    }
}
