<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable
{
    use HasApiTokens, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'country_code',
        'phone_number',
        'email',
        'password',
        'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = [
        'is_admin',
        'is_dietician',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class,'user_role');
    }

	public function customer()
    {
        return $this->hasOne(Customer::class);
    }

    public function getIsDieticianAttribute()
    {
        return $this->roles->pluck('id')->contains(Role::DIETICIAN);
    }

    public function getIsAdminAttribute()
    {
        return $this->roles->pluck('id')->contains(Role::ADMIN);
    }

    public function getIsCustomerAttribute()
    {
        return $this->roles->pluck('id')->contains(Role::USER);
    }

    public function scopeSearch($query, array $option)
    {
        $query->when($option['search'] ?? null, function($q, $keyword) {
            $q->where('name', 'LIKE', "%".$keyword."%")
                ->orWhere('email', 'LIKE', "%".$keyword."%")
                ->orWhere('phone_number', 'LIKE', "%".$keyword."%");
        });
    }
    public function scopeSort($query, array $option)
    {
        $query->when($option['sortBy'] ?? null, function($q) use($option) {
            $direction = $option['sortDesc'][0] == 'true' ? 'desc': 'asc';

            switch ($option['sortBy'][0]) {
                case 'name':
                    $q->orderBy('name', $direction);
                    break;
                case 'email':
                    $q->orderBy('email', $direction);
                    break;
                case 'status':
                    $q->orderBy('status', $direction);
                    break;
                default:
                    $q->orderBy('created_at', $direction);
                    break;
            }
        });
    }

    public function scopeHasRole($q, $roleId)
    {
        return $q->whereHas('roles', function($q) use($roleId){
            return $q->whereId($roleId);
        });
    }

}
