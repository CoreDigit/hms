<div class="table-responsive">
    <table class="table text-md-nowrap" id="example1">
        <thead>
            <tr class="text-center">
                <th class="wd-5p">#</th>
                <th>{{ __('field.image.') }}</th>
                <th>{{ __('field.name') }}</th>
                <th>{{ __('field.email') }}</th>
                <th>{{ __('const.status.') }}</th>
                <th>{{ __('handle.') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($labEmployees as $labEmployee)
                <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <img src="{{ asset('backend/images/' . $labEmployee->image->path) }}" alt="avatar"
                            class="rounded-circle avatar-md mr-2">
                    </td>
                    
                    <td><a href="{{ route('labEmployees.show', $labEmployee->id) }}">{{ $labEmployee->name }}</a></td>

                    <td>{{ $labEmployee->email }}</td>

                    <td>
                        @if ($labEmployee->status)
                            <span class="label text-success">{{ __('const.status.active') }}</span>
                        @else
                            <span class="label text-danger">{{ __('const.status.inactive') }}</span>
                        @endif
                    </td>

                    <td>
                        <a href="{{ route('labEmployees.edit', $labEmployee->id) }}" class="btn btn-sm btn-info"
                            title="{{ __('handle.edit') }}">
                            <i class="las la-pen"></i>
                        </a>

                        <a href="" data-toggle="modal" data-target="#labEmployees-delete-{{ $labEmployee->id }}"
                            class="btn btn-sm btn-danger" title="{{ __('handle.delete.') }}">
                            <i class="ti-trash"></i>
                        </a>

                        @if ($labEmployee->status)
                            <a href="" data-toggle="modal"
                                data-target="#labEmployees-inactivate-{{ $labEmployee->id }}"
                                class="btn btn-sm btn-danger" title="{{ __('handle.inactivate') }}">
                                <i class="fas fa-times-circle"></i>
                            </a>
                        @else
                            <a href="" data-toggle="modal"
                                data-target="#labEmployees-activate-{{ $labEmployee->id }}"
                                class="btn btn-sm btn-success" title="{{ __('handle.activate') }}">
                                <i class="fas fa-check-circle"></i>
                            </a>
                        @endif
                    </td>
                </tr>
                @include('cruds.labEmployees.partials.delete-modal')
                @include('cruds.labEmployees.partials.active-modal')
                @include('cruds.labEmployees.partials.inactive-modal')
            @endforeach
        </tbody>
    </table>
</div>
