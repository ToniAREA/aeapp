<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyContactCompanyRequest;
use App\Http\Requests\StoreContactCompanyRequest;
use App\Http\Requests\UpdateContactCompanyRequest;
use App\Models\ContactCompany;
use App\Models\ContactContact;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ContactCompanyController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('contact_company_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ContactCompany::with(['contacts'])->select(sprintf('%s.*', (new ContactCompany)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'contact_company_show';
                $editGate      = 'contact_company_edit';
                $deleteGate    = 'contact_company_delete';
                $crudRoutePart = 'contact-companies';

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
            $table->editColumn('defaulter', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->defaulter ? 'checked' : null) . '>';
            });
            $table->editColumn('company_name', function ($row) {
                return $row->company_name ? $row->company_name : '';
            });
            $table->editColumn('company_vat', function ($row) {
                return $row->company_vat ? $row->company_vat : '';
            });
            $table->editColumn('company_address', function ($row) {
                return $row->company_address ? $row->company_address : '';
            });
            $table->editColumn('company_mobile', function ($row) {
                return $row->company_mobile ? $row->company_mobile : '';
            });
            $table->editColumn('company_phone', function ($row) {
                return $row->company_phone ? $row->company_phone : '';
            });
            $table->editColumn('company_email', function ($row) {
                return $row->company_email ? $row->company_email : '';
            });
            $table->editColumn('company_website', function ($row) {
                return $row->company_website ? $row->company_website : '';
            });
            $table->editColumn('company_social_link', function ($row) {
                return $row->company_social_link ? $row->company_social_link : '';
            });
            $table->editColumn('contacts', function ($row) {
                $labels = [];
                foreach ($row->contacts as $contact) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $contact->contact_first_name);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'defaulter', 'contacts']);

            return $table->make(true);
        }

        $contact_contacts = ContactContact::get();

        return view('admin.contactCompanies.index', compact('contact_contacts'));
    }

    public function create()
    {
        abort_if(Gate::denies('contact_company_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contacts = ContactContact::pluck('contact_first_name', 'id');

        return view('admin.contactCompanies.create', compact('contacts'));
    }

    public function store(StoreContactCompanyRequest $request)
    {
        $contactCompany = ContactCompany::create($request->all());
        $contactCompany->contacts()->sync($request->input('contacts', []));

        return redirect()->route('admin.contact-companies.index');
    }

    public function edit(ContactCompany $contactCompany)
    {
        abort_if(Gate::denies('contact_company_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contacts = ContactContact::pluck('contact_first_name', 'id');

        $contactCompany->load('contacts');

        return view('admin.contactCompanies.edit', compact('contactCompany', 'contacts'));
    }

    public function update(UpdateContactCompanyRequest $request, ContactCompany $contactCompany)
    {
        $contactCompany->update($request->all());
        $contactCompany->contacts()->sync($request->input('contacts', []));

        return redirect()->route('admin.contact-companies.index');
    }

    public function show(ContactCompany $contactCompany)
    {
        abort_if(Gate::denies('contact_company_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contactCompany->load('contacts', 'companyProviders');

        return view('admin.contactCompanies.show', compact('contactCompany'));
    }

    public function destroy(ContactCompany $contactCompany)
    {
        abort_if(Gate::denies('contact_company_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contactCompany->delete();

        return back();
    }

    public function massDestroy(MassDestroyContactCompanyRequest $request)
    {
        $contactCompanies = ContactCompany::find(request('ids'));

        foreach ($contactCompanies as $contactCompany) {
            $contactCompany->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
