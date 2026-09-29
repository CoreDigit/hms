<form action="{{ route('ambulanceDrivers.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
    @csrf

    <div class="row row-xs align-items-center mg-b-20">
        <div class="col-md-4">
            <label class="form-label mg-b-0">
                {{ __('field.name') }}:
                <span class="text-danger">*</span>
            </label>
        </div>
        <div class="col-md-8 mg-t-5 mg-md-t-0">
            <input class="form-control" placeholder="{{ __('handle.enter.name') }}" type="text" name="name">
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="row row-xs align-items-center mg-b-20">
        <div class="col-md-4">
            <label class="form-label mg-b-0">
                {{ __('const.gender.') }}:
                <span class="text-danger">*</span>
            </label>
        </div>
        <div class="col-md-8 mg-t-5 mg-md-t-0">
            <select class="form-control" name="gender">
                <option value="" disabled selected>--- {{ __('handle.select.gender') }} ----</option>
                <option value="1">{{ __('const.gender.male') }}</option>
                <option value="0">{{ __('const.gender.female') }}</option>
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
            <input class="form-control" placeholder="{{ __('handle.enter.phone') }}" type="text" name="phone">
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
                name="license_number">
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
            <textarea id="AboutMe" name="address" class="form-control" rows="5"></textarea>
            @error('address')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <button class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5">{{ __('handle.create') }}</button>
</form>
