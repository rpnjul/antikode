<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Repositories\Product\ProductInterface as ProductInterface;

class ProductController extends Controller
{
    private $productRepository;

    public function __construct(ProductInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    
    public function index()
    {
        $Product = $this->productRepository->getAll();
        return responseApi($Product);
    }

    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'outlet_id'     => 'required|exists:outlet,id',
            'brand_id'      => 'required|exists:brand,id',
            'name'          => 'required|regex:/^[A-Za-z0-9? ,&_-]+$/',
            'picture'       => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'price'         => 'required|numeric|min:1',
            
        ]);
        if($validator->fails()){
            return responseApi(null,deep_array_message($validator->errors()));
        }

        $data = $request->all();
        $img = uploadFiles($request->file(),'products');
        $data = array_merge($data,$img);
        $Product = $this->productRepository->insert($data);
        return responseApi($Product,["Success"],true);
        
    }

    
    public function show($id)
    {
        $validator = Validator::make(['Product_id'=>$id],[
            'Product_id' => 'required|exists:Product,id',
        ]);
        if($validator->fails()){
            return responseApi(null,deep_array_message($validator->errors()));
        }
        $Product = $this->productRepository->id($id);
        return responseApi($Product);
    }

    
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'name'          => 'nullable|regex:/^[A-Za-z0-9? ,&_-]+$/',
            'picture'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'price'         => 'nullable|numeric|min:1',
            
        ]);
        if($validator->fails()){
            return responseApi(null,deep_array_message($validator->errors()));
        }

        $data = $request->all();
        if(count($request->file())>0){
            $img = uploadFiles($request->file(),'products');
            $data = array_merge($data,$img);
        }
        $Product = $this->productRepository->update($id,$data);
        return responseApi($Product,["Success"],true);
    }

   
    public function destroy($id)
    {
        $validator = Validator::make(['product'=>$id],[
            'product'   => 'required|exists:product,id'
        ]);
        if($validator->fails()){
            return responseApi(null,deep_array_message($validator->errors()));
        }
        $Product = $this->productRepository->delete($id);
        return responseApi(null,["Success"],true);
    }
}
