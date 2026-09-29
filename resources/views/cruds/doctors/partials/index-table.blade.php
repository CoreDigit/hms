<div class="table-responsive">
    <table class="table text-md-nowrap" id="example1">
        <thead>
            <tr class="text-center">
                <th class="wd-5p">#</th>
                <th>{{ __('field.image.') }}</th>
                <th>{{ __('field.name') }}</th>
                <th>{{ __('field.email') }}</th>
                <th>{{ __('field.specialty') }}</th>
                @if (auth()->guard('admin')->check())
                    <th>{{ __('const.status.') }}</th>
                    <th>{{ __('handle.') }}</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($doctors as $doctor)
                <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>

                    <td>
                        <img src="{{ asset('backend/images/' . $doctor->image->path) }}" alt="avatar"
                            class="rounded-circle avatar-md mr-2">
                    </td>

                    <td>
                        <a
                            href="{{ route(auth()->guard('admin')->check()? 'doctors.show': 'patient.doctors.show',$doctor->id) }}">{{ $doctor->name }}</a>
                    </td>

                    <td>{{ $doctor->email }}</td>
                    <td>{{ $doctor->specialty }}</td>

                    @if (auth()->guard('admin')->check())
                        <td>
                            @if ($doctor->status)
                                <span class="label text-success d-flex">{{ __('const.status.active') }}</span>
                            @else
                                <span class="label text-danger d-flex">{{ __('const.status.inactive') }}</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('doctors.edit', $doctor->id) }}" class="btn btn-sm btn-info"
                                title="{{ __('handle.edit') }}">
                                <i class="las la-pen"></i>
                            </a>

                            <a href="" data-toggle="modal" data-target="#doctors-delete-{{ $doctor->id }}"
                                class="btn btn-sm btn-danger" title="{{ __('handle.delete.') }}">
                                <i class="ti-trash"></i>
                            </a>

                            @if ($doctor->status)
                                <a href="" data-toggle="modal"
                                    data-target="#doctors-inactivate-{{ $doctor->id }}" class="btn btn-sm btn-danger"
                                    title="{{ __('handle.inactivate') }}">
                                    <i class="fas fa-times-circle"></i>
                                </a>
                            @else
                                <a href="" data-toggle="modal"
                                    data-target="#doctors-activate-{{ $doctor->id }}" class="btn btn-sm btn-success"
                                    title="{{ __('handle.activate') }}">
                                    <i class="fas fa-check-circle"></i>
                                </a>
                            @endif
                        </td>
                    @endif
                </tr>
                @include('cruds.doctors.partials.delete-modal')
                @include('cruds.doctors.partials.inactive-modal')
                @include('cruds.doctors.partials.active-modal')
            @endforeach
        </tbody>
    </table>
</div>
