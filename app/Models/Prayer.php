<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prayer extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'prayer_title',
        'book_number',
        'verse_number',
        'chapter_number',
        'prayer_image',
        'opening_prayer',
        'closing_prayer',
        'scripture',
        'category_id',
        'image_type',
        'admin_id',
        'is_active'
    ];

    public function Language()
    {
        return $this->belongsTo('App\Models\Category','language_code','id');
    }
}
