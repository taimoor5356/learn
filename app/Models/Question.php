<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function answer()
    {
        return $this->hasOne(Answer::class, 'question_id', 'id');
    }

    public function setAttribute($key, $value)
    {
        if ($key == 'question') {
            $value = strtolower($value);
        }
        return parent::setAttribute($key, $value);
    }

    public function getQuestionAttribute($value)
    {
        return ucfirst($value);
    }
}
