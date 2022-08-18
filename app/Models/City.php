<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
