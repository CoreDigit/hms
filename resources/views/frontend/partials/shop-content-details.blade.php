<div class="auto-container mt-5">
    <div class="product-details">
        <!--Basic Details-->
        <div class="basic-details">
            <div class="details-header mb-0 d-flex justify-content-between">
                <h4>{{ $multiService->name }}</h4>
                <div class="item-price" style="font-size: 1.5rem;">
                    $ {{ $multiService->getTotalAfterDiscount() }}
                    <span class="discount" style="font-size: 1.5rem;">
                        $ {{ $multiService->total_price }}
                    </span>
                </div>
            </div>
            <div class="text">{{ $multiService->description }}</div>

            <div class="row clearfix">
                <div class="image-column col-lg-6 col-md-12 col-sm-12">
                    <figure class="image-box">
                        <a href="{{ asset('frontend/assets/images/resource/products/1.jpg') }}"
                            class="lightbox-image" title="Image Caption Here">
                            <img src="{{ asset('frontend/assets/images/resource/products/1.jpg') }}" alt="">
                        </a>
                    </figure>
                </div>
                <div class="info-column col-lg-6 col-md-12 col-sm-12">
                    <!-- Totals Information -->
                    <div class="card">
                        <div class="card-body text-dark">
                            <h5 class="card-title text-info">
                                {{ __('statistics.total.info') }}
                            </h5>
                            <table class="table table-bordered mt-3">
                                <tbody>
                                    <tr class="text-danger">
                                        <th>{{ __('statistics.total.price') }}</th>
                                        <td>${{ $multiService->total_price }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('field.discount.value') }}</th>
                                        <td>${{ $multiService->discount_value }}</td>
                                    </tr>
                                    <tr class="text-success">
                                        <th>{{ __('statistics.total.after_discount') }}</th>
                                        <td>${{ $multiService->getTotalAfterDiscount() }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('field.tax.rate') }}</th>
                                        <td>%{{ $multiService->tax_rate }}</td>
                                    </tr>
                                    <tr class="text-primary">
                                        <th>{{ __('statistics.total.with_tax') }}</th>
                                        <td>${{ $multiService->getTotalWithTax() }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Basic Details-->
    </div>
</div>
