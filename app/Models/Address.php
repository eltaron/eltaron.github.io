<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'agent_id',
        'city_id',
        'district',
        'title',
        'street',
        'floor_no',
        'land_mark',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'city_id' => 'integer',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'user_id',
        'city_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function agent()
    {
        return $this->belongsTo('App\Models\User', 'agent_id');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City', 'city_id');
    }
}
