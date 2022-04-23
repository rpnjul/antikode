<?php

namespace App\Repositories\Product;

interface ProductInterface {
    
    public function id($id);
    public function getAll();
    public function getAllPagination($page);
    public function insert($data);
    public function update($id, $data);
    public function delete($id);
}