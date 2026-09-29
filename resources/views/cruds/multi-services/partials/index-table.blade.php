<div class="table-responsive">
    <table class="table text-md-nowrap" id="example1">
        <thead>
            <tr class="text-center">
                <th class="wd-5p">#</th>

                @if (auth()->guard('admin')->check())
                    <th class="wd-5p"><input type="checkbox" name="select-all"></th>
                @endif

                <th>{{ __('field.name') }}</th>
                <th>{{ __('statistics.total.with_tax') }}</th>

                @if (auth()->guard('admin')->check())
                    <th>{{ __('const.status.') }}</th>
                    <th>{{ __('handle.') }}</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($multiServices as $multiService)
                <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>

                    @if (auth()->guard('admin')->check())
                        <td>
                            <input type="checkbox" name="selector" value="{{ $multiService->id }}">
                        </td>
                    @endif

                    <td>
                        @if ($multiService->name)
                            <a href="" data-toggle="modal"
                                data-target="#multi-services-show-{{ $multiService->id }}">
                                {{ $multiService->name }}
                            </a>
                        @else
                            <a href="{{ route('multi-services.edit', $multiService->id) }}">
                                {{ __('general.warning.no_translation') }}
                            </a>
                        @endif
                    </td>
                    <td>{{ $multiService->service->price }}</td>

                    @if (auth()->guard('admin')->check())
                        <td>
                            @if ($multiService->service->status)
                                <span class="text-center text-success">{{ __('const.status.active') }}</span>
                            @else
                                <span class="text-center text-danger">{{ __('const.status.inactive') }}</span>
                            @endif
                        </td>

                        <td>
                            <a href="{{ route('multi-services.edit', $multiService->id) }}" class="btn btn-sm btn-info"
                                title="{{ __('handle.edit') }}">
                                <i class="las la-pen"></i></a>

                            <a href="" data-toggle="modal"
                                data-target="#multi-services-delete-{{ $multiService->id }}"
                                class="btn btn-sm btn-danger" title="{{ __('handle.delete.') }}"><i
                                    class="ti-trash"></i></a>

                            @if ($multiService->service->status)
                                <a href="" data-toggle="modal"
                                    data-target="#multi-services-inactivate-{{ $multiService->id }}"
                                    class="btn btn-sm btn-danger" title="{{ __('handle.inactivate') }}">
                                    <i class="fas fa-times-circle"></i>
                                </a>
                            @else
                                <a href="" data-toggle="modal"
                                    data-target="#multi-services-activate-{{ $multiService->id }}"
                                    class="btn btn-sm btn-success" title="{{ __('handle.activate') }}">
                                    <i class="fas fa-check-circle"></i>
                                </a>
                            @endif
                        </td>
                    @endif

                </tr>
                @include('cruds.multi-services.partials.show-modal')
                @include('cruds.multi-services.partials.active-modal')
                @include('cruds.multi-services.partials.inactive-modal')
                @include('cruds.multi-services.partials.delete-modal')
            @endforeach
        </tbody>
    </table>
</div>
