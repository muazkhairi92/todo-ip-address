<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IPlog extends Model
{
    use HasFactory;

    protected $table = "ip_logs";

    protected $fillable = [
        'ip_address',
    ];
}
