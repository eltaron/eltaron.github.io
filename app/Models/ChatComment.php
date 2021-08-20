<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatComment extends Model
{
    use HasFactory;
    protected $fillable = [
        'chat_id',
        'content',
        'image',
        'record',
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

    public function chat()
    {
        return $this->belongsTo('App\Models\Chat', 'chat_id');
    }
}
