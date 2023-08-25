<?php

namespace App\Http\Controllers\Frontend;

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

class ContactCompanyController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('contact_company_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contactCompanies = ContactCompany::with(['contacts'])->get();

        $contact_contacts = ContactContact::get();

        return view('frontend.contactCompanies.index', compact('contactCompanies', 'contact_contacts'));
    }

    public function create()
    {
        abort_if(Gate::denies('contact_company_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contacts = ContactContact::pluck('contact_first_name', 'id');

        return view('frontend.contactCompanies.create', compact('contacts'));
    }

    public function store(StoreContactCompanyRequest $request)
    {
        $contactCompany = ContactCompany::create($request->all());
        $contactCompany->contacts()->sync($request->input('contacts', []));

        return redirect()->route('frontend.contact-companies.index');
    }

    public function edit(ContactCompany $contactCompany)
    {
        abort_if(Gate::denies('contact_company_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contacts = ContactContact::pluck('contact_first_name', 'id');

        $contactCompany->load('contacts');

        return view('frontend.contactCompanies.edit', compact('contactCompany', 'contacts'));
    }

    public function update(UpdateContactCompanyRequest $request, ContactCompany $contactCompany)
    {
        $contactCompany->update($request->all());
        $contactCompany->contacts()->sync($request->input('contacts', []));

        return redirect()->route('frontend.contact-companies.index');
    }

    public function show(ContactCompany $contactCompany)
    {
        abort_if(Gate::denies('contact_company_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contactCompany->load('contacts', 'companyProviders');

        return view('frontend.contactCompanies.show', compact('contactCompany'));
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
