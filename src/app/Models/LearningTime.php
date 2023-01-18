<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningTime extends Model
{
    use HasFactory;

    protected $table = 'learning_times';
    public function learning_contents()
    {
        return $this->belongsToMany('App\LearningContent')->withTimestamps();
    }

    public function languages()
    {
        return $this->belongsToMany('App\Language')->withTimestamps();
    }
}
