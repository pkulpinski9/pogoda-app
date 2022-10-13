<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'city_json_id', 'name', 'country', 'pressure', 'current_temp', 'icon', 'humidity'
    ];

    /**
     * Get the user's first name.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    public function archives()
    {
        return $this->hasMany(Archive::class);
    }
    public static function storeCity($response, $apiKey, $location, $city_id)
    {
        if (City::where('city_json_id', $response['id'])->doesntExist()) {
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
    }
    public static function attachCity($user, $city_id)
    {
        $city = City::where('city_json_id', $city_id)->first();
        $attach = $city->users()->syncWithoutDetaching($user);
    }
}
