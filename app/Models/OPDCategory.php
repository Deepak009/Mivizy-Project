<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OPDCategory extends Model
{
    use HasFactory;

	protected $table = 'opd_categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'name',
    ];

	/**
	 * Get all of the OPDSchedules for the OPDCategory
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function OPDSchedules(): HasMany
    {
		return $this->hasMany(OPDSchedule::class);
    }
}
