<div class="modal" id="diagnostics-redirect-to-ray-{{ $diagnostic->id }}">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">
                    {{ __('cruds.diagnostics') }} | {{ __('handle.redirect.ray') }}
                </h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('doctor.diagnostics.redirect-to-ray', $diagnostic->id) }}" method="POST"
                    autocomplete="off">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <div class="col">
                            <label>{{ __('field.description') }}</label>
                            <textarea name="description" rows="5" class="form-control">{{ $diagnostic->ray->description }}</textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    @if ($diagnostic->ray->diagnosis)
                        <div class="row mb-3">
                            <div class="col">
                                <label>{{ __('field.diagnosis') }}</label>
                                <textarea readonly name="diagnosis" rows="5" class="form-control">{{ $diagnostic->ray->diagnosis }}</textarea>
                                @error('diagnosis')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    @endif

                    <button class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5">
                        {{ __('handle.redirect.ray') }}
                    </button>
                    <button class="btn ripple btn-secondary pd-x-30 mg-r-5 mg-t-5" data-dismiss="modal" type="button">
                        {{ __('handle.close') }}
                    </button>
                </form>
            </div>
            <div class="modal-footer">
                @if ($diagnostic->ray->exists && $diagnostic->ray->images->count())
                    <a href="{{ route('doctor.rays.gallery', $diagnostic->ray->id) }}" class="btn btn-primary">
                        <i class="las la-eye"></i> &nbsp;&nbsp; {{ __('handle.show.images') }}
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
