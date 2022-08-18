<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    use HasFactory;

    protected $fillable = [
        'time', 'city_id', 'old_humidity', 'old_temp'
    ];

    protected $touches = ['city'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
