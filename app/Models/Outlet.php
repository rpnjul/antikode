<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Brand;
use DB;

class Outlet extends Model
{
    use HasFactory;

    protected $table = 'outlet';

    protected $fillable = [
        'name', 'address', 'latitude', 'longitude', 'brand_id', 'picture', 'address'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function getDistance() {
        $latitude = defaultLatLng()['lat'];
        $longitude = defaultLatLng()['lng'];
        $data = DB::table($this->table)->selectRaw("ROUND (
            (  6371
             * ACOS (
                                COS (RADIANS (latitude))
                            * COS (
                                     RADIANS ($latitude))
                            * COS (
                                         RADIANS ($longitude)
                                     - RADIANS (longitude))
                        +   SIN (RADIANS (latitude))
                            * SIN (
                                     RADIANS ($latitude)))),
            2)
            AS distance ,created_at,updated_at")->where('id',$this->id)->orderByRaw('distance asc')->first();
        return array(
            "distance" => $data->distance.' km'
        );
    }

}
