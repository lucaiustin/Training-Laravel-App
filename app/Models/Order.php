<?php

namespace App\Models;

class Order extends Model
{
    protected $fillable = [
        'name', 'contact_details', 'comments', 'created_at',
    ];

    public function products()
    {
        return $this->belongsToMany('App\Models\Product');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
