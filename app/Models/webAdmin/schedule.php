<?php

namespace App\Models\webAdmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class schedule extends Model
{
    use HasFactory;
    protected $fillable = [
        'doctor_id',
        'schedule_by',
        'date',
        'day',
        'start_time',
        'end_time',
        'status'
    ];

    public function doctor() {
        return $this->hasOne('App\Models\webAdmin\Doctor', 'id', 'doctor_id');
    }
}
