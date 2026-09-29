<div class="table-responsive">
    <table class="table table-hover mb-0 text-md-nowrap">
        <tbody>
            <tr>
                <th scope="row">{{ __('field.name') }}:</th>
                <td>{{ $rayEmployee->name }}</td>
            </tr>
            <tr>
                <th scope="row">{{ __('field.email') }}:</th>
                <td>{{ $rayEmployee->email }}</td>
            </tr>
            <tr>
                <th scope="row">{{ __('const.gender.') }}:</th>
                <td>{{ $rayEmployee->gender ? __('const.gender.male') : __('const.gender.female') }}</td>
            </tr>
            <tr>
                <th scope="row">{{ __('const.status.') }}:</th>
                <td class="text-{{ $rayEmployee->status == 1 ? 'success' : 'danger' }} ml-1">
                    {{ $rayEmployee->status ? __('const.status.active') : __('const.status.inactive') }}
                </td>
            </tr>
            <tr>
                <th scope="row">{{ __('field.phone') }}:</th>
                <td>{{ $rayEmployee->phone }}</td>
            </tr>
            <tr>
                <th scope="row">{{ __('field.date.adding') }}:</th>
                <td>{{ $rayEmployee->created_at->format('Y-m-d') }} ({{ $rayEmployee->created_at->diffForHumans() }})
                </td>
            </tr>
        </tbody>
    </table>
</div>
