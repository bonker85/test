<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Http\Resources\TasksResource;
use App\Models\Task;
use App\Enum\Status;
use Illuminate\Http\Client\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IndexController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $tasks = Task::where('status', Status::active->value)->orderBy('id')->get()->toArray();
        return TasksResource::collection($tasks);
    }

    public function store(Request $request): TaskResource|JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'unique:tasks'],
            'description' => ['required', 'string'],
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $status = $request->status ?? 0;
        $task = new Task();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->status = $status;
        $task->save();
        return TaskResource::make($task);
    }

    public function show(Task $task): TaskResource
    {
        return TaskResource::make($task);
    }

    public function update(Task $task, Request $request): TaskResource|JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'unique:tasks'],
            'description' => ['required', 'string'],
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $task->title = $request->title;
        $task->description = $request->description;
        $task->status = $request->status ?? 0;
        $task->save();
        $task->refresh();
        return TaskResource::make($task);
    }

    public function delete(Task $task): JsonResponse
    {
        $task->delete();
        return response()->json("OK", 200);
    }
}
