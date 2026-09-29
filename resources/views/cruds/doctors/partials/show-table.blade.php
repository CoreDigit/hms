<div class="table-responsive">
    <table class="table table-hover mb-0 text-md-nowrap">
        <tbody>
            <tr>
                <th scope="row">{{ __('field.name') }}:</th>
                <td>{{ $doctor->name }}</td>
            </tr>
            <tr>
                <th scope="row">{{ __('field.email') }}:</th>
                <td>{{ $doctor->email }}</td>
            </tr>
            <tr>
                <th scope="row">{{ __('const.gender.') }}:</th>
                <td>{{ $doctor->gender ? __('const.gender.male') : __('const.gender.female') }}</td>
            </tr>
            <tr>
                <th scope="row">{{ __('field.specialty') }}:</th>
                <td>{{ $doctor->specialty }}</td>
            </tr>
            <tr>
                <th scope="row">{{ __('const.status.') }}:</th>
                <td class="text-{{ $doctor->status == 1 ? 'success' : 'danger' }} ml-1">
                    {{ $doctor->status ? __('const.status.active') : __('const.status.inactive') }}
                </td>
            </tr>
            <tr>
                <th scope="row">{{ __('field.phone') }}:</th>
                <td>{{ $doctor->phone }}</td>
            </tr>
            <tr>
                <th scope="row">{{ __('cruds.department') }}:</th>
                <td>
                    {{ $doctor->department->name }}
                </td>
            </tr>
            <tr>
                <th scope="row">{{ __('field.number_of.appointments') }}:</th>
                <td>{{ $doctor->number_of_appointments }}</td>
            </tr>
            <tr>
                <th scope="row">{{ __('field.date.adding') }}:</th>
                <td>{{ $doctor->created_at->format('Y-m-d') }} ({{ $doctor->created_at->diffForHumans() }})
                </td>
            </tr>
        </tbody>
    </table>
</div>
