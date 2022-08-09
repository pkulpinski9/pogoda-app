<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $location = 'warsaw';
        $apiKey = '94d634996e4998e7c1d0c4ed659893b3';

        if(request('search')){
            $location = request('search');
        }

        $response = Http::get("https://api.openweathermap.org/data/2.5/weather?q={$location}&units=metric&appid={$apiKey}");

        dump($response->json());


        return view('home', [
            'currentWeather' => $response->json(),
        ]);

    }
}
