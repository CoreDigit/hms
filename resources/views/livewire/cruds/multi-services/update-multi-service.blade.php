<div>
    <form wire:submit='update'>
        <div class="row mb-3">
            <div class="col">
                <label>{{ __('field.name') }}</label>
                <input type="text" wire:model.live="name" class="form-control">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label>{{ __('field.description') }}</label>
                <textarea wire:model.live="description" class="form-control" rows="5"></textarea>
                @error('description')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="row mb-5">
            <div class="col">
                <label>{{ __('cruds.services.single') }}</label>

                <div class="product-details table-responsive text-nowrap">
                    <table class="table table-bordered table-hover mb-0 text-nowrap text-center">
                        <thead>
                            <tr>
                                <th>{{ __('field.name') }}</th>
                                <th>{{ __('field.quantity') }}</th>
                                <th>{{ __('field.price') }}</th>
                                <th>{{ __('handle.') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Selected Single Services --}}
                            @foreach ($selectedSingleServices as $id => $service)
                                <tr>
                                    <td>{{ $service['name'] }}</td>
                                    <td>{{ $service['quantity'] }}</td>
                                    <td wire:model.live="price" class="text-center text-lg text-medium">
                                        {{ $service['price'] }}</td>
                                    <td class="text-center">
                                        <button wire:click.prevent="remove({{ $id }})" class="btn btn-sm btn-danger"
                                            title="{{ __('handle.remove.') }}">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach

                            {{-- Add Single Service --}}
                            @if ($createView)
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <select wire:model.live="single_service_id" wire:change="getServicePrice"
                                                class="form-control">
                                                <option value="" selected>{{ __('handle.select.service') }}
                                                </option>
                                                @foreach ($singleServices as $service)
                                                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('single_service_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="number" min="1" max="10" wire:model.live="quantity"
                                                wire:change="getServicePrice" class="form-control">
                                            @error('quantity')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </td>
                                    <td wire:model.live="price" class="text-center text-lg text-medium">
                                        {{ $price }}
                                    </td>
                                    <td class="text-center">
                                        <button wire:click.prevent="confirm" class="btn btn-sm btn-primary"
                                            title="{{ __('handle.confirm') }}">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endif

                            {{-- Last table col to display total price --}}
                            <tr>
                                <th colspan="2">{{ __('statistics.total.price') }}:</th>
                                <td wire:model.live="total_before_discount">{{ $total_before_discount }}</td>
                                <th>
                                    <button wire:click.prevent="create" class="btn btn-sm btn-outline-primary">
                                        {{ __('handle.create') }}
                                    </button>
                                    <button wire:click.prevent="removeAll" class="btn btn-sm btn-outline-danger">
                                        {{ __('handle.remove.all') }}
                                    </button>
                                </th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label>{{ __('field.discount.value') }}</label>
                <input type="number" min="0" wire:model.live="discount_value" wire:change='calculateTotals' class="form-control">
                @error('discount_value')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col">
                <label>{{ __('field.tax.rate') }}</label>
                <input type="number" min="0" max="100" wire:model.live="tax_rate" wire:change='calculateTotals' class="form-control">
                @error('tax_rate')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label>{{ __('statistics.total.after_discount') }}</label>
                <input readonly type="number" min="0" wire:model.live="total_after_discount" class="form-control">
                @error('total_after_discount')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col">
                <label>{{ __('statistics.total.with_tax') }}</label>
                <input readonly type="number" min="0" max="100" wire:model.live="total_with_tax" class="form-control">
                @error('total_with_tax')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <button class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5">{{ __('handle.update') }}</button>
        <span wire:loading>{{ __('general.words.saving') }}...</span>
    </form>
</div>
