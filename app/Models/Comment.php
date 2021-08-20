<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'agent_id',
        'user_name',
        'email',
        'blog_id',
        'ads_id',
        'comment',
        'status',
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

    public function blog()
    {
        return $this->belongsTo('App\Models\Blog', 'blog_id');
    }

    public function ads()
    {
        return $this->belongsTo('App\Models\Ads', 'ads_id');
    }
}
