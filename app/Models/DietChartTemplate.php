<?php

namespace App\Models;

use App\Models\DietChartTemplateItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DietChartTemplate extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function dietician()
    {
        return $this->belongsTo(User::class, 'dietician_id');
    }

    public function dietChartTemplateItems()
    {
        return $this->hasMany(DietChartTemplateItem::class);
    }
}
