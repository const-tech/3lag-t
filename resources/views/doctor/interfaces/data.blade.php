<section class="table-responsive">
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
                <th>{{ __('admin.actions') }}</th>
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
                <td>
                    <a target="_blank" href="{{ route('doctor.patients.show', $patient) }}"
                        class="btn btn-sm btn-purple py-2">
                        <i class="fa fa-eye"></i>
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
</section>
