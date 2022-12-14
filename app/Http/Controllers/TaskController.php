<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
    public function index()
    {
        return view('tasks.index', ['tasks' => Task::all()]);
    }

    public function create()
    {
        $this->authorize('customize-tasks');

        $task = new Task();
        return view('tasks.create', ['task' => $task]);
    }


    public function store(Request $request)
    {
        $this->authorize('customize-tasks');

        $validated = $this->validate($request, [
            'name' => 'required',
            'description' => 'nullable',
            'status_id' => 'required|numeric|integer',
            'created_by_id' => 'required',
            'assigned_to_id' => 'nullable|numeric|integer'
        ]);

        $task = new Task();
        $task->fill($validated);
        $task->save();
        return redirect()->route('tasks.index')->with('message', 'Задача успешно добавлена');
    }

    public function show($id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.show', ['task' => $task]);
    }

    public function edit($id)
    {
        $this->authorize('customize-tasks');

        auth()->check();
        $task = Task::findOrFail($id);
        return view('tasks.edit', ['task' => $task]);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('customize-tasks');

        $task = Task::findOrFail($id);

        $validated = $this->validate($request, [
            'name' => ['required', Rule::unique('tasks')->ignore($task->id)],
            'description' => 'nullable',
            'status_id' => 'required|numeric|integer',
            'assigned_to_id' => 'nullable|numeric|integer'
        ]);

        $task->fill($validated);
        $task->save();
        return redirect()
            ->route('tasks.index');
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);

        $this->authorize('delete-tasks', $task);

        if ($task->author->id !== auth()->id()) {
            abort(403);
        }

        if ($task) {
            $task->delete();
        }
        return redirect()->route('tasks.index')->with('message', __('Task was deleted'));
    }
}
