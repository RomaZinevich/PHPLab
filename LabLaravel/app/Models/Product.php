<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'price',
        'description',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(UserProduct::class, 'user_id');
    }

    public function getFormattedPriceAttribute()
    {
        return '$' . number_format($this->price, 2);
    }

    // Скорочення опису для відображення на сторінці продукту
    public function getShortDescriptionAttribute()
    {
        return substr($this->description, 0, 100) . '...';
    }
}
