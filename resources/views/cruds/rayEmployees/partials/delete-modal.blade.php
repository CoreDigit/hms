<div class="modal" id="rayEmployees-delete-{{ $rayEmployee->id }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">
                    {{ __('general.warning.delete_account.0') }}
                </h6>

                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <p class="text-muted">{{ __('general.warning.delete_account.2') }}</p>

                <form action="{{ auth()->guard('admin')->check() ? route('rayEmployees.destroy', $rayEmployee->id) : route('rayEmployee.destroy') }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <div class="form-group mt-3">
                        <input type="password" name="last_password" class="form-control"
                        placeholder="{{ __('handle.enter.password') }}">
                        @error('last_password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <button class="btn btn-danger">{{ __('handle.delete.') }}</button>
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
