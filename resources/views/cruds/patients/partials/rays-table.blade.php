<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table mb-0 text-md-nowrap">
                <thead>
                    <tr class="text-center">
                        <th>{{ __('users.doctor') }}</th>
                        <th>{{ __('const.status.') }}</th>
                        <th>{{ __('handle.') }}</th>
                            </tr>
                </thead>
                <tbody>
                    @foreach ($rays as $ray)
                        <tr class="text-center">
                            <td>
                                <a href="{{ route('doctors.show', $ray->diagnostic->doctor->id) }}">
                                    {{ $ray->diagnostic->doctor->name }}
                                </a>
                            </td>
                            <td>
                                @php
                                    $statusColor = match ($ray->status) {
                                        'pending' => 'danger',
                                        'completed' => 'success',
                                    };
                                @endphp
                                <span class="badge badge-{{ $statusColor }}">
                                    {{ __("const.case.$ray->status") }}
                                </span>
                            </td>
                            <td>
                                <button data-toggle="modal" data-target="#rays-show-{{ $ray->id }}"
                                    class="btn btn-sm btn-info" title="{{ __('field.info') }}">
                                    <i class="las la-info-circle"></i>
                                </button>
                            </td>        
                        </tr>
                        @include('cruds.rays.partials.show-modal')
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
