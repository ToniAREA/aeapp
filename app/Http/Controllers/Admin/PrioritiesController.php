<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPriorityRequest;
use App\Http\Requests\StorePriorityRequest;
use App\Http\Requests\UpdatePriorityRequest;
use App\Models\Priority;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PrioritiesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('priority_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $priorities = Priority::all();

        return view('admin.priorities.index', compact('priorities'));
    }

    public function create()
    {
        abort_if(Gate::denies('priority_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.priorities.create');
    }

    public function store(StorePriorityRequest $request)
    {
        $priority = Priority::create($request->all());

        return redirect()->route('admin.priorities.index');
    }

    public function edit(Priority $priority)
    {
        abort_if(Gate::denies('priority_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.priorities.edit', compact('priority'));
    }

    public function update(UpdatePriorityRequest $request, Priority $priority)
    {
        $priority->update($request->all());

        return redirect()->route('admin.priorities.index');
    }

    public function show(Priority $priority)
    {
        abort_if(Gate::denies('priority_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $priority->load('priorityToDos', 'priorityWlists');

        return view('admin.priorities.show', compact('priority'));
    }

    public function destroy(Priority $priority)
    {
        abort_if(Gate::denies('priority_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $priority->delete();

        return back();
    }

    public function massDestroy(MassDestroyPriorityRequest $request)
    {
        $priorities = Priority::find(request('ids'));

        foreach ($priorities as $priority) {
            $priority->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
