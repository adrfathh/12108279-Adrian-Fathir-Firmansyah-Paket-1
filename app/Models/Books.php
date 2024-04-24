<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory;

    protected $table = 'books';
    protected $fillable = [
        'author',
        'title',
        'publisher',
        'year_publish',
        'image',
        'category',
        'book_status',
    ];

    public function borrow()
    {
        return $this->hasMany(Borrow::class, 'book_id');
    }
    
    public function collection()
    {
        return $this->hasMany(Collection::class, 'book_id');
    }

    public function review()
    {
        return $this->hasMany(Review::class, 'book_id');
    }
}
