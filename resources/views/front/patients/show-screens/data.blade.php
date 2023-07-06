<div class="table-responsive">
    <table class="table main-table">
        <thead>
            <tr>
                <th>{{ __('admin.Medical number') }}</th>
                <th>{{ __('admin.name') }}</th>
                <th>{{ __('admin.Civil number') }}</th>
                <th>{{ __('admin.Country') }}</th>
                <th>المجموعة</th>
                <th>{{ __('admin.Gender') }}</th>
                <th>تاريخ الميلاد ميلادي</th>
                <th>{{ __('admin.Hijri date of birth') }}</th>
                <th>{{ __('admin.Age') }}</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $patient->id }}</td>
                <td>{{ $patient->name }}</td>
                <td>{{ $patient->civil }}</td>
                <td>{{ $patient->country->name ?? null }}</td>
                <td>{{ $patient->group->name ?? null }}</td>
                <td>{{ __($patient->gender) }}</td>
                <td>{{ $patient->birthdate }}</td>
                <td>{{ $patient->birthdate? Carbon::parse($patient->birthdate)->toHijri()->isoFormat('DD-MMMM-YYYY'): '' }}
                </td>
                <td>{{ $patient->age }}</td>
            </tr>
        </tbody>
    </table>
</div>
