<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Models\Task;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        // using Spatie\QueryBuilder

        if ($request->query->has('filter')) {
            $this->validate($request, [
                'filter.status_id' => ['numeric', 'integer', 'nullable'],
                'filter.created_by_id' => ['numeric', 'integer', 'nullable'],
                'filter.assigned_to_id' => ['numeric', 'integer', 'nullable']
            ]);

            $tasks = QueryBuilder::for(Task::class, $request)
                ->allowedFilters([
                    AllowedFilter::exact('status_id'),
                    AllowedFilter::exact('created_by_id'),
                    AllowedFilter::exact('assigned_to_id')
                ])
                ->allowedFields('status_id', 'created_by_id', 'assigned_to_id')
                ->allowedIncludes(['task_statuses', 'users'])
                ->paginate(15)
                ->withQueryString();
            return view('tasks.index', ['tasks' => $tasks]);
        }
        return view('tasks.index', ['tasks' => Task::paginate(15)]);
    }

    public function create()
    {
        $this->authorize('customize-tasks');

        $task = new Task();
        return view('tasks.create', ['task' => $task, 'labels' => Label::all()]);
    }


    public function store(Request $request)
    {
        $this->authorize('customize-tasks');

        $validated = $this->validate($request, [
            'name' => 'required',
            'description' => 'nullable',
            'status_id' => 'required|numeric|integer',
            'created_by_id' => 'required',
            'assigned_to_id' => 'nullable|numeric|integer',
            'labels' => 'exists:labels,id'
        ]);


        $task = new Task();
        $task->fill(collect($validated)->except('labels')->toArray())->save();

        $labels = $validated['labels'] ?? [];
        $task->labels()->attach($labels);

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

        $task = Task::findOrFail($id);
        return view('tasks.edit', ['task' => $task, 'labels' => Label::all()]);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('customize-tasks');

        $task = Task::findOrFail($id);
        $validated = $this->validate($request, [
            'name' => ['required', Rule::unique('tasks')->ignore($task->id)],
            'description' => 'nullable',
            'status_id' => 'required|numeric|integer',
            'assigned_to_id' => 'nullable|numeric|integer',
            'labels' => 'exists:labels,id'
        ]);

        $labels = $validated['labels'] ?? [];

        $task->fill(collect($validated)->except('labels')->toArray());
        $task->save();
        $task->labels()->sync($labels);

        return redirect()->route('tasks.index')
            ->with('message', __('Task successfully updated'));
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);

        $this->authorize('delete-tasks', $task);

        if ($task) {
            $task->delete();
        }
        return redirect()->route('tasks.index')->with('message', __('Task was deleted'));
    }
}
