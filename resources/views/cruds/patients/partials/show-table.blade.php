<div class="table-responsive">
    <table class="table table-hover mb-0 text-md-nowrap">
        <tbody>
            <tr>
                <th scope="row">{{ __('field.name') }}:</th>
                <td>{{ $patient->name }}</td>
            </tr>
            <tr>
                <th scope="row">{{ __('field.email') }}:</th>
                <td>{{ $patient->email }}</td>
            </tr>
            <tr>
                <th scope="row">{{ __('const.gender.') }}:</th>
                <td>{{ $patient->gender ? __('const.gender.male') : __('const.gender.female') }}</td>
            </tr>
            <tr>
                <th scope="row">{{ __('field.phone') }}:</th>
                <td>{{ $patient->phone }}</td>
            </tr>
            <tr>
                <th scope="row">{{ __('field.birth_date') }}:</th>
                <td>
                    <a href="">{{ $patient->birth_date }}</a>
                </td>
            </tr>
            <tr>
                <th scope="row">{{ __('field.blood_type') }}:</th>
                <td>{{ $patient->blood_type }}</td>
            </tr>
            <tr>
                <th scope="row">{{ __('field.date.adding') }}:</th>
                <td>{{ $patient->created_at->format('Y-m-d') }} ({{ $patient->created_at->diffForHumans() }})
                </td>
            </tr>
        </tbody>
    </table>
</div>
