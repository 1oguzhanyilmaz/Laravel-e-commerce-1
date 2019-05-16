<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductAttr_model extends Model
{
    protected $table='product_att';
    protected $primaryKey='id';
    protected $fillable=[
        'products_id',
        'sku',
        'color',
        'size',
        'price',
        'stock'
    ];
}
