<?php

namespace App\Models\webAdmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooterSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'prefix_line',
        'postfix_words'
    ];
}
