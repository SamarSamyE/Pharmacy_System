<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;


class Patient extends Model
{
    use HasFactory;
    use HasRoles;
    use SoftDeletes;

    protected $fillable = [
        'national_id',
        'avatar',
        'gender',
        'birth_date',
        'mobile',
        'is_deleted',
    ];
    protected $dates = ['deleted_at'];
    public function type(){
        return $this->morphOne(User::class, 'typeable');
       }

    public function addresses()
    {
        return $this->hasMany(PatientAddress::class);
    }
    public function orders(){
        return $this->hasMany(Order::class);
    }
}
