<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'external_app_id',
        'name',
        'country_code',
        'phone_number',
        'email',
        'date_of_birth'
    ];

    protected $appends = [
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getStatusAttribute()
    {
        return optional($this->user)->status ?? false;
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
                case 'phone_number':
                    $q->orderBy('phone_number', $direction);
                    break;
                default:
                    $q->orderBy('created_at', $direction);
                    break;
            }
        });
    }
}
