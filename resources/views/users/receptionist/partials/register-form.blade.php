<form action="{{ route('receptionist.register') }}" method="POST" autocomplete="off">
    @csrf
    
    <div class="form-group">
        <label class="form-label mg-b-0">{{ __('field.name') }}</label>
        <input class="form-control" placeholder="{{ __('handle.enter.name') }}" type="text" name="name" value="{{ old('name') }}" required>
        @error('name')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label class="form-label mg-b-0">{{ __('field.email') }}</label>
        <input class="form-control" placeholder="{{ __('handle.enter.email') }}" type="email" name="email" value="{{ old('email') }}" required>
        @error('email')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label class="form-label mg-b-0">{{ __('field.password.') }}</label>
        <input class="form-control" placeholder="{{ __('handle.enter.password') }}" type="password" name="password" required>
        @error('password')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <button class="btn btn-main-primary btn-block">Register as Receptionist</button>
</form>
