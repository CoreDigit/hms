<form action="{{ route('patient.register') }}" method="POST" autocomplete="off">
    @csrf
    
    <div class="form-group">
        <label class="form-label mg-b-0">{{ __('field.name') }}</label>
        <input class="form-control" placeholder="{{ __('handle.enter.name') }}" type="text" name="name">
        @error('name')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label class="form-label mg-b-0">{{ __('field.email') }}</label>
        <input class="form-control" placeholder="{{ __('handle.enter.email') }}" type="email" name="email">
        @error('email')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label class="form-label mg-b-0">{{ __('field.password.') }}</label>
        <input class="form-control" placeholder="{{ __('handle.enter.password') }}" type="password" name="password">
        @error('password')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <button class="btn btn-main-primary btn-block">{{ __('handle.register') }}</button>
</form>
