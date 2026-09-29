<div class="table-responsive">
    <table class="table text-md-nowrap" id="example1">
        <thead>
            <tr class="text-center">
                <th class="wd-5p">#</th>
                @if (!auth()->guard('doctor')->check())
                    <th>{{ __('users.doctor') }}</th>
                @endif
                    <th>{{ __('users.patient') }}</th>
                <th>{{ __('const.status.') }}</th>
                @if (auth()->guard('doctor')->check())
                    <th>{{ __('field.diagnosis') }}</th>
                    <th>{{ __('cruds.lab') }}</th>
                    <th>{{ __('cruds.ray') }}</th>
                @endif
                <th>{{ __('handle.') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($diagnostics as $diagnostic)
                @php
                    $doctorRoute = auth()->guard('admin')->check() ? 
                        route('doctors.show', $diagnostic->doctor->id) : '';
                    $patientRoute = match (auth()->guard()->name) {
                        'admin' => route('patients.show', $diagnostic->patient->id),
                        'doctor' => route('doctor.patients.show', $diagnostic->patient->id),
                    };
                    $color = match ($diagnostic->status) {
                        'pending' => 'danger',
                        'in-progress' => 'warning',
                        'completed' => 'success',
                    };
                @endphp

                <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>

                    @if (!auth()->guard('doctor')->check())
                        <td>
                            <a href="{{ $doctorRoute }}">{{ $diagnostic->doctor->name }}</a>
                        </td>
                    @endif

                    <td>
                        <a href="{{ $patientRoute }}">{{ $diagnostic->patient->name }}</a>
                    </td>

                    <td>
                        <span class="badge badge-{{ $color }}">
                            {{ __("statistics.$diagnostic->status.") }}
                        </span>
                    </td>

                    @if (auth()->guard('doctor')->check())
                        <td>
                            <a href="" data-toggle="modal"
                                data-target="#diagnostics-diagnosis-{{ $diagnostic->id }}">
                                @if ($diagnostic->diagnosis)
                                    <span class="badge badge-pill badge-success">
                                        {{ __('statistics.completed.') }}
                                    </span>
                                @else
                                    <i class="text-primary fa fa-stethoscope" title="{{ __('handle.diagnose') }}"></i>
                                @endif
                            </a>
                        </td>

                        <td>
                            <a href="" data-toggle="modal"
                                data-target="#diagnostics-redirect-to-lab-{{ $diagnostic->id }}">
                                @if ($diagnostic->lab->exists)
                                    @php
                                        $statusColor = match ($diagnostic->lab->status) {
                                            'pending' => 'danger',
                                            'completed' => 'success',
                                        };
                                        $status = $diagnostic->lab->status;
                                    @endphp
                                    <span class="badge badge-pill badge-{{ $statusColor }}">
                                        {{ __("statistics.$status.") }}
                                    </span>
                                @else
                                    <i class="text-warning fas fa-syringe" title="{{ __('handle.redirect.lab') }}"></i>
                                @endif
                            </a>
                        </td>

                        <td>
                            <a href="" data-toggle="modal"
                                data-target="#diagnostics-redirect-to-ray-{{ $diagnostic->id }}">
                                @if ($diagnostic->ray->exists)
                                    @php
                                        $statusColor = match ($diagnostic->ray->status) {
                                            'pending' => 'danger',
                                            'completed' => 'success',
                                        };
                                        $status = $diagnostic->ray->status;
                                    @endphp
                                    <span class="badge badge-pill badge-{{ $statusColor }}">
                                        {{ __("statistics.$status.") }}
                                    </span>
                                @else
                                    <i class="text-primary fas fa-x-ray" title="{{ __('handle.redirect.ray') }}"></i>
                                @endif
                            </a>

                            @if ($diagnostic->ray->exists && $diagnostic->ray->images->count())
                                <a href="" data-toggle="modal"
                                    data-target="#diagnostics-show-ray-images-{{ $diagnostic->id }}"
                                    class="btn btn-sm btn-light" title="{{ __('handle.show.images') }}">
                                    <i class="las la-images"></i>
                                </a>
                            @endif
                        </td>
                    @endif

                    <td>
                        <button data-toggle="modal" data-target="#diagnostics-show-{{ $diagnostic->id }}"
                            class="btn btn-sm btn-info" title="{{ __('field.info') }}">
                            <i class="las la-info-circle"></i>
                        </button>
                    </td>
                </tr>
                @include('cruds.diagnostics.partials.show-modal')
                @include('cruds.diagnostics.partials.diagnosis-modal')
                @include('cruds.diagnostics.partials.redirect-to-ray-modal')
                @include('cruds.diagnostics.partials.redirect-to-lab-modal')
            @endforeach
        </tbody>
    </table>
</div>
