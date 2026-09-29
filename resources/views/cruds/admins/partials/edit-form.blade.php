<form action="{{ route('admin.update') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row row-xs align-items-center mg-b-20">
        <div class="col-md-4">
            <label class="form-label mg-b-0">{{ __('field.name') }}:</label>
        </div>
        <div class="col-md-8 mg-t-5 mg-md-t-0">
            <input class="form-control" placeholder="{{ __('handle.enter.name') }}" type="text" name="name"
                value="{{ $admin->name }}">
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
                value="{{ $admin->email }}">
            @error('email')
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
                src="{{ asset('backend/images/' . $admin->image->path) }}" />
        </div>
    </div>

    <button class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5">{{ __('handle.update') }}</button>
</form>
