<?php

namespace App\GraphQL\Mutations;

use App\Models\Brand;
use App\Models\Outlet;
use App\Models\Product;

class FileUpload
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        return $args['image'];
    }
}