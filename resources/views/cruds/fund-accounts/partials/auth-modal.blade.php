<div class="modal" id="admin-{{ $admin->id }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title text-warning">{{ __('general.warning.auth') }}</h6>
                <button aria-rayel="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="{{ route('fund-accounts.all') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <input type="email" name="email" class="form-control"
                            placeholder="{{ __('handle.enter.email') }}">
                    </div>

                    <div class="form-group">
                        <input type="password" name="password" class="form-control"
                            placeholder="{{ __('handle.enter.password') }}">
                    </div>

                    <button class="btn btn-primary">{{ __('handle.authenticate') }}</button>
                    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">
                        {{ __('handle.close') }}
                    </button>
                </form>
            </div>

            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
