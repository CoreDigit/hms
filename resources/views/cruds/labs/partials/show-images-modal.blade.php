<div class="modal" id="labs-show-images-{{ $lab->id }}">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">
                    {{ __('cruds.labs') }} | {{ __('field.image.*') }}
                </h6>

                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                @foreach ($lab->images()->take(2)->get() as $image)
                    <div class="row row-xs align-items-center mg-b-20">
                        <div class="col">
                            <img src="{{ asset('backend/images/' . $image->path) }}" 
                                alt="{{ __('field.image.lab') }}">
                        </div>
                    </div>                    
                @endforeach
            </div>

            <div class="modal-footer">
                <a href="{{ route('labEmployee.labs.gallery', $lab->id) }}" class="btn btn-primary">
                    <i class="las la-eye"></i> &nbsp;&nbsp; {{ __('handle.show.more') }}
                </a>
            </div>
        </div>
    </div>
</div>
