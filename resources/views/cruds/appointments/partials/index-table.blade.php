<div class="table-responsive">
    <table class="table text-md-nowrap" id="example1">
        <thead>
            <tr class="text-center">
                <th class="wd-5p">#</th>
                @if (!auth()->guard('doctor')->check())
                    <th>{{ __('users.doctor') }}</th>
                @endif
                @if (!auth()->guard('patient')->check())
                    <th>{{ __('users.patient') }}</th>
                @endif
                <th>{{ __('field.notes') }}</th>
                <th>{{ __('const.status.') }}</th>
                <th>{{ __('handle.') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($appointments as $appointment)
                @php
                    $doctorRoute = match (auth()->guard()->name) {
                        'admin' => route('doctors.show', $appointment->doctor->id),
                        'patient' => route('patient.doctors.show', $appointment->doctor->id),
                        'doctor' => route('doctor.show'),
                    };
                    $patientRoute = match (auth()->guard()->name) {
                        'admin' => route('patients.show', $appointment->patient->id),
                        'doctor' => route('doctor.patients.show', $appointment->patient->id),
                        'patient' => route('patient.show'),
                    };
                    $color = match ($appointment->status) {
                        'pending' => 'danger',
                        'in-progress' => 'warning',
                        'completed' => 'success',
                    };
                @endphp

                <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>

                    @if (!auth()->guard('doctor')->check())
                        <td>
                            <a href="{{ $doctorRoute }}">{{ $appointment->doctor->name }}</a>
                        </td>
                    @endif

                    @if (!auth()->guard('patient')->check())
                        <td>
                            <a href="{{ $patientRoute }}">{{ $appointment->patient->name }}</a>
                        </td>
                    @endif

                    <td>{{ Str::limit($appointment->notes, 30) }}</td>

                    <td>
                        <span class="badge badge-{{ $color }}">
                            {{ __("statistics.$appointment->status.") }}
                        </span>
                    </td>

                    <td>
                        <button data-toggle="modal" data-target="#appointments-show-{{ $appointment->id }}"
                            class="btn btn-sm btn-info" title="{{ __('field.date.&time') }}">
                            <i class="las la-info-circle"></i>
                        </button>

                        @if (auth()->guard('doctor')->check() && $appointment->status === 'pending')
                            <button data-toggle="modal" data-target="#appointments-approve-{{ $appointment->id }}"
                                class="btn btn-sm btn-success" title="{{ __('handle.approve') }}">
                                <i class="fas fa-check"></i>
                            </button>

                            <button data-toggle="modal" data-target="#appointments-refuse-{{ $appointment->id }}"
                                class="btn btn-sm btn-danger" title="{{ __('handle.refuse') }}">
                                <i class="fas fa-remove-format"></i>
                            </button>
                        @endif
                    </td>
                </tr>
                @include('cruds.appointments.partials.show-modal')
                @include('cruds.appointments.partials.approve-modal')
                @include('cruds.appointments.partials.refuse-modal')
            @endforeach
        </tbody>
    </table>
</div>
