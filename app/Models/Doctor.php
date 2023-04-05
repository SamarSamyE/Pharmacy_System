<?php

namespace App\Models;
use Cog\Contracts\Ban\Bannable as BannableInterface;
use Cog\Laravel\Ban\Traits\Bannable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class Doctor extends Model implements BannableInterface
{
    use HasFactory;
    use Bannable;
    use HasRoles,SoftDeletes;
    protected $fillable = [
        'national_id',
        'pharmacy_id',
        'banned_at',
    ];
    protected $dates = ['deleted_at'];
    public function type(){
        return $this->morphOne(User::class, 'typeable');
    }

    public function pharmacy(){
        return $this->belongsTo(Pharmacy::class);
    }


}
