<?php

namespace App\Http\Middleware;

use App\Helper\ResponseHelper;
use App\Models\TaskUser;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class TaskMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $taskId = $request->task_id;
        $adminId = Auth::user()->id;
        $isAdmin = TaskUser::where('user_id', $adminId)
            ->where('role', 'admin')
            ->where('task_id', $taskId)
            ->exists();

        if ($isAdmin == false) {
            return ResponseHelper::error('Unauthorized');
        }
        return $next($request);


    }
}
