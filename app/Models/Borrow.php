<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    use HasFactory;

    protected $table = 'borrow';
    protected $fillable = [
        'user_id',
        'book_id',
        'borrow_date',
        'return_date',
        'borrow_status'
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
