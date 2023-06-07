<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Answer extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function category()
    {
        return $this->belongsToThrough(Category::class, Question::class, ['question_id', 'category_id']);
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id', 'id');
    }

    // public function setAttribute($key, $value)
    // {
    //     // if ($key == 'answer') {
    //     //     $value = strtolower($value);
    //     // }
    //     // return parent::setAttribute($key, $value);
    // }

    // public function getAnswerAttribute($value)
    // {
    //     return ucfirst($value);
    // }
}
