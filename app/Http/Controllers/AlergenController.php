<?php

namespace App\Http\Controllers;

use App\Models\Alergen;
use Illuminate\Http\Request;

class AlergenController extends Controller
{
    public function index()
    {
        $alergens = Alergen::all();
        return view('alergen.index', [
            'alergens' => $alergens
        ]);
    }

    public function view(Alergen $alergen)
    {
        return view(
            'alergen.view', ['alergen' => $alergen]);
    }
}
