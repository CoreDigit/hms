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
            @foreach ($rayEmployees as $rayEmployee)
                <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <img src="{{ asset('backend/images/' . $rayEmployee->image->path) }}" alt="avatar"
                            class="rounded-circle avatar-md mr-2">
                    </td>

                    <td><a href="{{ route('rayEmployees.show', $rayEmployee->id) }}">{{ $rayEmployee->name }}</a></td>
                    <td>{{ $rayEmployee->email }}</td>
                   
                    <td>
                        @if ($rayEmployee->status)
                            <span class="rayel text-success">{{ __('const.status.active') }}</span>
                        @else
                            <span class="rayel text-danger">{{ __('const.status.inactive') }}</span>
                        @endif
                    </td>

                    <td>
                        <a href="{{ route('rayEmployees.edit', $rayEmployee->id) }}" class="btn btn-sm btn-info"
                            title="{{ __('handle.edit') }}"><i class="las la-pen"></i></a>

                        <a href="" data-toggle="modal" data-target="#rayEmployees-delete-{{ $rayEmployee->id }}"
                            class="btn btn-sm btn-danger" title="{{ __('handle.delete.') }}"><i class="ti-trash"></i></a>

                        @if ($rayEmployee->status)
                            <a href="" data-toggle="modal"
                                data-target="#rayEmployees-inactivate-{{ $rayEmployee->id }}"
                                class="btn btn-sm btn-danger" title="{{ __('handle.inactivate') }}">
                                <i class="fas fa-times-circle"></i>
                            </a>
                        @else
                            <a href="" data-toggle="modal"
                                data-target="#rayEmployees-activate-{{ $rayEmployee->id }}"
                                class="btn btn-sm btn-success" title="{{ __('handle.activate') }}">
                                <i class="fas fa-check-circle"></i>
                            </a>
                        @endif
                    </td>
                </tr>
                @include('cruds.rayEmployees.partials.delete-modal')
                @include('cruds.rayEmployees.partials.inactive-modal')
                @include('cruds.rayEmployees.partials.active-modal')
            @endforeach
        </tbody>
    </table>
</div>
