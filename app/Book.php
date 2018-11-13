<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public function books_category(){
        return $this->belongsTo(BooksCategory::class);
    }
}
