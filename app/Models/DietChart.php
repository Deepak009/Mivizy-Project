<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\DietQuestionFeedback;
class DietChart extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function dietQuestionFeedback()
    {
        return $this->belongsTo(DietQuestionFeedback::class);
    }

    public function dietician()
    {
        return $this->belongsTo(User::class, 'dietician_id');
    }

    public function dietChartItems()
    {
        return $this->hasMany(DietChartItem::class);
    }

    /**
	 * This function will filter by user
	 *
	 * @param								$query
	 * @param  User						    $user
	 * @return Model
	 */
	public function scopeFilterByUser($query, User $user = null)
	{
		if (!empty($user)) {
			return $query->whereHas("dietQuestionFeedback", function($query) use($user){
				$query->where('user_id', $user->id);
			});
		}
		return $query;
	}
}
