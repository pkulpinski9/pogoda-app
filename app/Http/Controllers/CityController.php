<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Archive;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class CityController extends Controller
{
    public function index()
    {
        $user = Auth::User();
        $city = 0;

        if (request('search'))
        {
            return $this->store();
        }

        if (count($user->cities)>0)
        {
            $city = $user->cities[0];
        }


        return view('home', [
            'user' => Auth::User(),
            'city' => $city
        ]);

    }
    public function store()
    {
        $cityFirst = City::all()->first();
        $user = Auth::User();
        $apiKey = config('services.openweather.key');
        $location = request('search');
        $location = Str::ucfirst($location);
        $string = file_get_contents("../storage/city.list.json");
        $response = json_decode($string, true);
        $response = collect($response)->where("name","LIKE","{$location}")->first();

        if (json_encode($response) == "null")
        {
            return redirect()->route('home')->with('mssg', 'Nie znaleziono miasta o podanej nazwie.');
        }
        $city_id = $response['id'];

        City::storeCity($response, $apiKey, $location, $city_id);

        City::attachCity($user, $city_id);

        return redirect()->route('detailed_weather',1);
    }

    public function show(City $city)
    {
        if(request('submit') == "store")
        {
            return $this->store();
        }

        return view('detailed_weather', [
            'user' => Auth::User(),
            'city' => $city
        ]);
    }
    public function detach(City $city)
    {
        $user = Auth::User();
        $user->cities()->detach($city);

        return redirect()->route('home');
    }
}
