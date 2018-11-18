<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['title','description','image','user_id','books_category_id'];

    public function books_category(){
        return $this->belongsTo(BooksCategory::class);
    }

    protected $hidden = ['user_id'];
}
