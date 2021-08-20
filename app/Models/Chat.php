<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'agent_id',
        'status',
        'type',
        'reason',
        'user_last_activity',
        'agent_last_activity',
        'ads_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $appends = [
        'time_ago'
    ];

    public function getTimeAgoAttribute(){
        return $this->created_at->diffForHumans();
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function agent()
    {
        return $this->belongsTo('App\Models\User', 'agent_id');
    }
    public function ads()
    {
        return $this->belongsTo('App\Models\Ads', 'ads_id');
    }
}
