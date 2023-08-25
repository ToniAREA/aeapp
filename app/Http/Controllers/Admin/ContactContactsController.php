<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyContactContactRequest;
use App\Http\Requests\StoreContactContactRequest;
use App\Http\Requests\UpdateContactContactRequest;
use App\Models\ContactContact;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ContactContactsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('contact_contact_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ContactContact::query()->select(sprintf('%s.*', (new ContactContact)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'contact_contact_show';
                $editGate      = 'contact_contact_edit';
                $deleteGate    = 'contact_contact_delete';
                $crudRoutePart = 'contact-contacts';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('contact_first_name', function ($row) {
                return $row->contact_first_name ? $row->contact_first_name : '';
            });
            $table->editColumn('contact_last_name', function ($row) {
                return $row->contact_last_name ? $row->contact_last_name : '';
            });
            $table->editColumn('contact_nif', function ($row) {
                return $row->contact_nif ? $row->contact_nif : '';
            });
            $table->editColumn('contact_address', function ($row) {
                return $row->contact_address ? $row->contact_address : '';
            });
            $table->editColumn('contact_country', function ($row) {
                return $row->contact_country ? $row->contact_country : '';
            });
            $table->editColumn('contact_mobile', function ($row) {
                return $row->contact_mobile ? $row->contact_mobile : '';
            });
            $table->editColumn('contact_mobile_2', function ($row) {
                return $row->contact_mobile_2 ? $row->contact_mobile_2 : '';
            });
            $table->editColumn('contact_email', function ($row) {
                return $row->contact_email ? $row->contact_email : '';
            });
            $table->editColumn('contact_email_2', function ($row) {
                return $row->contact_email_2 ? $row->contact_email_2 : '';
            });
            $table->editColumn('social_link', function ($row) {
                return $row->social_link ? $row->social_link : '';
            });
            $table->editColumn('contact_tags', function ($row) {
                return $row->contact_tags ? $row->contact_tags : '';
            });
            $table->editColumn('contact_notes', function ($row) {
                return $row->contact_notes ? $row->contact_notes : '';
            });
            $table->editColumn('contact_internalnotes', function ($row) {
                return $row->contact_internalnotes ? $row->contact_internalnotes : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.contactContacts.index');
    }

    public function create()
    {
        abort_if(Gate::denies('contact_contact_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.contactContacts.create');
    }

    public function store(StoreContactContactRequest $request)
    {
        $contactContact = ContactContact::create($request->all());

        return redirect()->route('admin.contact-contacts.index');
    }

    public function edit(ContactContact $contactContact)
    {
        abort_if(Gate::denies('contact_contact_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.contactContacts.edit', compact('contactContact'));
    }

    public function update(UpdateContactContactRequest $request, ContactContact $contactContact)
    {
        $contactContact->update($request->all());

        return redirect()->route('admin.contact-contacts.index');
    }

    public function show(ContactContact $contactContact)
    {
        abort_if(Gate::denies('contact_contact_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contactContact->load('contactEmployees', 'contactsClients', 'contactsContactCompanies');

        return view('admin.contactContacts.show', compact('contactContact'));
    }

    public function destroy(ContactContact $contactContact)
    {
        abort_if(Gate::denies('contact_contact_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contactContact->delete();

        return back();
    }

    public function massDestroy(MassDestroyContactContactRequest $request)
    {
        $contactContacts = ContactContact::find(request('ids'));

        foreach ($contactContacts as $contactContact) {
            $contactContact->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
