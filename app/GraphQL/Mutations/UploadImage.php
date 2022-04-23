<?php

namespace App\GraphQL\Mutations;

final class UploadImage
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        return $args['image'];
    }
}
