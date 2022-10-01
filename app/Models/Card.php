<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $table = 'cards';

    protected $fillable = [
        'uuid',
        'title',
        'description',
        'image',
    ];

    protected $append = ['image_link'];

    public function getImageLinkAttribute()
    {
        if ($this->image != null ) {
            return asset('storage/' . $this->image);
        }

        return '';
    }
}
