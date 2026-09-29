<form action="{{ route('rayEmployee.login') }}" method="POST">
    @csrf

    <div class="form-group">
        <label>{{ __('field.email') }}</label>
        <input name="email" type="email" class="form-control" placeholder="{{ __('handle.enter.email') }}">
        @error('email')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label>{{ __('field.password.') }}</label>
        <input name="password" type="password" class="form-control" placeholder="{{ __('handle.enter.password') }}">
        @error('password')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <button class="btn btn-main-primary btn-block">{{ __('auth.login.') }}</button>
</form>
