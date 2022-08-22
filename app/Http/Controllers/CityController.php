<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Archive;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class CityController extends Controller
{
    public function index()
    {
        $user = Auth::User();
        $city = 0;

        if (request('search')){
            return $this->store();
        }

        if (count($user->cities)>0){
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

        if (json_encode($response) == "null"){
            return redirect()->route('home')->with('mssg', 'Nie znaleziono miasta o podanej nazwie.');
        }
        $city_id = $response['id'];

        if (City::where('city_json_id', $response['id'])->doesntExist())
        {

            $responseApi = Http::get("https://api.openweathermap.org/data/2.5/weather?q={$location}&units=metric&appid={$apiKey}");
            $saveCityToDb = [
                'city_json_id' => $response['id'],
                'name' => $response['name'],
                'current_temp' => round($responseApi->json()['main']['temp']),
                'country' => $responseApi->json()['sys']['country'],
                'icon' => $responseApi->json()['weather']['0']['icon'],
                'humidity' => $responseApi->json()['main']['humidity'],
                'pressure' => $responseApi->json()['main']['pressure']
            ];
            City::create($saveCityToDb);

            $saveArchiveToDb = [
                'city_id' => City::where('city_json_id', $city_id)->first()->id,
                'old_humidity' => $responseApi->json()['main']['humidity'],
                'old_temp' => round($responseApi->json()['main']['temp'])
            ];
            Archive::create($saveArchiveToDb);

        }

        $city = City::where('city_json_id', $city_id)->first();

        $attach = $city->users()->syncWithoutDetaching($user);

        return redirect()->route('detailed_weather',($city));
    }

    public function show(City $city)
    {
        $dataHumidity = array();

        foreach($city->archives as $archive) {
            $y = $archive->old_humidity;
            $x = $archive->created_at->format('Y-m-d H:i:s');
            array_push($dataHumidity, ["label" => $x, "y" => $y]);
        }

        $dataTemp = array();

        foreach($city->archives as $archive) {
            $y = $archive->old_temp;
            $x = $archive->created_at->format('Y-m-d H:i:s');
            array_push($dataTemp, ["label" => $x, "y" => $y]);
        }

        if(request('submit') == "store") {
            return $this->store();
        }

//        dd($city);

        return view('detailed_weather', [
            'user' => Auth::User(),
            'city' => $city,
            'dataHumidity' => $dataHumidity,
            'dataTemp' => $dataTemp
        ]);
    }
    public function detach(City $city)
    {
        $user = Auth::User();
        $user->cities()->detach($city);

        return redirect()->route('home');
    }
}
