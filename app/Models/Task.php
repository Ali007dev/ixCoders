<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable=['name','file','priority'];
    protected $appends = ['color'];

    public function getColorAttribute()
{
    $result = TaskUser::where('task_id', $this->id)->value('status');
    if ($result === 'waiting') {
        return 'red';
    }

    if ($result === 'in_progress') {
        return 'red';
    }

    if ($result === 'to_do') {
        return 'yellow';
    }

    if ($result === 'done') {
        return 'green';
    }

    return 0;
}




    public function users()
{
    return $this->belongsToMany(User::class, 'task_users');
}
public function comments()
{
    return $this->hasMany(TaskComment::class,);
}

}
