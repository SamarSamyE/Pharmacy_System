<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Doctor extends Model
{
    use HasFactory;
    use HasRoles;
    protected $fillable = [
        'national_id',
        'pharmacy_id',
        'is_banned',
    ];

    public function type()
    {
        return $this->morphOne(User::class, 'typeable');
    }

    public function pharmacy(){
        return $this->belongsTo(Pharmacy::class);
    }
}
