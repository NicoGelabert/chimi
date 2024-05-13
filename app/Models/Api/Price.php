<?php

namespace App\Models\Api;

class Price extends \App\Models\Price
{
    public function getRouteKeyName()
    {
        return 'id';
    }
}
