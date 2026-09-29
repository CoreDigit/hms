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
                    @foreach ($labs as $lab)
                        <tr class="text-center">
                            <td>
                                <a href="{{ route('doctors.show', $lab->diagnostic->doctor->id) }}">
                                    {{ $lab->diagnostic->doctor->name }}
                                </a>
                            </td>
                            <td>
                                @php
                                    $statusColor = match ($lab->status) {
                                        'pending' => 'danger',
                                        'completed' => 'success',
                                    };
                                @endphp
                                <span class="badge badge-{{ $statusColor }}">
                                    {{ __("const.case.$lab->status") }}
                                </span>
                            </td>
                            <td>
                                <button data-toggle="modal" data-target="#labs-show-{{ $lab->id }}"
                                    class="btn btn-sm btn-info" title="{{ __('field.info') }}">
                                    <i class="las la-info-circle"></i>
                                </button>
                            </td>        
                        </tr>
                        @include('cruds.labs.partials.show-modal')
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
