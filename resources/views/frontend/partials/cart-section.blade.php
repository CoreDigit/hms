<section class="cart-section p-0" style="margin-bottom: 6rem">
    <div class="auto-container">
        <!--Cart Outer-->
        <div class="cart-outer">
            <div class="table-outer">
                <table class="cart-table">
                    <thead class="cart-header">
                        <tr>
                            <th>#</th>
                            <th class="prod-column">{{ __('field.name') }}</th>
                            <th class="price">{{ __('field.price') }}</th>
                            <th>{{ __('field.quantity') }}</th>
                            <th>{{ __('statistics.total.') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($multiService->singleServices as $singleService)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <h4 class="prod-title">{{ $singleService->name }}</h4>
                                </td>
                                <td class="sub-total">${{ $singleService->service->price }}</td>
                                <td class="qty">
                                    <div class="item-quantity style-two">
                                        <input class="quantity-spinner" type="text" readonly
                                            value="{{ $singleService->pivot->quantity }}">
                                    </div>
                                </td>
                                <td class="total">${{ $singleService->getTotalPrice() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
