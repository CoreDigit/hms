<div class="appointment-form">
    @if ($appointment_booked)
        <div class="alert alert-info">{{ __('validation.appointment.booked') }}</div>
    @elseif ($appointment_there)
        <div class="alert alert-warning">{{ __('validation.appointment.there') }}</div>
    @elseif ($appointment_date_error)
        <div class="alert alert-danger">{{ __('validation.appointment.date_error') }}</div>
    @endif

    <form wire:submit='store'>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                <input type="date" wire:model.live="date" min="{{ now()->format('Y-m-d') }}" class="form-control">
                @error('date')
                    <span class="text-danger">{{ __('validation.appointment.date_error') }}</span>
                @enderror
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                <textarea placeholder="Notes" wire:model.live='notes'></textarea>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 form-group text-center">
                <button class="theme-btn btn-style-two" type="submit" name="submit-form">
                    <span class="txt">{{ __('cruds.appointment') }}</span>
                </button>
            </div>
        </div>
    </form>
</div>
