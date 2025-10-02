<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Get all tasks for the authenticated user
        $user = Auth::user();

        $tasks = Task::where('user_id', $user->id)->get();

        return response()->json($tasks, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'task' => ['required', 'string', 'min:2', 'max:255']
        ]);

        if ($validator->fails()) {
            return response()->json(
                data: $validator->errors(),
                status: Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        //Create task
        $task = Task::create([
            'user_id' => $request->user()->id,
            'task' => $request->task,
        ]);

        return response()->json(
            data: $task,
            status: Response::HTTP_CREATED
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $validator = Validator::make($request->all(), [
            'task' => ['required', 'string', 'min:2', 'max:255'],
            'is_done' => ['sometimes', 'boolean']
        ]);

        if ($validator->fails()) {
            return response()->json(
                data: $validator->errors(),
                status: Response::HTTP_FORBIDDEN
            );
        }

        $userId = Auth::user()->id;
        //Update content
        if($userId != $task->user_id){
            return response()->json(
                data:"You are not authorized to update this task",
                status: Response::HTTP_FORBIDDEN
            );
        }

        //Update task

        $updatedTask = $task->update($validator->validated());

        return response()->json(
                data: $updatedTask,
                status: Response::HTTP_FORBIDDEN
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Task $task)
    {

        $userId = Auth::user()->id;
        //Update content
        if($userId != $task->user_id){
            return response()->json(
                data:"You are not authorized to delete this task",
                status: Response::HTTP_FORBIDDEN
            );
        }

        $task->delete();

        return response()->json(
            data: ['message' => 'Task deleted successfully'],
            status: Response::HTTP_OK
        );
    }
}