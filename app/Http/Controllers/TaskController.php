<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\TaskGroup;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    use AuthorizesRequests; 
    
    public function index()
    {
        $tasks = Auth::user()->tasks()->orderBy('start_date')->get();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $taskGroups = Auth::user()->taskGroups()->get();
        return view('tasks.create', compact('taskGroups'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'frequency' => 'required|in:daily,weekly,monthly,yearly,custom',
            'task_group_id' => 'required|exists:task_groups,id',
            'is_completed' => 'boolean',
        ]);

        $task = new Task($request->all());
        $task->user_id = Auth::id();
        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    public function show(Task $task)
    {
        $this->authorize('view', $task);
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        $this->authorize('update', $task);
        $taskGroups = Auth::user()->taskGroups()->get();
        return view('tasks.edit', compact('task', 'taskGroups'));
    }

    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'frequency' => 'required|in:daily,weekly,monthly,yearly,custom',
            'task_group_id' => 'required|exists:task_groups,id',
            'is_completed' => 'boolean',
        ]);

        $task->update($request->all());

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}
