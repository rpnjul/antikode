<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Repositories\Outlet\OutletInterface as OutletInterface;

class OutletController extends Controller
{
    private $outletRepository;

    public function __construct(OutletInterface $outletRepository)
    {
        $this->outletRepository = $outletRepository;
    }
    
    public function index()
    {
        $outlet = $this->outletRepository->getAll();
        return responseApi($outlet);
    }

    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'          => 'required|regex:/^[A-Za-z0-9? ,_-]+$/',
            'brand_id'      => 'required|exists:brand,id',
            'picture'       => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'address'       => 'required',
            'latitude'      => 'required|numeric|between:-90,90',
            'longitude'     => 'required|numeric|between:-180,180',
            
        ]);
        if($validator->fails()){
            return responseApi(null,deep_array_message($validator->errors()));
        }

        $data = $request->all();
        $img = uploadFiles($request->file());
        $data = array_merge($data,$img);
        $outlet = $this->outletRepository->insert($data);
        return responseApi($outlet,["Success"],true);
        
    }

    
    public function show($id)
    {
        $validator = Validator::make(['outlet_id'=>$id],[
            'outlet_id' => 'required|exists:outlet,id',
        ]);
        if($validator->fails()){
            return responseApi(null,deep_array_message($validator->errors()));
        }
        $outlet = $this->outletRepository->id($id);
        return responseApi($outlet);
    }

    
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'name'      => 'nullable|regex:/^[A-Za-z0-9? ,_-]+$/',
            'picture'   => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'address'   => 'nullable',
            'latitude'  => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            
        ]);
        if($validator->fails()){
            return responseApi(null,deep_array_message($validator->errors()));
        }

        $data = $request->all();
        if(count($request->file())>0){
            $img = uploadFiles($request->file());
            $data = array_merge($data,$img);
        }
        $outlet = $this->outletRepository->update($id,$data);
        return responseApi($outlet,["Success"],true);
    }

   
    public function destroy($id)
    {
        $validator = Validator::make(['outlet_id'=>$id],[
            'outlet_id'   => 'required|exists:outlet,id'
        ]);
        if($validator->fails()){
            return responseApi(null,deep_array_message($validator->errors()));
        }
        $outlet = $this->outletRepository->delete($id);
        return responseApi(null,["Success"],true);
    }
}
