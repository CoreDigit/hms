<div class="table-responsive">
    <table class="table text-md-nowrap" id="example1">
        <thead>
            <tr class="text-center">
                <th class="wd-5p">#</th>
                <th>{{ __('users.doctor') }}</th>
                <th>{{ __('users.patient') }}</th>
                <th>{{ __('const.status.') }}</th>
                <th>{{ __('handle.') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rays as $ray)
                <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <a
                            href="{{ auth()->guard('admin')->check()? route('doctors.show', $ray->diagnostic->doctor->id): '#' }}">
                            {{ $ray->diagnostic->doctor->name }}
                        </a>
                    </td>
                    <td>
                        <a
                            href="{{ auth()->guard('admin')->check()? route('patients.show', $ray->diagnostic->patient->id): '#' }}">
                            {{ $ray->diagnostic->patient->name }}
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
                            {{ __("statistics.$ray->status.") }}
                        </span>
                    </td>
                    <td>
                        <button data-toggle="modal" data-target="#rays-show-{{ $ray->id }}"
                            class="btn btn-sm btn-info" title="{{ __('field.info') }}">
                            <i class="las la-info-circle"></i>
                        </button>

                        @if (auth()->guard('rayEmployee')->check())
                            <button data-toggle="modal" data-target="#rays-diagnosis-{{ $ray->id }}"
                                class="btn btn-sm btn-light" title="{{ __('handle.diagnose') }}">
                                <i class="text-primary fa fa-stethoscope"></i>
                            </button>

                            @if ($ray->images->count())
                                <button data-toggle="modal" data-target="#rays-show-images-{{ $ray->id }}"
                                    class="btn btn-sm btn-light" title="{{ __('handle.show.images') }}">
                                    <i class="las la-images"></i>
                                </button>
                            @endif
                        @endif
                    </td>
                </tr>
                @include('cruds.rays.partials.show-modal')
                @include('cruds.rays.partials.show-images-modal')
                @include('cruds.rays.partials.diagnosis-modal')
            @endforeach
        </tbody>
    </table>
</div>
