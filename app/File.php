<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use SoftDeletes;

    public function tasks(){
        return $this->hasMany(Task::class);
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function addTask($task){
        return $this->tasks()->save($task);
    }

    protected $fillable = [
        'name',
    ];

    protected $dates = ['deleted_at'];
}
