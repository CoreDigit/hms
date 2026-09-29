<div class="table-responsive">
    <table class="table text-md-nowrap" id="example1">
        <thead>
            <tr class="text-center">
                <th class="wd-5p">#</th>
                <th>{{ __('field.image.') }}</th>
                <th>{{ __('field.name') }}</th>
                <th>{{ __('field.license_number') }}</th>
                <th>{{ __('field.address') }}</th>
                <th>{{ __('const.status.') }}</th>
                <th>{{ __('handle.') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ambulanceDrivers as $ambulanceDriver)
                <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>

                    <td>
                        <img src="{{ asset('backend/images/' . $ambulanceDriver->image->path) }}" alt="avatar"
                            class="rounded-circle avatar-md mr-2">
                    </td>

                    <td><a href="{{ route('ambulanceDrivers.show', $ambulanceDriver->id) }}">{{ $ambulanceDriver->name }}</a></td>
                    <td>{{ $ambulanceDriver->license_number }}</td>
                    <td>{{ Str::limit($ambulanceDriver->address, 30) }}</td>

                    <td>
                        @if ($ambulanceDriver->status)
                            <span class="label text-success">{{ __('const.status.active') }}</span>
                        @else
                            <span class="label text-danger">{{ __('const.status.inactive') }}</span>
                        @endif
                    </td>

                    <td>
                        <a href="{{ route('ambulanceDrivers.edit', $ambulanceDriver->id) }}" class="btn btn-sm btn-info"
                            title="{{ __('handle.edit') }}"><i class="las la-pen"></i></a>

                        <a href="" data-toggle="modal" data-target="#ambulanceDrivers-delete-{{ $ambulanceDriver->id }}"
                            class="btn btn-sm btn-danger" title="{{ __('handle.delete.') }}"><i class="ti-trash"></i></a>

                        @if ($ambulanceDriver->status)
                            <a href="" data-toggle="modal" data-target="#ambulanceDrivers-inactivate-{{ $ambulanceDriver->id }}"
                                class="btn btn-sm btn-danger" title="{{ __('handle.inactivate') }}">
                                <i class="fas fa-times-circle"></i>
                            </a>
                        @else
                            <a href="" data-toggle="modal" data-target="#ambulanceDrivers-activate-{{ $ambulanceDriver->id }}"
                                class="btn btn-sm btn-success" title="{{ __('handle.activate') }}">
                                <i class="fas fa-check-circle"></i>
                            </a>
                        @endif
                    </td>
                </tr>
                @include('cruds.ambulanceDrivers.partials.delete-modal')
                @include('cruds.ambulanceDrivers.partials.inactive-modal')
                @include('cruds.ambulanceDrivers.partials.active-modal')
            @endforeach
        </tbody>
    </table>
</div>
