@if (session('sent'))
    <div class="col-lg-12 col-md-12 col-sm-12 text-center form-group">
        <div class="alert alert-success d-flex align-items-center justify-content-between" role="alert">
            <div class="alert-text">
                {{ __('validation.sent') }}
            </div>
            <button aria-label="Close" class="close p-0" data-dismiss="alert" type="button">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
@endif
