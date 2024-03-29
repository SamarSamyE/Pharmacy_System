<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;

class Pharmacy extends Model
{
    use HasRoles;
    use HasFactory,SoftDeletes;
   protected $table="pharmacies";

    protected $fillable = [
        'national_id',
        'area_id',
        'priority',
    ];

    protected $dates = ['deleted_at'];

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

    public function area(){
        return $this->belongsTo(Area::class);
    }

    public function getAreaNameAttribute(){
        return $this->area->name;
    }

}
