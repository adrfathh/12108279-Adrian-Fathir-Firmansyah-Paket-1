<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'review';
    protected $fillable = [
        'user_id',
        'book_id',
        'review',
        'rating',
    ];

    public function book()
    {
        return $this->belongsTo(Books::class, 'book_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
