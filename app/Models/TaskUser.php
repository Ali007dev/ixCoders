<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskUser extends Model
{
    use HasFactory;
    protected $fillable=['user_id','task_id','role','status','description','date'];



    public function scheduleTask()
    {
        $result = $this->hasMany(ScheduleTask::class, 'action_id');
        return $result;
    }
}
