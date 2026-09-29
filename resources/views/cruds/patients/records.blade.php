@extends('users.' . auth()->guard()->name . '.layouts.master')

@extends('cruds.layouts.timeline')

@section('title1')
    {{ __('users.patients') }}
@endsection

@section('title2')
    {{ __('general.words.records_timeline') }}
@endsection

@section('title3')
    {{ $patient->name }}
@endsection

@section('timeline')
    <div class="vtimeline">
        @foreach ($records as $record)
            @php
                switch ($record->recordType) {
                    case 'appointment':
                        $wrapperColor = 'secondary';
                        $badgeIcon = 'las la-business-time';
                        $body = $record->notes;
                        break;
                    case 'diagnostic':
                        $wrapperColor = 'primary';
                        $badgeIcon = 'las la-check-circle';
                        $body = $record->diagnosis;
                        break;
                }
                $textColor = match ($record->status) {
                    'pending' => 'danger',
                    'in-progress' => 'warning',
                    'completed' => 'success',
                };
            @endphp
            <div class="timeline-wrapper timeline-wrapper-{{ $wrapperColor }}  {{ $loop->odd ?: 'timeline-inverted' }}">
                <div class="timeline-badge">
                    <i class="{{ $badgeIcon }}"></i>
                </div>
                <div class="timeline-panel">
                    <div class="timeline-heading">
                        <h6 class="timeline-title">
                            {{ __('cruds.' . $record->recordType) }}
                        </h6>
                        <span class="text-{{ $textColor }}">
                            {{ __("statistics.$record->status.") }}
                        </span>
                    </div>
                    <div class="timeline-body mb-3">
                        <p>{{ $body }}</p>
                    </div>
                    <div class="timeline-footer d-flex align-items-center flex-wrap">
                        <span>
                            <i class="fe fe-heart text-muted mr-1"></i>
                            {{ __('general.words.dr') }} {{ $record->doctor->name }}
                        </span>
                        <span class="ml-auto">
                            <i class="fe fe-calendar text-muted mr-1"></i>
                            {{ $record->created_at->format('jS M Y') }}
                        </span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
