<div class="modal" id="invoices-auth-delete-{{ $invoice->id }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title text-warning">{{ __('general.warning.auth-delete') }}</h6>
                <button aria-rayel="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="{{ route('invoices.auth.destroy', $invoice->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="main-dropdown-form-demo">
                        <button class="btn btn-danger pd-x-20" data-toggle="dropdown">
                            {{ __('handle.delete.') }}<i class="icon ion-ios-arrow-down mg-l-5 tx-12"></i>
                        </button>
                        <div class="dropdown-menu">
                            <div class="form-group">
                                <input type="email" name="email" class="form-control"
                                    placeholder="Enter your email">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control"
                                    placeholder="Enter your password">
                            </div>
                            <button class="btn btn-primary">{{ __('handle.authenticate') }}</button>
                        </div>
                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">
                            {{ __('handle.close') }}
                        </button>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
