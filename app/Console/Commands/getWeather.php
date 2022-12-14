<?php

namespace App\Console\Commands;

use App\Models\Archive;
use App\Models\City;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class getWeather extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'getWeather:current';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download current weather data';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $apiKey = config('services.openweather.key');
        $ids = City::all('city_json_id');

        $ids = $ids->pluck('city_json_id');

        foreach ($ids as $id) {
            $city = City::where('city_json_id', $id)->first();

            $response = Http::get("https://api.openweathermap.org/data/2.5/weather?id={$id}&units=metric&appid={$apiKey}");
            $city->current_temp = round($response->json()['main']['temp']);
            $city->country = $response->json()['sys']['country'];
            $city->icon = $response->json()['weather']['0']['icon'];
            $city->humidity = $response->json()['main']['humidity'];
            $city->pressure = $response->json()['main']['pressure'];

            $city->save();

            $saveArchiveToDb = [
                'city_id' => $city->id,
                'old_humidity' => $city->humidity,
                'old_temp' => $city->current_temp
            ];
            Archive::create($saveArchiveToDb);
        }
    }
}
