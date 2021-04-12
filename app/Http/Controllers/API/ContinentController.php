<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Continent;
use Illuminate\Http\Request;

class ContinentController extends Controller
{
    public function __invoke()
    {
        $continents = Continent::all();

        return response()->json([
            'continents' => $continents
        ]);
    }
}
