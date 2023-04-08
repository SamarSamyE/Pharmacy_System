<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;

class Area extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'address',
        'country_id'
    ];
    public function addresses()
    {
        return $this->hasMany(Address::class,'area_id');
    }
    public function pharmacies(){
        return $this->hasOne(Area::class);
    }
    public function country(){
        return $this->belongsTo(Country::class,'country_id');
    }

}
