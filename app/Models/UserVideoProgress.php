<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserVideoProgress extends Model
{
    use HasFactory;
    protected $table = 'user_video_progress';

    // Какие поля можно массово заполнять
    protected $fillable = [
        'user_id',
        'video_id',
        'progress'
    ];

    // Связь с пользователем
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Связь с видео
    public function video()
    {
        return $this->belongsTo(Video::class);
    }
}
