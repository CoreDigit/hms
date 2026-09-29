<div class="modal" id="invoices-edit-{{ $invoice->id }}">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{ __('cruds.invoice.*') }} |
                    {{ __('handle.edit') }}</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('invoices.update', $invoice->id) }}" method="POST" autocomplete="off">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <div class="col">
                            <label>{{ __('users.patient') }}</label>
                            <select name="patient_id" class="form-control select2-show-search select2-dropdown">
                                @foreach ($patients as $patient)
                                    <option value="{{ $patient->id }}" @selected($patient->id === $invoice->patient->id)>
                                        {{ $patient->name }}</option>
                                @endforeach
                            </select>
                            @error('patient_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col">
                            <label>{{ __('users.doctor') }}</label>
                            <select name="doctor_id" class="form-control select2-show-search select2-dropdown">
                                @foreach ($doctors as $doctor)
                                    <option value="{{ $doctor->id }}" @selected($doctor->id === $invoice->doctor->id)>{{ $doctor->name }}</option>
                                @endforeach
                            </select>
                            @error('doctor_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label>{{ __('cruds.services.') }}</label>
                            <select name="service_id" class="form-control select2-show-search select2-dropdown">
                                <optgroup label="{{ __('cruds.services.single') }}">
                                    @foreach ($servicesWhereSingle as $service)
                                        <option value="{{ $service->id }}" @selected($service->id === $invoice->service->id)>
                                            {{ $service->name }} (${{ $service->price }})
                                        </option>
                                    @endforeach
                                </optgroup>
                                <optgroup label="{{ __('cruds.services.multi') }}">
                                    @foreach ($servicesWhereMulti as $service)
                                        <option value="{{ $service->id }}" @selected($service->id === $invoice->service->id)>
                                            {{ $service->name }} (${{ $service->price }})
                                        </option>
                                    @endforeach
                                </optgroup>
                            </select>
                            @error('service_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col">
                            <label>{{ __('const.case.') }}</label>
                            <select name="case" class="form-control">
                                <option value="paid" @selected($invoice->case === 'paid')>{{ __('const.case.paid') }}</option>
                                <option value="pending" @selected($invoice->case === 'pending')>{{ __('const.case.pending') }}</option>
                            </select>
                            @error('case')
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
