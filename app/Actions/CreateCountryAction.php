<?php 

namespace App\Actions;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CreateCountryAction {

    public static function run(Request $request) {
        Validator::make($request->all(), [
            'code' => 'required|string|unique:countries,code|max:2',
            'name' => 'required|string|max:64',
            'full_name' => 'required|string|max:128',
            'iso3' => 'required|string|max:3',
            'number' => 'required|integer|digits:3',
            'continent_code' => 'required|string|max:2',
            'display_order' => 'required|integer'
        ])->validate();

        $country = Country::create($request->all());

        return response()->json([
            'country' => $country
        ], 200);
    }

}