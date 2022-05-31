<?php

namespace App\Models    ;

use App\Models\DietChartTemplate;
use Illuminate\Database\Eloquent\Model;

class DietChartTemplateItem extends Model
{
    protected $guarded = [];

    protected $appends = ['slot_label', 'day_of_week_label'];

    public function food()
    {
        return $this->belongsTo(Food::class);
    }

    public function dietChartTemplate()
    {
        return $this->belongsTo(DietChartTemplate::class);
    }

    public function getSlotLabelAttribute()
    {
        return SLOTS[$this->slot] ?? '--';
    }

    public function getDayOfWeekLabelAttribute()
    {
        return DAYS[$this->day_of_week] ?? '--';
    }
}
