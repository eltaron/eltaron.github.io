<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_en',
        'name_ar',
        'country',
    ];


    protected $appends = ['name'];
    protected $hidden = [
        'name_ar', 'name_en'
    ];

    public function getNameAttribute()
    {
        if (lang() == 'ar') {
            return $this->attributes['name_ar'];
        } else {
            return $this->attributes['name_en'];
        }
    }

    public function users()
    {
        return $this->hasMany('App\Models\User', 'city_id');
    }

    public function agents()
    {
        return $this->hasMany('App\Models\User', 'city_id');
    }
}
