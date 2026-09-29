<div class="table-responsive">
    <table class="table table-hover mb-0 text-md-nowrap">
        <tbody>
            <tr>
                <th scope="row">{{ __('field.name') }}:</th>
                <td>{{ $ambulanceDriver->name }}</td>
            </tr>
            <tr>
                <th scope="row">{{ __('const.gender.') }}:</th>
                <td>{{ $ambulanceDriver->gender ? __('const.gender.male') : __('const.gender.female')}}</td>
            </tr>
            <tr>
                <th scope="row">{{ __('const.status.') }}:</th>
                <td class="text-{{ $ambulanceDriver->status == 1 ? 'success' : 'danger' }} ml-1">
                    {{ $ambulanceDriver->status ? __('const.status.active') : __('const.status.inactive') }}
                </td>
            </tr>
            <tr>
                <th scope="row">{{ __('field.phone') }}:</th>
                <td>{{ $ambulanceDriver->phone }}</td>
            </tr>
            <tr>
                <th scope="row">{{ __('field.license_number') }}:</th>
                <td>{{ $ambulanceDriver->license_number }}</td>
            </tr>
            <tr>
                <th scope="row">{{ __('field.address') }}:</th>
                <td>{{ $ambulanceDriver->address }}</td>
            </tr>
            <tr>
                <th scope="row">{{ __('field.date.adding') }}:</th>
                <td>{{ $ambulanceDriver->created_at->format('Y-m-d') }} ({{ $ambulanceDriver->created_at->diffForHumans() }})
                </td>
            </tr>
        </tbody>
    </table>
</div>
