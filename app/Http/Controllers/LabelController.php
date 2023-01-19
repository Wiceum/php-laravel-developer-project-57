<?php

namespace App\Http\Controllers;

use App\Models\Label;
use Illuminate\Http\Request;

class LabelController extends Controller
{
    public function index()
    {
        $labels = Label::all();
        return view('labels.index', ['labels' => $labels]);
    }

    public function create()
    {
        $this->authorize('change-labels');
        $label = new Label();
        return view('labels.create', ['label' => $label]);
    }

    public function store(Request $request)
    {
        $this->authorize('change-labels');
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'nullable'
        ]);
        $label = new Label();
        $label->fill($validated)->save();
        return redirect()->route('labels.index')->with('message', __('Label created successfully'));
    }

    public function show(Label $label)
    {
        abort(403);
    }

    public function edit(Label $label)
    {
        $this->authorize('change-labels');
        return view('labels.edit', ['label' => $label]);
    }

    public function update(Request $request, Label $label)
    {
        $this->authorize('change-labels');
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'nullable'
        ]);
        $label->fill($validated)->save();
        return redirect(route('labels.index'))->with('message', __('Label successfully updated'));
    }

    public function destroy(Label $label)
    {
        $this->authorize('change-labels');

        if ($label->tasks()->count() !== 0) {
            return redirect(route('labels.index'))->with('message', __('Failed to delete label'));
        }
        $label->delete();
        return redirect(route('labels.index'))->with('message', __('Label successfully deleted'));
    }
}
