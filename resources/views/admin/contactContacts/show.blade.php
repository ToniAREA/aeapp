@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.contactContact.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.contact-contacts.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.contactContact.fields.id') }}
                        </th>
                        <td>
                            {{ $contactContact->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactContact.fields.contact_first_name') }}
                        </th>
                        <td>
                            {{ $contactContact->contact_first_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactContact.fields.contact_last_name') }}
                        </th>
                        <td>
                            {{ $contactContact->contact_last_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactContact.fields.contact_nif') }}
                        </th>
                        <td>
                            {{ $contactContact->contact_nif }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactContact.fields.contact_address') }}
                        </th>
                        <td>
                            {{ $contactContact->contact_address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactContact.fields.contact_country') }}
                        </th>
                        <td>
                            {{ $contactContact->contact_country }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactContact.fields.contact_email') }}
                        </th>
                        <td>
                            {{ $contactContact->contact_email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactContact.fields.contact_mobile') }}
                        </th>
                        <td>
                            {{ $contactContact->contact_mobile }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactContact.fields.contact_notes') }}
                        </th>
                        <td>
                            {{ $contactContact->contact_notes }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactContact.fields.contact_internalnotes') }}
                        </th>
                        <td>
                            {{ $contactContact->contact_internalnotes }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.contact-contacts.index') }}">
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
            <a class="nav-link" href="#contact_employees" role="tab" data-toggle="tab">
                {{ trans('cruds.employee.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="contact_employees">
            @includeIf('admin.contactContacts.relationships.contactEmployees', ['employees' => $contactContact->contactEmployees])
        </div>
    </div>
</div>

@endsection