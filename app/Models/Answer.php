<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Answer extends Model
{
    use HasFactory;

    protected $guarded = [''];

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
