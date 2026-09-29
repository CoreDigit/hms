<div class="table-responsive">
    <table class="table text-md-nowrap" id="example1">
        <thead>
            <tr class="text-center">
                <th class="wd-5p">#</th>
                <th>{{ __('field.image.') }}</th>
                <th>{{ __('field.name') }}</th>
                <th>{{ __('field.email') }}</th>
                <th>{{ __('field.address') }}</th>
                @if (auth()->guard('admin')->check())
                    <th>{{ __('handle.') }}</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($patients as $patient)
                <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <img src="{{ asset('backend/images/' . $patient->image->path) }}" alt="avatar"
                            class="rounded-circle avatar-md mr-2">
                    </td>
                    <td>
                        <a
                            href="{{ route(auth()->guard('admin')->check()? 'patients.show': 'doctor.patients.show',$patient->id) }}">
                            {{ $patient->name }}
                        </a>
                    </td>
                    <td>{{ $patient->email }}</td>
                    <td>{{ Str::limit($patient->address, 30) }}</td>
                    @if (auth()->guard('admin')->check())
                        <td>
                            <a href="{{ route('patients.edit', $patient->id) }}" class="btn btn-sm btn-info"
                                title="{{ __('handle.edit') }}">
                                <i class="las la-pen"></i>
                            </a>

                            <a href="" data-toggle="modal" data-target="#patients-delete-{{ $patient->id }}"
                                class="btn btn-sm btn-danger" title="{{ __('handle.delete.') }}">
                                <i class="ti-trash"></i>
                            </a>
                        </td>
                    @endif
                </tr>
                @include('cruds.patients.partials.delete-modal')
            @endforeach
        </tbody>
    </table>
</div>
