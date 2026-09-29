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
            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                <select wire:model.live='department_id' wire:change='specifyDoctors'>
                    <option value="" selected>---{{ __('handle.select.department') }}---</option>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}">
                            {{ $department->name }} ({{ $department->doctors->count() . ' ' . __('users.doctors') }})
                        </option>
                    @endforeach
                </select>
                <span class="icon fas fa-home"></span>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                <select wire:model.live='doctor_id'>
                    <option selected>---{{ __('handle.select.doctor') }}---</option>
                    @foreach ($doctors as $doctor)
                        <option value="{{ $doctor->id }}">
                            {{ $doctor->name }}
                        </option>
                    @endforeach
                </select>
                <span class="icon fa fa-user"></span>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                <input type="date" wire:model.live="date" min="{{ now()->format('Y-m-d') }}" class="form-control">
                @error('date')
                    <span class="text-danger">{{ __('validation.appointment.date_error') }}</span>
                @enderror
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                <textarea placeholder="Notes" wire:model.live='notes'></textarea>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                <button class="theme-btn btn-style-two" type="submit" name="submit-form">
                    <span class="txt">{{ __('cruds.appointment') }}</span>
                </button>
            </div>
        </div>
    </form>
</div>
