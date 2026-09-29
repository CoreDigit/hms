<div class="modal" id="receipts-edit-{{ $receipt->id }}">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{ __('cruds.receipt.*') }} |
                    {{ __('handle.edit') }}</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('receipts.update', $receipt->id) }}" method="POST" autocomplete="off">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <div class="col">
                            <label>{{ __('users.patient') }}</label>
                            <select name="patient_id" class="form-control select2-show-search select2-dropdown">
                                <option disabled selected>{{ __('handle.select.patient') }}</option>
                                @foreach ($patients as $patient)
                                    <option value="{{ $patient->id }}" @selected($patient->id === $receipt->patient->id)>{{ $patient->name }}</option>
                                @endforeach
                            </select>
                            @error('patient_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col">
                            <label>{{ __('field.amount') }}</label>
                            <input type="number" step="0.05" name="amount" class="form-control" value="{{ $receipt->amount }}">
                            @error('amount')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label>{{ __('field.notes') }}</label>
                            <textarea id="AboutMe" name="notes" class="form-control" rows="3">{{ $receipt->notes }}</textarea>
                            @error('notes')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <button
                        class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5">{{ __('handle.update') }}</button>
                    <button class="btn ripple btn-secondary pd-x-30 mg-r-5 mg-t-5" data-dismiss="modal"
                        type="button">{{ __('handle.close') }}</button>
                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
