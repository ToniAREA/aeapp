<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyContactTagRequest;
use App\Http\Requests\StoreContactTagRequest;
use App\Http\Requests\UpdateContactTagRequest;
use App\Models\ContactTag;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContactTagController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('contact_tag_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contactTags = ContactTag::all();

        return view('admin.contactTags.index', compact('contactTags'));
    }

    public function create()
    {
        abort_if(Gate::denies('contact_tag_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.contactTags.create');
    }

    public function store(StoreContactTagRequest $request)
    {
        $contactTag = ContactTag::create($request->all());

        return redirect()->route('admin.contact-tags.index');
    }

    public function edit(ContactTag $contactTag)
    {
        abort_if(Gate::denies('contact_tag_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.contactTags.edit', compact('contactTag'));
    }

    public function update(UpdateContactTagRequest $request, ContactTag $contactTag)
    {
        $contactTag->update($request->all());

        return redirect()->route('admin.contact-tags.index');
    }

    public function show(ContactTag $contactTag)
    {
        abort_if(Gate::denies('contact_tag_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.contactTags.show', compact('contactTag'));
    }

    public function destroy(ContactTag $contactTag)
    {
        abort_if(Gate::denies('contact_tag_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contactTag->delete();

        return back();
    }

    public function massDestroy(MassDestroyContactTagRequest $request)
    {
        $contactTags = ContactTag::find(request('ids'));

        foreach ($contactTags as $contactTag) {
            $contactTag->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
