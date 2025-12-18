<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Snippet extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'language',
        'is_public',
    ];

    public function getRenderedContentAttribute()
    {
        if ($this->language === 'markdown') {
            return \Illuminate\Support\Str::markdown($this->content);
        }

        return $this->content;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
