<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DietChartItem extends Model
{
    protected $guarded = [];

    protected $appends = ['slot_label', 'day_of_week_label'];

    public function food()
    {
        return $this->belongsTo(Food::class);
    }

    public function dietChart()
    {
        return $this->belongsTo(DietChart::class);
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
