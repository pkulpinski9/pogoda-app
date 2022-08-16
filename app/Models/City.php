<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'city_json_id', 'current_temp', 'icon', 'humidity'
    ];

    /**
     * Get the user's first name.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
//    protected function data(): Attribute
//    {
//        return Attribute::make(
//            get: fn ($value) => json_decode($value, true),
//            set: fn ($value) => json_encode($value),
//        );
//    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
