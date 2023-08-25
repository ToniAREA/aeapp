@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.contactCompany.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.contact-companies.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.contactCompany.fields.id') }}
                        </th>
                        <td>
                            {{ $contactCompany->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactCompany.fields.defaulter') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $contactCompany->defaulter ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactCompany.fields.company_name') }}
                        </th>
                        <td>
                            {{ $contactCompany->company_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactCompany.fields.company_vat') }}
                        </th>
                        <td>
                            {{ $contactCompany->company_vat }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactCompany.fields.company_address') }}
                        </th>
                        <td>
                            {{ $contactCompany->company_address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactCompany.fields.company_mobile') }}
                        </th>
                        <td>
                            {{ $contactCompany->company_mobile }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactCompany.fields.company_phone') }}
                        </th>
                        <td>
                            {{ $contactCompany->company_phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactCompany.fields.company_email') }}
                        </th>
                        <td>
                            {{ $contactCompany->company_email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactCompany.fields.company_website') }}
                        </th>
                        <td>
                            {{ $contactCompany->company_website }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactCompany.fields.company_social_link') }}
                        </th>
                        <td>
                            {{ $contactCompany->company_social_link }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactCompany.fields.contacts') }}
                        </th>
                        <td>
                            @foreach($contactCompany->contacts as $key => $contacts)
                                <span class="label label-info">{{ $contacts->contact_first_name }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.contact-companies.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#company_providers" role="tab" data-toggle="tab">
                {{ trans('cruds.provider.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="company_providers">
            @includeIf('admin.contactCompanies.relationships.companyProviders', ['providers' => $contactCompany->companyProviders])
        </div>
    </div>
</div>

@endsection