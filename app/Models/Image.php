<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $fillable = [
        'ads_id',
        'url',
        'blog_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function ads()
    {
        return $this->belongsTo('App\Models\Ads', 'ads_id');
    }
    public function blog()
    {
        return $this->belongsTo('App\Models\Blog', 'blog_id');
    }
}
