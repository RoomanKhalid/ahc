<?php

namespace App\Models\webAdmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Popup extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'image',
        'status'
    ];
}