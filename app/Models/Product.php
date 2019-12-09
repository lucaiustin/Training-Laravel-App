<?php

namespace App\Models;

class Product extends Model
{
    protected $fillable = [
        'title', 'description', 'price', 'image_name',
    ];

    public function orders()
    {
        return $this->belongsToMany('App\Models\Order');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
