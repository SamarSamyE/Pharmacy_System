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
    ];
    public function pharmacies(){
        return $this->hasOne(Area::class);
    }
}
