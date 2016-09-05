<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;

    public function file(){
        return $this->belongsTo(File::class);
    }

    protected $fillable = [
        'content',
    ];

    protected $dates = ['deleted_at'];
}
