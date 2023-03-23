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
                            {{ trans('cruds.contactContact.fields.contact_email') }}
                        </th>
                        <td>
                            {{ $contactContact->contact_email }}
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
                            {{ trans('cruds.contactContact.fields.nif') }}
                        </th>
                        <td>
                            {{ $contactContact->nif }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactContact.fields.phone') }}
                        </th>
                        <td>
                            {{ $contactContact->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactContact.fields.mobile') }}
                        </th>
                        <td>
                            {{ $contactContact->mobile }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactContact.fields.address') }}
                        </th>
                        <td>
                            {{ $contactContact->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactContact.fields.country') }}
                        </th>
                        <td>
                            {{ $contactContact->country }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactContact.fields.notes') }}
                        </th>
                        <td>
                            {{ $contactContact->notes }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactContact.fields.internalnotes') }}
                        </th>
                        <td>
                            {{ $contactContact->internalnotes }}
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



@endsection