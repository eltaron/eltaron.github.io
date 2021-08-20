<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentLike extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'agent_id',
        'ads_id',
        'blog_id',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

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
    public function blog()
    {
        return $this->belongsTo('App\Models\Blog', 'blog_id');
    }
}
