<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'image', 'price', 'features', 'category'];

    public function curriculum()
    {
        return $this->hasMany(Curriculum::class);
    }
}
