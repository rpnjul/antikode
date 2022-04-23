<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Repositories\Brand\BrandInterface as BrandInterface;


class BrandController extends Controller
{

    private $brandRepository;

    public function __construct(BrandInterface $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }
    
    public function index()
    {
        $brand = $this->brandRepository->getAll();
        return responseApi($brand);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'      => 'required|regex:/^[A-Za-z0-9? ,_-]+$/',
            'logo'      => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'banner'    => 'required|image|mimes:jpeg,png,jpg|max:2048',
            
        ]);
        if($validator->fails()){
            return responseApi(null,deep_array_message($validator->errors()));
        }

        $data = $request->all();
        $img = uploadFiles($request->file());
        $data = array_merge($data,$img);
        $brand = $this->brandRepository->insert($data);
        return responseApi($brand,["Success"],true);
        
    }

    public function show($id)
    {
        $brand = $this->brandRepository->id($id);
        return responseApi($brand);
    }

    
    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(),[
            'name'      => 'required|regex:/^[A-Za-z0-9? ,_-]+$/',
            'logo'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'banner'    => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            
        ]);
        if($validator->fails()){
            return responseApi(null,deep_array_message($validator->errors()));
        }

        $data = $request->all();
        if(count($request->file())>0){
            $img = uploadFiles($request->file());
            $data = array_merge($data,$img);
        }
        $brand = $this->brandRepository->update($id,$data);
        return responseApi($brand,["Success"],true);
    }

   
    public function destroy($id)
    {
        $validator = Validator::make(['brand_id'=>$id],[
            'brand_id'   => 'required|exists:brand,id'
        ]);
        if($validator->fails()){
            return responseApi(null,deep_array_message($validator->errors()));
        }
        $brand = $this->brandRepository->delete($id);
        return responseApi($brand,["Success"],true);
    }

}
