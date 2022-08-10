<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CityController extends Controller
{
    public function index()
    {
//        $cities = City::latest();
//
//        $location = 'warsaw';
        $apiKey = config('services.openweather.key');

        if(request('search')){
            $location = request('search');


            $response = Http::get("https://api.openweathermap.org/data/2.5/weather?q={$location}&units=metric&appid={$apiKey}");

            dump($response->json());

            if(City::where('name', $response['name'])->doesntExist()){

                $saveToDb = [
                    'name' => $response->json()['name'],
                    'current_temp' => round($response->json()['main']['temp']),
                    'icon' => $response->json()['weather']['0']['icon'],
                    'humidity' => $response->json()['main']['humidity'],
                ];

//            dd($saveToDb);

                City::create($saveToDb);
            }

        }

        return view('home', [
            'cities' => City::all()
        ]);

    }

    public function show(City $city){

        return view('detailed_weather', [
            'cities' => City::all(),
            'city' => $city
        ]);
    }
}
