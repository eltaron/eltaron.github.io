<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agent extends Authenticatable
{
    use SoftDeletes;

    use Notifiable;

    protected $table = "agents";
    protected $guarded = array();
}
