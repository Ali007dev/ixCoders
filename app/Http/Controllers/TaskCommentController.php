<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Http\Requests\CommentRequest;
use App\Models\User;
use App\Notifications\DeadLineNotification;
use App\Services\CommentService;
use Illuminate\Http\Request;

class TaskCommentController extends Controller
{
    protected $taskCommentService;

    public function __construct(CommentService $taskCommentService)
    {
        $this->taskCommentService = $taskCommentService;
    }

    public function storeComment(CommentRequest $taskRequest)
    {
       $result = $this->taskCommentService->storeComment($taskRequest);

        return ResponseHelper::success($result);

    }

    public function editComment(CommentRequest $taskRequest,$id)
    {
       $result = $this->taskCommentService->editComment($taskRequest,$id);

        return ResponseHelper::success($result);
    }

    public function deleteComment($id)
    {
       $result = $this->taskCommentService->deleteComment($id);

        return ResponseHelper::success($result);
    }





}
