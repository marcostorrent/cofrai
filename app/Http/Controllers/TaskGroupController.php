<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaskGroup;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class TaskGroupController extends Controller
{
    use AuthorizesRequests; 
    
    public function index()
    { 
        $taskGroups = Auth::user()->taskGroups()->orderBy('created_at')->get();
        return view('task-groups.index', compact('taskGroups'));
    }

    public function create()
    {
        return view('task-groups.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $taskGroup = new TaskGroup($request->all());
        $taskGroup->user_id = Auth::id();
        $taskGroup->save();

        return redirect()->route('task-groups.index')->with('success', 'Task group created successfully.');
    }

    public function show(TaskGroup $taskGroup)
    {
        $this->authorize('view', $taskGroup);
        return view('task-groups.show', compact('taskGroup'));
    }

    public function edit(TaskGroup $taskGroup)
    {
        $this->authorize('update', $taskGroup);
        return view('task-groups.edit', compact('taskGroup'));
    }

    public function update(Request $request, TaskGroup $taskGroup)
    {
        $this->authorize('update', $taskGroup);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $taskGroup->update($request->all());

        return redirect()->route('task-groups.index')->with('success', 'Task group updated successfully.');
    }

    public function destroy(TaskGroup $taskGroup)
    {
        $this->authorize('delete', $taskGroup);
        $taskGroup->delete();

        return redirect()->route('task-groups.index')->with('success', 'Task group deleted successfully.');
    }
}

