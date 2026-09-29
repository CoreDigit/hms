<form action="{{ auth()->guard('patient')->check()? route('patient.update'): route('patients.update', $patient->id) }}"
    method="POST" autocomplete="off" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row row-xs align-items-center mg-b-20">
        <div class="col-md-4">
            <label class="form-label mg-b-0">{{ __('field.name') }}:</label>
        </div>
        <div class="col-md-8 mg-t-5 mg-md-t-0">
            <input class="form-control" placeholder="{{ __('handle.enter.name') }}" type="text" name="name"
                value="{{ $patient->name }}">
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="row row-xs align-items-center mg-b-20">
        <div class="col-md-4">
            <label class="form-label mg-b-0">{{ __('field.email') }}:</label>
        </div>
        <div class="col-md-8 mg-t-5 mg-md-t-0">
            <input class="form-control" placeholder="{{ __('handle.enter.email') }}" type="email" name="email"
                value="{{ $patient->email }}">
            @error('email')
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
                <option value="1" @selected($patient->gender)>{{ __('const.gender.male') }}</option>
                <option value="0" @selected(!$patient->gender)>{{ __('const.gender.female') }}</option>
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
                value="{{ $patient->phone }}">
            @error('phone')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="row row-xs align-items-center mg-b-20">
        <div class="col-md-4">
            <label class="form-label mg-b-0">{{ __('field.blood_type') }}:</label>
        </div>
        <div class="col-md-8 mg-t-5 mg-md-t-0">
            <select class="form-control" name="blood_type">
                <option value="" disabled selected>--- {{ __('handle.select.blood_type') }} ----</option>
                @foreach (['A', 'B', 'O', 'AB'] as $bloodType)
                    <option value="{{ $bloodType }}" @selected($patient->blood_type == $bloodType)>{{ $bloodType }}</option>
                @endforeach
            </select>
            @error('blood_type')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="row row-xs align-items-center mg-b-20">
        <div class="col-md-4">
            <label class="form-label mg-b-0">{{ __('field.birth_date') }}:</label>
        </div>
        <div class="col-md-8 mg-t-5 mg-md-t-0">
            <input class="form-control" type="date" name="birth_date" value="{{ $patient->birth_date }}">
            @error('birth_date')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="row row-xs align-items-center mg-b-20">
        <div class="col-md-4">
            <label class="form-label mg-b-0">{{ __('field.address') }}:</label>
        </div>
        <div class="col-md-8 mg-t-5 mg-md-t-0">
            <textarea id="AboutMe" name="address" class="form-control" rows="5">{{ $patient->address }}</textarea>
            @error('address')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>


    <div class="row row-xs align-items-center mg-b-20">
        <div class="col-md-4">
            <label class="form-label mg-b-0">{{ __('field.image.') }}:</label>
        </div>
        <div class="col-md-3 mg-t-5 mg-md-t-0">
            <input class="form-control" type="file" accept="image/*" onchange="loadFile(event)" name="image">
            @error('image')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-2 mg-t-5 mg-md-t-0">
            <label for="remove_image" class="btn btn-md btn-danger"><i class="fas fa-trash"></i>&nbsp;&nbsp;<input
                    type="checkbox" name="remove_image" id="remove_image"></label>
        </div>
        <div class="col-md-3 mg-t-5 mg-md-t-0">
            <img style="border-radius:50%" width="150px" height="150px" id="output"
                src="{{ asset('backend/images/' . $patient->image->path) }}" />
        </div>
    </div>

    <button class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5">{{ __('handle.update') }}</button>
</form>
