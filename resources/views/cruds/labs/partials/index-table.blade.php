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
            @foreach ($labs as $lab)
                <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <a
                            href="{{ auth()->guard('admin')->check()? route('doctors.show', $lab->diagnostic->doctor->id): '#' }}">
                            {{ $lab->diagnostic->doctor->name }}
                        </a>
                    </td>
                    <td>
                        <a
                            href="{{ auth()->guard('admin')->check()? route('patients.show', $lab->diagnostic->patient->id): '#' }}">
                            {{ $lab->diagnostic->patient->name }}
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
                            {{ __("statistics.$lab->status.") }}
                        </span>
                    </td>
                    <td>
                        <button data-toggle="modal" data-target="#labs-show-{{ $lab->id }}"
                            class="btn btn-sm btn-info" title="{{ __('field.info') }}">
                            <i class="las la-info-circle"></i>
                        </button>

                        @if (auth()->guard('labEmployee')->check())
                            <button data-toggle="modal" data-target="#labs-diagnosis-{{ $lab->id }}"
                                class="btn btn-sm btn-light" title="{{ __('handle.diagnose') }}">
                                <i class="text-primary fa fa-stethoscope"></i>
                            </button>

                            @if ($lab->images->count())
                                <button data-toggle="modal" data-target="#labs-show-images-{{ $lab->id }}"
                                    class="btn btn-sm btn-light" title="{{ __('handle.show.images') }}">
                                    <i class="las la-images"></i>
                                </button>
                            @endif
                        @endif
                    </td>
                </tr>
                @include('cruds.labs.partials.show-modal')
                @include('cruds.labs.partials.show-images-modal')
                @include('cruds.labs.partials.diagnosis-modal')
            @endforeach
        </tbody>
    </table>
</div>
