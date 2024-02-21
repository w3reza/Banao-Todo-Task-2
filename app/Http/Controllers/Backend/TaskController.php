<?php

namespace App\Http\Controllers\Backend;

use App\Models\Task;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function addTask(Request $request)
    {
        try {

            $request->validate([
                'user_id' => 'required',
                'task' => 'required|string',
            ]);

            $user_id = $request->input('user_id');
            $task = $request->input('task');

            $task = Task::create([
                'user_id' => $user_id,
                'task' => $task,
                'status' => 'pending',
            ]);

            return response()->json([
                'task' => $task,
                'status' => 1,
                'message' => 'Successfully created a task',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 0,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function updateStatus(Request $request)
    {


        try {

            $request->validate([
                'task_id' => 'required',
                'status' => 'required|in:pending,done',
            ]);

            $task_id = $request->input('task_id');
            $status = $request->input('status');

            $task = Task::find($task_id);
            $task->status = $status;
            $task->save();

            return response()->json([
                'task' => $task,
                'status' => 1,
                'message' => 'Marked task as ' . $status,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 0,
                'message' => $e->getMessage(),
            ]);
        }
    }
}



