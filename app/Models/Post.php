<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'body',
        'privacy',
    ];

    function scopePublic($q) {
        return $q->where('privacy', 'public');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}