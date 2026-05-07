<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class BookDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'publisher',
        'language',
        'page_count',
    ];

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}
