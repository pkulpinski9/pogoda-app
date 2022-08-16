<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class CityController extends Controller
{
    public function index()
    {
        if(request('search')) {
            return $this->store();
        }


        return view('home', [
            'user' => Auth::User()
        ]);

    }
    public function store(){

        $cityFirst = City::all()->first();
        $user = Auth::User();
        $apiKey = config('services.openweather.key');

        $location = request('search');
        $location = Str::ucfirst($location);
        $string = file_get_contents("../storage/city.list.json");
        $response = json_decode($string, true);
        $response = collect($response)->where("name","LIKE","{$location}")->first();


        $city_id = $response['id'];

        if (City::where('city_json_id', $response['id'])->doesntExist()){

            $responseApi = Http::get("https://api.openweathermap.org/data/2.5/weather?q={$location}&units=metric&appid={$apiKey}");
            $saveToDb = [
                'city_json_id' => $response['id'],
                'name' => $response['name'],
                'current_temp' => round($responseApi->json()['main']['temp']),
                'icon' => $responseApi->json()['weather']['0']['icon'],
                'humidity' => $responseApi->json()['main']['humidity'],
            ];

            City::create($saveToDb);

        }

        City::where('city_json_id', $city_id)->first()->users()->syncWithoutDetaching($user);

        return $this->show($cityFirst);
    }

    public function show(City $city){

        if(request('search')) {
            return $this->store();
        }

        return view('detailed_weather', [
            'user' => Auth::User(),
            'city' => $city
        ]);
    }

    public function detach(City $city){
        $user = Auth::User();
        $user->cities()->detach($city);

        if(request('search')) {
            return $this->store();
        }

        dump($user);

        return view('detailed_weather', [
            'user' => Auth::User(),
            'city' => $city
        ]);
    }
}
