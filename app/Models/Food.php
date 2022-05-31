<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Food extends Model
{
    use SoftDeletes;

    protected $table = 'foods';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'type',
        'use_for',
        'details',
    ];

    protected $appends = ['type_label', 'use_for_label'];

    public function image()
    {
        return $this->morphOne('App\Models\Image', 'model');
    }

    protected $casts = [
        'details' => 'array',
        'use_for' => 'array',
    ];

    public function getUseForLabelAttribute()
    {
        $use_for_label = [];
        foreach($this->use_for ?? []  as $slot){
            if(isset(SLOTS[$slot])){
                $use_for_label[] = SLOTS[$slot];
            }
        }
        return $use_for_label;
    }

    public function getTypeLabelAttribute()
    {
        return FOODTYPES[$this->type] ?? '--';
    }

    public function scopeSearch($query, array $option)
    {
        $query->when($option['search'] ?? null, function($q, $keyword) {
            $q->where('name', 'LIKE', "%".$keyword."%");
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
                default:
                    $q->orderBy('created_at', $direction);
                    break;
            }
        });
    }
}
