<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Outlet;

class Brand extends Model
{
    use HasFactory;


    protected $table = 'brand';

    protected $fillable = [
        'name', 'logo', 'banner',
    ];


    public function outlets()
    {
        return $this->hasMany(Outlet::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
