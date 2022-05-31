<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dietician extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeSearch($query, array $option)
    {
        $query->when($option['search'] ?? null, function ($q, $keyword) {
            $q->whereHas('user', function($q) use($keyword){
                $q->where('name', 'LIKE', "%".$keyword."%")
                    ->orWhere('email', 'LIKE', "%".$keyword."%")
                    ->orWhere('phone_number', 'LIKE', "%".$keyword."%");
            });
        });
    }

    public function scopeSort($query, array $option)
    {
        $query->when($option['sortBy'] ?? null, function ($q) use ($option) {
            $q->join('users', 'users.id', '=', 'dieticians.user_id');
            $direction = $option['sortDesc'][0] == 'true' ? 'desc': 'asc';

            switch ($option['sortBy'][0]) {
                case 'name':
                    $q->orderBy('users.name', $direction);
                    break;
                case 'email':
                    $q->orderBy('users.email', $direction);
                    break;
                case 'status':
                    $q->orderBy('users.status', $direction);
                    break;
                default:
                    $q->orderBy('dieticians.created_at', $direction);
                    break;
            }
        });
    }
}
