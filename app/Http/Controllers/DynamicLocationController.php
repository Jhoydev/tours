<?php

namespace App\Http\Controllers;

use App\City;
use App\Country;
use App\State;
use Illuminate\Http\Request;

class DynamicLocationController extends Controller
{
    /*
        **
        * Get all the countries.
        *
        * @return \Illuminate\Http\Response
    */
    public function get_countries()
    {
        $countries = Country::orderBy('name', 'ASC')->pluck('name', 'id')->all();

        return response()->json($countries);
    }

    /**
     * Get all the states by country.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_states_by_country($country_id)
    {
        $states = State::select('name','id')->Where("country_id", $country_id)->orderBy('name', 'ASC')->get();

        return response()->json($states);
    }

    /**
     * Get all the cities by state.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_cities_by_state($state_id)
    {
        $cities = City::select('name','id')->where("state_id", $state_id)->orderBy('name', 'ASC')->get();
        return response()->json($cities);
    }
}
