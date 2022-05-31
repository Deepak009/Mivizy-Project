<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'model_type',
        'model_id',
        'path',
        'filename',
        'mine_type',
        'size_in_bytes',
    ];
    protected $appends = ['url'];

    public function imageable()
    {
        return $this->morphTo();
    }

    public function getUrlAttribute()
    {
        if(!empty($this->filename)){
            return config('app.url').Storage::url($this->path);
        }
        return 'https://picsum.photos/id/11/10/6';
    }
}
