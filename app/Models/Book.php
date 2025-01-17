<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';

    protected $fillable = [
        'title','publication_year','genre','total_copies','available_copies','author_id'
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class, 'author_id');
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'book_id');
    }
}
