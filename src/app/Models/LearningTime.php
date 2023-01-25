<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningTime extends Model
{
    use HasFactory;

    protected $table = 'learning_times';

    protected $fillable = ['learning_time', 'learning_time_date', 'user_id'];

    public function learning_contents()
    {
        return $this->belongsToMany(
            LearningContent::class
        )->withTimestamps();
    }

    public function languages()
    {
        return $this->belongsToMany(
            Language::class,
        )->withTimestamps();
    }
}
