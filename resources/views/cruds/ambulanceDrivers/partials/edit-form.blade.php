<form action="{{ route('ambulanceDrivers.update', $ambulanceDriver->id) }}" method="POST" autocomplete="off"
    enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row row-xs align-items-center mg-b-20">
        <div class="col-md-4">
            <label class="form-label mg-b-0">{{ __('field.name') }}:</label>
        </div>
        <div class="col-md-8 mg-t-5 mg-md-t-0">
            <input class="form-control" placeholder="{{ __('handle.enter.name') }}" type="text" name="name"
                value="{{ $ambulanceDriver->name }}">
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="row row-xs align-items-center mg-b-20">
        <div class="col-md-4">
            <label class="form-label mg-b-0">{{ __('const.gender.') }}:</label>
        </div>
        <div class="col-md-8 mg-t-5 mg-md-t-0">
            <select class="form-control" name="gender">
                <option value="" disabled selected>--- {{ __('handle.select.gender') }} ----</option>
                <option value="1" @selected($ambulanceDriver->gender)>{{ __('const.gender.male') }}</option>
                <option value="0" @selected(!$ambulanceDriver->gender)>{{ __('const.gender.female') }}</option>
            </select>
            @error('gender')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="row row-xs align-items-center mg-b-20">
        <div class="col-md-4">
            <label class="form-label mg-b-0">{{ __('field.phone') }}:</label>
        </div>
        <div class="col-md-8 mg-t-5 mg-md-t-0">
            <input class="form-control" placeholder="{{ __('handle.enter.phone') }}" type="text" name="phone"
                value="{{ $ambulanceDriver->phone }}">
            @error('phone')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="row row-xs align-items-center mg-b-20">
        <div class="col-md-4">
            <label class="form-label mg-b-0">{{ __('field.license_number') }}:</label>
        </div>
        <div class="col-md-8 mg-t-5 mg-md-t-0">
            <input class="form-control" placeholder="{{ __('handle.enter.license_number') }}" type="text"
                name="license_number" value="{{ $ambulanceDriver->license_number }}">
            @error('license_number')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="row row-xs align-items-center mg-b-20">
        <div class="col-md-4">
            <label class="form-label mg-b-0">{{ __('field.address') }}:</label>
        </div>
        <div class="col-md-8 mg-t-5 mg-md-t-0">
            <textarea id="AboutMe" name="address" class="form-control" rows="5">{{ $ambulanceDriver->address }}</textarea>
            @error('address')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <button class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5">{{ __('handle.update') }}</button>
</form>
