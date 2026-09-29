<div class="modal" id="ambulances-edit-{{ $ambulance->id }}">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">
                    {{ __('cruds.ambulances') }} | {{ __('handle.edit') }}
                </h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('ambulances.update', $ambulance->id) }}" method="POST" autocomplete="off">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <div class="col">
                            <label>{{ __('const.type.') }}</label>
                            <input class="form-control" type="text" name="type" value="{{ $ambulance->type }}">
                            @error('type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col">
                            <label>{{ __('field.number') }}</label>
                            <input class="form-control" type="text" name="number" value="{{ $ambulance->number }}">
                            @error('number')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label>{{ __('field.model') }}</label>
                            <input class="form-control" type="text" name="model" value="{{ $ambulance->model }}">
                            @error('model')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col">
                            <label>{{ __('field.year_made') }}</label>
                            <input class="form-control" type="number" name="year_made"
                                value="{{ $ambulance->year_made }}">
                            @error('year_made')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <button class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5">
                        {{ __('handle.update') }}
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
