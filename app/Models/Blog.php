<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'text',
        'allow_comment',
        'status',
        'special',
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
        return $this->belongsTo('App\Models\User','user_id');
    }
    public function agent()
    {
        return $this->belongsTo('App\ModelsApp\Models\User', 'agent_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'blog_id');
    }
    public function images()
    {
        return $this->hasMany('App\Models\Image', 'blog_id');
    }
    public function image()
    {
        return $this->hasOne('App\Models\Image', 'blog_id');
    }

}
