<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CityController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        $cities = City::latest();

        $location = 'warsaw';
        $apiKey = config('services.openweather.key');

        if(request('search')){
            $location = request('search');
        }

        $response = [
            'name' => (Http::get("https://api.openweathermap.org/data/2.5/weather?q={$location}&units=metric&appid={$apiKey}"))->json()['name'],
            'data' => (Http::get("https://api.openweathermap.org/data/2.5/weather?q={$location}&units=metric&appid={$apiKey}"))->json()
        ];

//        $input = [
//            'name' => 'City Name',
//            'data' => [
//                '1' => 'One',
//                '2' => 'Two',
//                '3' => 'Three'
//            ]
//        ];
//        dump($response);
        if(City::where('name', $response['name'])->exists()){
            redirect('/home')->with('mssg', 'juz jest');
        }else{
            $city = City::create($response);
        }

//
//        dd($city->data);

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
