<?php

namespace App\Http\Controllers;

use App\Models\TaskStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class TaskStatusController extends Controller
{
    public function index()
    {
        $statuses = TaskStatus::all();
        return view('task_statuses.index', compact('statuses'));
    }

    public function create()
    {
        $this->authorize('change-statuses');
        $status = new TaskStatus();
        return view('task_statuses.create', ['task_status' => $status]);
    }

    public function store(Request $request)
    {
        $this->authorize('change-statuses');
        $validated = $this->validate($request, ['name' => 'required']);

        $status = new TaskStatus();
        $status->fill($validated);
        $status->save();

        return redirect('/task_statuses')->with('message', __('Status successfully created'));
        // "Статус успешно создан"
    }

    public function show()
    {
        abort(403);
    }

    public function edit(TaskStatus $taskStatus)
    {
        $this->authorize('change-statuses');
        return view('task_statuses.edit', ['task_status' => $taskStatus]);
    }

    public function update(Request $request, TaskStatus $taskStatus)
    {
        $this->authorize('change-statuses');
        $validated = $this->validate($request, ['name' => 'required']);
        $taskStatus->fill($validated)->save();
        return redirect(route('task_statuses.index'))->with('message', __('Status updated successfully'));
    }

    public function destroy(TaskStatus $taskStatus)
    {
        if ($taskStatus->tasks->isNotEmpty()) {
            return  redirect(route('task_statuses.index'))
                    ->with('message', __('Failed to delete status'));
        }
        $this->authorize('change-statuses');
        $taskStatus->delete();
        return redirect(route('task_statuses.index'))->with('message', __('Status successfully deleted'));
        // "Статус успешно удален"
    }
}
