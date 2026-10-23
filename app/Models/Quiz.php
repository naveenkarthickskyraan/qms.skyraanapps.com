<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_name',
        'question_content',
        'question_format_type',
        'option_format_type',
        'option_1',
        'option_2',
        'option_3',
        'option_4',
        'option_5',
        'option_6',
        'quiz_answer',
        'quiz_answer_value',
        'quiz_hint',
        'quiz_image',
        'image_type',
        'quiz_exp',
        'admin_id',
        'option_count',
        'category_id',
        'quiz_type',
        'quiz_type_value',
        'direction_description'
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\NestedCategory','category_id','id');
    }
}
