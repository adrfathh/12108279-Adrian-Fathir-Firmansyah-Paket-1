<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;

    protected $table = 'collection';
    protected $fillable = [
        'user_id',
        'book_id'
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
