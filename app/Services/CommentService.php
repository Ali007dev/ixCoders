<?php

namespace App\Services;

use App\Models\Task;
use App\Models\TaskComment;
use Illuminate\Support\Facades\Auth;

class CommentService
{

    public function storeComment($commentRequest)
    {

        $taskId = Task::find($commentRequest->task_id);
        if ($taskId->comments == true) {
            $result = TaskComment::query()->create(
                [
                    'user_id' => Auth::user()->id,
                    'task_id' =>  $taskId->id,
                    'content' => $commentRequest->content
                ]
            );
        } else {
            $result = 'error';
        }

        return $result;
    }




    public function editComment($commentRequest,$id)
    {

        $commentId = TaskComment::where('user_id',Auth::user()->id)->findOrFail($id);
        $commentId->update(
                [
                    'content' => $commentRequest->content
                ]
            );

                return 'comment updated successfully';

    }




    public function deleteComment($id)
    {

        $commentId = TaskComment::where('user_id',Auth::user()->id)
        ->findOrFail($id);
        $commentId->delete();
        return 'success';

    }
}
