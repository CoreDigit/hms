<div class="table-responsive">
    <table class="table text-md-nowrap" id="example1">
        <thead>
            <tr class="text-center">
                <th class="wd-5p">#</th>

                @if (auth()->guard('admin')->check())
                    <th class="wd-5p"><input type="checkbox" name="select-all"></th>
                @endif

                <th>{{ __('field.name') }}</th>
                <th>{{ __('field.price') }}</th>
                @if (auth()->guard('admin')->check())
                    <th>{{ __('const.status.') }}</th>
                    <th>{{ __('handle.') }}</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($singleServices as $singleService)
                <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>

                    @if (auth()->guard('admin')->check())
                        <td>
                            <input type="checkbox" name="selector" value="{{ $singleService->id }}">
                        </td>
                    @endif

                    <td>
                        <a href="" data-toggle="modal"
                            data-target="#single-services-{{ $singleService->name ? 'show' : 'edit' }}-{{ $singleService->id }}">
                            {{ $singleService->name ?? __('general.warning.no_translation') }}
                        </a>
                    </td>

                    <td>{{ $singleService->service->price }}</td>

                    @if (auth()->guard('admin')->check())
                        <td>
                            @if ($singleService->service->status)
                                <span class="text-center text-success">{{ __('const.status.active') }}</span>
                            @else
                                <span class="text-center text-danger">{{ __('const.status.inactive') }}</span>
                            @endif
                        </td>

                        <td>
                            <a href="" data-toggle="modal"
                                data-target="#single-services-edit-{{ $singleService->id }}"
                                class="btn btn-sm btn-info" title="{{ __('handle.edit') }}">
                                <i class="las la-pen"></i>
                            </a>

                            <a href="" data-toggle="modal"
                                data-target="#single-services-delete-{{ $singleService->id }}"
                                class="btn btn-sm btn-danger" title="{{ __('handle.delete.') }}">
                                <i class="ti-trash"></i>
                            </a>

                            @if ($singleService->service->status)
                                <a href="" data-toggle="modal"
                                    data-target="#single-services-inactivate-{{ $singleService->id }}"
                                    class="btn btn-sm btn-danger" title="{{ __('handle.inactivate') }}">
                                    <i class="fas fa-times-circle"></i>
                                </a>
                            @else
                                <a href="" data-toggle="modal"
                                    data-target="#single-services-activate-{{ $singleService->id }}"
                                    class="btn btn-sm btn-success" title="{{ __('handle.activate') }}">
                                    <i class="fas fa-check-circle"></i>
                                </a>
                            @endif
                        </td>
                    @endif
                </tr>
                @include('cruds.single-services.partials.show-modal')
                @include('cruds.single-services.partials.edit-modal')
                @include('cruds.single-services.partials.active-modal')
                @include('cruds.single-services.partials.inactive-modal')
                @include('cruds.single-services.partials.delete-modal')
            @endforeach
        </tbody>
    </table>
</div>
