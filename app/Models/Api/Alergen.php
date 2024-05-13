<?php

namespace App\Models\Api;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

class Alergen extends \App\Models\Alergen
{
    public function getRouteKeyName()
    {
        return 'id';
    }

}
