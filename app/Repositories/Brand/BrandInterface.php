<?php

namespace App\Repositories\Brand;

interface BrandInterface {
    
    public function id($id);
    public function getAll();
    public function getAllPagination($page);
    public function insert($data);
    public function insertGetId($data);
    public function update($id, $data);
    public function delete($id);
}