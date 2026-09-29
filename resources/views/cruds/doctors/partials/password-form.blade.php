<form method="POST" action="{{ auth()->guard('doctor')->check()? route('doctor.update.password') : route('doctors.update.password', $doctor->id) }}">
    @csrf
    @method('PUT')

    <div class="">
        <div class="form-group">
            <label for="current_password">{{ __('field.password.current') }}</label>
            <input id="current_password" class="form-control" name="current_password" type="password">
            @error('current_password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">{{ __('field.password.new') }}</label>
            <input id="password" class="form-control" name="password" type="password">
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="password_confirmation">{{ __('field.password.confirm') }}</label>
            <input id="password_confirmation" class="form-control" name="password_confirmation" type="password">
            @error('password_confirmation')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <button type="submit" class="btn btn-primary mt-3 mb-0">{{ __('handle.update') }}</button>
</form>