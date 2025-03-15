<?php

namespace App\Models;

use App\Models\Video;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'image', 'price', 'features', 'category'];

    public function videos()
    {
        return $this->hasMany(Video::class);
    }
    public function curriculum()
    {
        return $this->hasMany(Curriculum::class);
    }
}
