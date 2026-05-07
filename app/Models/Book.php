<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author',
        'price',
        'description'
    ];

    public function detail(): HasOne
    {
        return $this->hasOne(BookDetail::class);
    }
}
