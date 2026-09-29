<form action="{{ auth()->guard('doctor')->check()? route('doctor.update'): route('doctors.update', $doctor->id) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row row-xs align-items-center mg-b-20">
        <div class="col-md-4">
            <label class="form-label mg-b-0">{{ __('field.name') }}:</label>
        </div>
        <div class="col-md-8 mg-t-5 mg-md-t-0">
            <input class="form-control" placeholder="{{ __('handle.enter.name') }}" type="text" name="name"
                value="{{ $doctor->name }}">
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
                value="{{ $doctor->email }}">
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
                <option value="1" @selected($doctor->gender)>{{ __('const.gender.male') }}</option>
                <option value="0" @selected(!$doctor->gender)>{{ __('const.gender.female') }}</option>
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
                value="{{ $doctor->phone }}">
            @error('phone')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="row row-xs align-items-center mg-b-20">
        <div class="col-md-4">
            <label class="form-label mg-b-0">{{ __('field.specialty') }}:</label>
        </div>
        <div class="col-md-8 mg-t-5 mg-md-t-0">
            <input class="form-control" placeholder="{{ __('handle.enter.specialty') }}" type="text"
                name="specialty" value="{{ $doctor->specialty }}">
            @error('specialty')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="row row-xs align-items-center mg-b-20">
        <div class="col-md-4">
            <label class="form-label mg-b-0">{{ __('cruds.department') }}:</label>
        </div>
        <div class="col-md-8 mg-t-5 mg-md-t-0">
            <select class="form-control" name="department_id">
                @foreach ($departments as $department)
                    <option value="{{ $department->id }}" @selected($doctor->department_id == $department->id)>{{ $department->name }}</option>
                @endforeach
            </select>
            @error('department')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="row row-xs align-items-center mg-b-20">
        <div class="col-md-4">
            <label class="form-label mg-b-0">{{ __('field.number_of.appointments') }}:</label>
        </div>
        <div class="col-md-8 mg-t-5 mg-md-t-0">
            <input class="form-control" type="number" min="1" max="20" value="5"
                name="number_of_appointments" value="{{ $doctor->number_of_appointments }}">
            @error('number_of_appointments')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="row row-xs align-items-center mg-b-20">
        <div class="col-md-4">
            <label class="form-label mg-b-0">{{ __('field.bio') }}:</label>
        </div>
        <div class="col-md-8 mg-t-5 mg-md-t-0">
            <textarea id="AboutMe" name="bio" class="form-control" rows="5">{{ $doctor->bio }}</textarea>
            @error('bio')
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
                src="{{ asset('backend/images/' . $doctor->image->path) }}" />
        </div>
    </div>

    <button class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5">{{ __('handle.update') }}</button>
</form>
