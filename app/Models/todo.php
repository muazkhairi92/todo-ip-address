<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->hasOne(Category::class);
    }
    public function iplog() 
    {
        return $this->hasOne(IPlog::class);
    }
}
