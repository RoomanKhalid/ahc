<?php

namespace App\Models\webAdmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Clinic;

class Doctor extends Model
{
    use HasFactory;
    protected $fillable = [
        'clinic_id',
        'doctor_name',
        'short_description',
        'description',
        'appointment_duration',
        'doctor_profile_image',
        'mobile_no',
        'designation',
        'joining_date',
        'status',
        'type',
        'center',
        'expense',
        'bank_charges',
        'ayaan_percent',
        'doctor_percent'
    ];

    public function clinic() {
        return $this->hasOne('App\Models\Clinic', 'id', 'clinic_id');
    }
}
