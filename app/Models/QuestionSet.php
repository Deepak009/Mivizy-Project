<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class QuestionSet extends Model
{
    use SoftDeletes;
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'details' => 'array',
    ];
}
