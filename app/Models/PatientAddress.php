<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;

class PatientAddress extends Model
{
    use HasFactory;
    protected $fillable = [

        'patient_id',
        'area_id',
        'street_name',
        'build_number',
        'floor_number',
        'flat_number',
        'is_main',
        'is_deleted',
    ];

    public function patient(){
        return $this->belongsTo(Patient::class);
    }

    public function area(){
        return $this->belongsTo(Area::class);
    }
}
