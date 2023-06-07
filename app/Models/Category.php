<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function questions()
    {
        return $this->hasMany(Question::class, 'question_id', 'id');
    }

    public function setAttribute($key, $value)
    {
        if ($key == 'name') {
            $value = strtolower($value);
        }
        return parent::setAttribute($key, $value);
    }
    public function getNameAttribute($value)
    {
        return strtoupper($value);
    }
}
