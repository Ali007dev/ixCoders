<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskComment extends Model
{

    protected $fillable=['user_id','task_id','content'];

    use HasFactory;
}
