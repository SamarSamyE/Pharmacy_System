<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class Pharmacy extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasRoles;

    protected $fillable = [
        'national_id',
        'area_id',
        'priority',
    ];

    public function type()
    {
        return $this->morphOne(User::class, 'typeable');
    }

    public function doctors(){
        return $this->hasMany(Doctor::class);
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function Pharmacy_name()
    {
        return $this->hasOne(User::class,'id');

    }
}
