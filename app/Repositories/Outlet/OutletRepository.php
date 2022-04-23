<?php
namespace App\Repositories\Outlet;

use App\Repositories\Outlet\OutletInterface as OutletInterface;

use App\Models\Outlet;

class OutletRepository implements OutletInterface{

    protected $outlet;

    public function __construct(Outlet $outlet)
	{
        $this->outlet = $outlet;
    }


    public function id($id)
    {
        return $this->outlet->find($id);
    }

    public function getAllPagination($page)
    {
        return $this->outlet->paginate($page);
    }

    public function getAll()
    {
        $latitude = defaultLatLng()['lat'];
        $longitude = defaultLatLng()['lng'];
        return $this->outlet->selectRaw("id,brand_id,name,picture,address,longitude,address,latitude,longitude,ROUND (
            (  6371
             * ACOS (
                        COS (RADIANS (latitude))
                        * COS ( RADIANS ($latitude))
                        * COS ( RADIANS ($longitude) - RADIANS (longitude))
                        + SIN ( RADIANS (latitude))
                        * SIN ( RADIANS ($latitude)))),
            2)
            AS jarak ,created_at,updated_at")->with(['products'])->orderByRaw('jarak asc')->get();
    }

    public function insert($data)
    {
        return $this->outlet->create($data);
    }

    public function update($id, $data)
    {
        $OutletData = $this->outlet->find($id);
        if(isset($data['picture'])){
            removeFiles($OutletData->picture);
        }
        $OutletData->update($data);
        return $OutletData;
    }

    public function delete($id)
    {
        $OutletData = $this->outlet->find($id);
        $OutletData->delete();
        return $OutletData;
    }


}