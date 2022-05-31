<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OPDSchedule extends Model
{
    use HasFactory;
    use SoftDeletes;

	protected $table = 'opd_schedules';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'opd_category_id',
		'doctor_name',
		'doctor_qualifications',
		'gender',
		'address',
		'pincode',
		'state',
        'hospital_name',
		'contact_number_1',
		'contact_number_2',
		'schedules',
    ];

	protected $casts = [
        'schedules' => 'array',
    ];

	/**
	 * Get the OPDCategory that owns the OPDSchedule
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function OPDCategory(): BelongsTo
	{
		return $this->belongsTo(OPDCategory::class, 'opd_category_id');
	}

	public function scopeSearch($query, array $option)
    {
        $query->when($option['search'] ?? null, function($q, $keyword) {
            $q->where('doctor_name', 'LIKE', "%{$keyword}%")
            	->orWhere('address', 'LIKE', "%{$keyword}%")
            	->orWhere('pincode', 'LIKE', $keyword)
            	->orWhere('state', 'LIKE', "%{$keyword}%")
            	->orWhere('hospital_name', 'LIKE', "%{$keyword}%")
            	->orWhere('contact_number_1', 'LIKE', "%{$keyword}%")
            	->orWhere('contact_number_2', 'LIKE', "%{$keyword}%")
            	->orWhere(function($q) use($keyword){
					$q->whereHas('OPDCategory', function($q) use ($keyword){
						$q->where('name', 'LIKE', $keyword);
					});
				});
        });
    }

	public function scopeFilterByOPDCategoryId($query, string $opd_category_id = null)
    {
        $query->when($opd_category_id ?? null, function($q, $opd_category_id) {
			$q->where('opd_category_id', 'LIKE', $opd_category_id);
        });
    }

	public function scopeFilterByDays($query, array $days = null)
    {
        $query->when($days ?? null, function($q, $days) {
			$q->whereJsonContains('schedules->days', $days);
        });
    }

    public function scopeSort($query, array $option)
    {
        $query->when($option['sortBy'] ?? null, function($q) use($option) {
            $direction = $option['sortDesc'][0] == 'true' ? 'desc': 'asc';

            switch ($option['sortBy'][0]) {
                case 'doctor_name':
                    $q->orderBy('doctor_name', $direction);
                    break;
				case 'pincode':
                    $q->orderBy('pincode', $direction);
                    break;
				case 'state':
                    $q->orderBy('state', $direction);
                    break;
                case 'hospital_name':
                    $q->orderBy('hospital_name', $direction);
                    break;
				case 'opd_category':
					$q->join('opd_categories', 'opd_categories.id', '=', 'opd_schedules.opd_category_id')
                    ->orderBy('users.name', $direction);
                    break;
                default:
                    $q->orderBy('id', $direction);
                    break;
            }
        });
    }
}
