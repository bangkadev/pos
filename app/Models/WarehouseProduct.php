<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WarehouseProduct extends Model
{
    use SoftDeletes;

    protected $fillable = ['product_id', 'warehouse_id', 'stock'];

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }  
    
    public function product () {
        return $this->belongsTo(Product::class);
    }
}
