<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class Doctor extends Model
{
    use HasFactory;
    use HasRoles,SoftDeletes;
    protected $fillable = [
        'national_id',
        'pharmacy_id',
        'is_banned',
    ];
    protected $dates = ['deleted_at'];
    public function type(){
        return $this->morphOne(User::class, 'typeable');
    }

    public function pharmacy(){
        return $this->belongsTo(Pharmacy::class);
    }


    // public function user(){
    //     return $this->morphMany(User::class);
    // }
}
