<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BloodDonor extends Model
{
    protected $table = 'blood_donors';

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'name',
		'gender',
		'dob',
		'blood_group',
		'weight_in_kgs',
		'email',
		'mobile_number',
		'address',
		'pincode',
		'state',
    ];


    public function scopeSearch($query, array $option)
    {
        $query->when($option['search'] ?? null, function($q, $keyword) {
            $q->where('name', 'LIKE', "%".$keyword."%")
            	->orWhere('blood_group', 'LIKE', $keyword)
            	->orWhere('mobile_number', 'LIKE', $keyword)
            	->orWhere('pincode', 'LIKE', $keyword)
            	->orWhere('state', 'LIKE', $keyword)
            	->orWhere('email', 'LIKE', $keyword);
        });
    }

	public function scopeFilterByBloodGroup($query, string $blood_group = null)
    {
        $query->when($blood_group ?? null, function($q, $blood_group) {
            $q->where('blood_group', 'LIKE', $blood_group);
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
				case 'pincode':
                    $q->orderBy('pincode', $direction);
                    break;
				case 'state':
                    $q->orderBy('state', $direction);
                    break;
				case 'blood_group':
                    $q->orderBy('blood_group', $direction);
                    break;
                default:
                    $q->orderBy('id', $direction);
                    break;
            }
        });
    }
}
