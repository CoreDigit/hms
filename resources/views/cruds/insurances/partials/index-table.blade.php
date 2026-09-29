<div class="table-responsive">
    <table class="table text-md-nowrap" id="example1">
        <thead>
            <tr class="text-center">
                <th class="wd-5p">#</th>
                <th class="wd-5p"><input type="checkbox" name="select-all"></th>
                <th>{{ __('field.name') }}</th>
                <th>{{ __('field.code') }}</th>
                <th>{{ __('field.discount.percentage') }}</th>
                <th>{{ __('const.status.') }}</th>
                <th>{{ __('handle.') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($insurances as $insurance)
                <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <input type="checkbox" name="selector" value="{{ $insurance->id }}">
                    </td>

                    <td>
                        <a href="" data-toggle="modal"
                            data-target="#insurances-{{ $insurance->name ? 'show' : 'edit' }}-{{ $insurance->id }}"
                            title="{{ __('handle.show.more') }}">
                            {{ $insurance->name ?? __('general.warning.no_translation') }}
                        </a>
                    </td>
                    <td>{{ $insurance->code }}</td>

                    <td class="text-rainbow">
                        % {{ $insurance->discount_percentage }}
                    </td>

                    <td>
                        @if ($insurance->status)
                            <span class="text-center text-success">{{ __('const.status.active') }}</span>
                        @else
                            <span class="text-center text-danger">{{ __('const.status.inactive') }}</span>
                        @endif
                    </td>

                    <td>
                        <a href="" data-toggle="modal" data-target="#insurances-edit-{{ $insurance->id }}"
                            class="btn btn-sm btn-light" title="{{ __('handle.edit') }}">
                            <i class="las la-pen"></i>
                        </a>

                        <a href="" data-toggle="modal" data-target="#insurances-delete-{{ $insurance->id }}"
                            class="btn btn-sm btn-danger" title="{{ __('handle.delete.') }}">
                            <i class="ti-trash"></i>
                        </a>

                        @if ($insurance->status)
                            <a href="" data-toggle="modal"
                                data-target="#insurances-inactivate-{{ $insurance->id }}" class="btn btn-sm btn-danger"
                                title="{{ __('handle.inactivate') }}">
                                <i class="fas fa-times-circle"></i>
                            </a>
                        @else
                            <a href="" data-toggle="modal"
                                data-target="#insurances-activate-{{ $insurance->id }}" class="btn btn-sm btn-success"
                                title="{{ __('handle.activate') }}">
                                <i class="fas fa-check-circle"></i>
                            </a>
                        @endif
                    </td>
                </tr>
                @include('cruds.insurances.partials.show-modal')
                @include('cruds.insurances.partials.edit-modal')
                @include('cruds.insurances.partials.delete-modal')
                @include('cruds.insurances.partials.active-modal')
                @include('cruds.insurances.partials.inactive-modal')
            @endforeach
        </tbody>
    </table>
</div>
