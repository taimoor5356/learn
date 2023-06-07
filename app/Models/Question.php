<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use HasFactory;

    protected $guarded = [''];

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
