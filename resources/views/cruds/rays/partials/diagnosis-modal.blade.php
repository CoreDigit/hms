<div class="modal" id="rays-diagnosis-{{ $ray->id }}">
    <div class="modal-dialog modal-dialog-scrolrayle" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">
                    {{ __('cruds.rays') }} | {{ __('field.diagnosis') }}
                </h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('rayEmployee.rays.diagnosis', $ray->id) }}" method="POST"
                    autocomplete="off" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <div class="col">
                            <label>{{ __('field.diagnosis') }}</label>
                            <textarea name="diagnosis" rows="3" class="form-control">{{ $ray->diagnosis }}</textarea>
                            @error('diagnosis')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label>{{ __('field.image.*') }}</label>
                            <input type="file" multiple name="images[]" class="form-control">
                            @error('images')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <button class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5">
                        {{ __('handle.diagnose') }}
                    </button>
                    <button class="btn ripple btn-secondary pd-x-30 mg-r-5 mg-t-5" data-dismiss="modal" type="button">
                        {{ __('handle.close') }}
                    </button>
                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
