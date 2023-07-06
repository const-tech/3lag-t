<div class="table-responsive">
    <table class="table main-table">
        <thead>
            <tr>
                <th>{{ __('admin.Medical number') }}</th>
                <th>{{ __('admin.name') }}</th>
                <th>{{ __('admin.Civil number') }}</th>
                <th>{{ __('admin.Country') }}</th>
                <th>{{ __('admin.Gender') }}</th>
                <th>{{ __('admin.Hijri date of birth') }}</th>
                <th>{{ __('admin.Age') }}</th>
                <th>سكر</th>
                <th>ضغظ</th>
                <th>حامل</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $patient->id }}</td>
                <td>{{ $patient->name }}</td>
                <td>{{ $patient->civil }}</td>
                <td>{{ $patient->country?->name }}</td>
                <td>{{ __($patient->gender) }}</td>
                <td>{{ $patient->birthdate }}</td>
                <td>{{ $patient->age }}</td>
                <td>{{ $patient->sugar ? 'نعم' : 'لا' }}</td>
                <td>{{ $patient->pressure ? 'نعم' : 'لا' }}</td>
                <td>{{ $patient->is_pregnant ? 'نعم' : 'لا' }}</td>
            </tr>
        </tbody>
    </table>
</div>