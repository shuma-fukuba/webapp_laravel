<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningContent extends Model
{
    use HasFactory;

    protected $table = 'learning_contents';
    public function learning_times()
    {
        return $this->belongsToMany(LearningTime::class)->withTimestamps();
    }
}
