<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BloodRequest extends Model
{
    protected $table = 'blood_requests';

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'blood_group',
		'number_of_unit',
		'mobile_number',
		'patient_name',
		'patient_age',
		'hospital_name',
		'purpose',
		'address',
		'state',
		'pincode',
		'user_id',
		'note',
    ];

	/**
     * Get the user that owns the DietQuestionFeedback
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

	public function scopeSearch($query, array $option)
    {
        $query->when($option['search'] ?? null, function($q, $keyword) {
            $q->where('patient_name', 'LIKE', "%{$keyword}%")
            	->orWhere('blood_group', 'LIKE', $keyword)
            	->orWhere('mobile_number', 'LIKE', $keyword)
            	->orWhere('hospital_name', 'LIKE', "%{$keyword}%")
            	->orWhere('pincode', 'LIKE', $keyword)
            	->orWhere('state', 'LIKE', $keyword);
        });
    }

	public function scopeFilterByGroup($query, string $group = null)
    {
        $query->when($group ?? null, function($q, $group) {
            $q->where('blood_group', 'LIKE', $group);
        });
    }

	public function scopeFilterByUserId($query, string $user_id = null)
    {
        $query->when($user_id ?? null, function($q, $user_id) {
            $q->where('user_id', $user_id);
        });
    }

    public function scopeSort($query, array $option)
    {
        $query->when($option['sortBy'] ?? null, function($q) use($option) {
            $direction = $option['sortDesc'][0] == 'true' ? 'desc': 'asc';

            switch ($option['sortBy'][0]) {
                case 'patient_name':
                    $q->orderBy('patient_name', $direction);
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
