<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Outlet;
use App\Models\Brand;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';

    protected $fillable = [
        'name', 'picture', 'price', 'discount', 'picture', 'brand_id', 'outlet_id'
    ];


    public function outlet()
    {
        return $this->belongsTo(Outlet::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
