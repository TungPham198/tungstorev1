<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository extends BaseRepository
{
    /**
     * Model name
     *
     * @var string $modelName
     */
    protected $modelName = Product::class;
    
}
