<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeFact extends Model
{
    protected $table = 'home_facts';

    protected $fillable = [
        'uuid',
        'image',
        'published_at',
        'user_id',
    ];

    protected $appends = ['image_link'];

    public function getImageLinkAttribute()
    {
        if ($this->image != null ) {
            return asset('storage/' . $this->image);
        }

        return '';
    }

}
