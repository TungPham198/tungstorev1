<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    // protected $table = 'product';

    protected $fillable = [
        'sku',
        'slug',
        'name',
        'import_price',
        'price',
        'amount',
        'category_id',
        'summary',
        'des',
        'status',
        'images'
    ];

    protected $hidden = [
        
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
}
