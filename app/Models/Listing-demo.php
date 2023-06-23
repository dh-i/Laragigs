<?php

namespace App\Models;

class Listing
{
    public static function all()
    {
        return [[
            'id' => 1,
            'title' => 'Listing One',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui atque iure obcaecati? Quisquam, quod id. Voluptates ipsam, quasi incidunt reiciendis inventore libero id!'
        ], [
            'id' => 2,
            'title' => 'Listing Two',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui atque iure obcaecati? Quisquam, quod id. Voluptates ipsam, quasi incidunt reiciendis inventore libero id!'
        ]];
    }

    public static function find($id)
    {
        $listings = self::all();
        foreach ($listings as $listing) {
            if ($listing['id'] == $id) {
                return $listing;
            }
        }
    }
};
