<?php
namespace App\Repositories\Brand;

use App\Repositories\Brand\BrandInterface as BrandInterface;

use App\Models\Brand;

class BrandRepository implements BrandInterface{

    protected $brand;

    public function __construct(Brand $brand)
	{
        $this->brand = $brand;
    }


    public function id($id)
    {
        return $this->brand->find($id);
    }

    public function getAll()
    {
        return $this->brand->with(['outlets'=>function($x){
            $latitude = defaultLatLng()['lat'];
            $longitude = defaultLatLng()['lng'];
            $x->selectRaw("id,brand_id,name,picture,address,longitude,address,latitude,longitude,ROUND (
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
                AS jarak ,created_at,updated_at");
            $x->orderBy('jarak');
            $x->with('products');
        }])->get();
    }

    public function getAllPagination($page)
    {
        return $this->brand->paginate($page);
    }

    public function insert($data)
    {
        return $this->brand->create($data);
    }

    public function insertGetId($data)
    {
        return $this->brand->create($data)->id;
    }

    public function update($id, $data)
    {
        $brandData = $this->brand->find($id);
        if(isset($data['logo'])){
            removeFiles($brandData->logo);
        }
        if(isset($data['banner'])){
            removeFiles($brandData->banner);
        }
        $brandData->update($data);
        return $brandData;
    }

    public function delete($id)
    {
        $brandData = $this->brand->find($id)->delete();
        return $brandData;
    }


}