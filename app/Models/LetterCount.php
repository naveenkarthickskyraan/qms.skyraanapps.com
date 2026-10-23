<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LetterCount extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'letters',
        'category_id',
        'category_image',
        'image_type'
    ];

}
