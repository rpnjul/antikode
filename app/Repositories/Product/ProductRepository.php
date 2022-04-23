<?php
namespace App\Repositories\Product;

use App\Repositories\Product\ProductInterface as ProductInterface;

use App\Models\Product;

class ProductRepository implements ProductInterface{

    protected $product;

    public function __construct(Product $product)
	{
        $this->product = $product;
    }

    public function id($id)
    {
        return $this->product->find($id);
    }

    public function getAllPagination($page)
    {
        return $this->product->paginate($page);
    }

    public function getAll()
    {
        return $this->product->with(['brand'])->get();
    }

    public function insert($data)
    {
        return $this->product->create($data);
    }

    public function update($id, $data)
    {
        $ProductData = $this->product->find($id);
        if(isset($data['picture']) && isset($ProductData->picture)){
            removeFiles($ProductData->picture);
        }
        $ProductData->update($data);
        return $ProductData;
    }

    public function delete($id)
    {
        $ProductData = $this->product->find($id);
        $ProductData->delete();
        return $ProductData;
    }


}