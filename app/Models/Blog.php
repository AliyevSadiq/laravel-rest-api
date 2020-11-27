<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Class Blog
 * @package App\Models
 * @mixin Builder
 */
class Blog extends Model
{
    use HasFactory;

    protected $fillable=['title','content'];


    public function setTitleAttribute($value){
        $this->attributes['title']=Str::ucfirst($value);
    }

    public static $rules=[
        'title'=>['required'],
        'content'=>['required'],
    ];
    public static $errorMsg=[
        'title.required'=>'TITLE MUST NOT BE EMPTY',
        'content.required'=>'CONTENT MUST NOT BE EMPTY',
    ];


}
