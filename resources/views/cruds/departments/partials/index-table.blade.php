<div class="table-responsive">
    <table class="table text-md-nowrap" id="example1">
        <thead>
            <tr class="text-center">
                <th class="wd-5p">#</th>
                <th class="wd-5p"><input type="checkbox" name="select-all"></th>
                <th>{{ __('field.name') }}</th>
                <th>{{ __('field.description') }}</th>
                <th>{{ __('field.number_of.doctors') }}</th>
                <th>{{ __('handle.') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($departments as $department)
                @php
                    $color = $department->doctors()->count() ? 'success' : 'warning';
                @endphp

                <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <input type="checkbox" name="selector" value="{{ $department->id }}">
                    </td>

                    <td>
                        <a href="" data-toggle="modal"
                            data-target="#departments-{{ $department->name ? 'show' : 'edit' }}-{{ $department->id }}"
                            title="{{ __('handle.show.more') }}">
                            {{ $department->name ?? __('general.warning.no_translation') }}
                        </a>
                    </td>

                    <td>{{ Str::limit($department->description, 30) ?? __('general.warning.no_translation') }}</td>

                    <td>
                        <a href="" data-toggle="modal"
                            data-target="#departments-doctors-show-{{ $department->id }}"
                            class="btn btn-sm btn-{{ $color }}" title="{{ __('users.doctors') }}">
                            <span class="badge badge-light">{{ $department->doctors()->count() }}</span>
                            {{ __('users.doctors') }}
                        </a>
                    </td>

                    <td>
                        <a href="" data-toggle="modal" data-target="#departments-edit-{{ $department->id }}"
                            class="btn btn-sm btn-light" title="{{ __('handle.edit') }}">
                            <i class="las la-pen"></i>
                        </a>

                        <a href="" data-toggle="modal" data-target="#departments-delete-{{ $department->id }}"
                            class="btn btn-sm btn-danger" title="{{ __('handle.delete.') }}">
                            <i class="ti-trash"></i>
                        </a>
                    </td>
                </tr>
                @include('cruds.departments.partials.doctors-show-modal')
                @include('cruds.departments.partials.show-modal')
                @include('cruds.departments.partials.edit-modal')
                @include('cruds.departments.partials.delete-modal')
            @endforeach
        </tbody>
    </table>
</div>
