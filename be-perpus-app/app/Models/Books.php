<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory, HasUuids;

    protected $table = "books";

    // protected $hidden = [
    //     'category_id'
    // ];

    protected $fillable = [
        'title',
        'summary',
        'image',
        'stok',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function listBorrows()
    {
        return $this->hasMany(Borrow::class, 'book_id');
    }
}
