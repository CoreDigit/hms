<div class="table-responsive">
    <table class="table text-md-nowrap" id="example1">
        <thead>
            <tr class="text-center">
                <th class="wd-5p">#</th>
                <th class="wd-5p"><input type="checkbox" name="select-all"></th>
                <th>{{ __('const.type.') }}</th>
                <th>{{ __('field.number') }}</th>
                <th>{{ __('field.model') }}</th>
                <th>{{ __('field.year_made') }}</th>
                <th>{{ __('field.number_of.drivers') }}</th>
                <th>{{ __('const.status.') }}</th>
                <th>{{ __('handle.') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ambulances as $ambulance)
                @php
                    $color = $ambulance->drivers()->count() ? 'success' : 'warning';
                @endphp

                <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <input type="checkbox" name="selector" value="{{ $ambulance->id }}">
                    </td>

                    <td>{{ $ambulance->type }}</td>
                    <td>{{ $ambulance->number }}</td>
                    <td>{{ $ambulance->model }}</td>
                    <td>{{ $ambulance->year_made }}</td>

                    <td>
                        <a href="" data-toggle="modal"
                            data-target="#ambulances-ambulanceDrivers-show-{{ $ambulance->id }}"
                            class="btn btn-sm btn-{{ $color }}" title="{{ __('users.ambulanceDrivers') }}">
                            <span class="badge badge-light">{{ $ambulance->drivers()->count() }}</span>
                            {{ __('users.ambulanceDrivers') }}
                        </a>
                    </td>

                    <td>
                        @if ($ambulance->status)
                            <span class="text-center text-success">{{ __('const.status.active') }}</span>
                        @else
                            <span class="text-center text-danger">{{ __('const.status.inactive') }}</span>
                        @endif
                    </td>

                    <td>
                        <a href="" data-toggle="modal" data-target="#ambulances-edit-{{ $ambulance->id }}"
                            class="btn btn-sm btn-light" title="{{ __('handle.edit') }}">
                            <i class="las la-pen"></i>
                        </a>

                        <a href="" data-toggle="modal" data-target="#ambulances-delete-{{ $ambulance->id }}"
                            class="btn btn-sm btn-danger" title="{{ __('handle.delete.') }}">
                            <i class="ti-trash"></i>
                        </a>

                        @if ($ambulance->status)
                            <a href="" data-toggle="modal"
                                data-target="#ambulances-inactivate-{{ $ambulance->id }}" class="btn btn-sm btn-danger"
                                title="{{ __('handle.inactivate') }}">
                                <i class="fas fa-times-circle"></i>
                            </a>
                        @else
                            <a href="" data-toggle="modal"
                                data-target="#ambulances-activate-{{ $ambulance->id }}" class="btn btn-sm btn-success"
                                title="{{ __('handle.activate') }}">
                                <i class="fas fa-check-circle"></i>
                            </a>
                        @endif
                    </td>
                </tr>
                @include('cruds.ambulances.partials.ambulanceDrivers-show-modal')
                @include('cruds.ambulances.partials.edit-modal')
                @include('cruds.ambulances.partials.delete-modal')
                @include('cruds.ambulances.partials.active-modal')
                @include('cruds.ambulances.partials.inactive-modal')
            @endforeach
        </tbody>
    </table>
</div>
