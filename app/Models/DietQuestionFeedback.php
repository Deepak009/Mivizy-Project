<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\User;
use App\Models\DietChart;
use App\Models\QuestionSet;
class DietQuestionFeedback extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'feedback', 'user_id', 'question_set_id'
    ];

    protected $table = "diet_question_feedbacks";

    /**
    * The attributes that should be cast.
    *
    * @var array
    */
    protected $casts = [
        'feedback' => 'array',
    ];

    /**
     * Get the diet chart associated with the DietQuestionFeedback
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function dietChart(): HasOne
    {
        return $this->hasOne(DietChart::class);
    }

    /**
     * Get the user that owns the DietQuestionFeedback
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the question set that owns the DietQuestionFeedback
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function questionSet(): BelongsTo
    {
        return $this->belongsTo(QuestionSet::class);
    }

    public function scopeSearch($query, array $option)
    {
        $query->when($option['search'] ?? null, function($q, $keyword) {
            // dd($keyword);
            $q->whereHas('user', function($q) use($keyword) {
                $q->where('name', 'LIKE', "%".$keyword."%");
            });
        });
    }
    public function scopeSort($query, array $option)
    {
        $query->when($option['sortBy'] ?? null, function($q) use($option) {
            $direction = $option['sortDesc'][0] == 'true' ? 'desc': 'asc';

            switch ($option['sortBy'][0]) {
                case 'user.name':
                    $q->join('users', 'users.id', '=', 'diet_question_feedbacks.user_id')
                    ->orderBy('users.name', $direction);
                    break;
                default:
                    $q->orderBy('created_at', $direction);
                    break;
            }
        });
    }
}
