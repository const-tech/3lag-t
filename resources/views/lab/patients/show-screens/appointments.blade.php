    <div class="table-responsive">
        <table class="table main-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('admin.Period') }}</th>
                    <th>{{ __('admin.Day') }}</th>
                    <th>{{ __('admin.Hour') }}</th>
                    <th>{{ __('admin.Clinic') }}</th>
                    <th>{{ __('admin.dr') }}</th>
                    <th>{{ __('admin.Attendance status') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($appoints as $appointment)
                <tr>
                    <td>{{ $appointment->id }}</td>
                    <td>{{ __(Carbon::parse($appointment->appointment_time)->format('a') )}}</td>
                    <td>{{ $appointment->appointment_date }}</td>
                    <td>{{ $appointment->appointment_time }}</td>
                    <td>{{ $appointment->clinic->name }}</td>
                    <td>{{ $appointment->doctor->name }}</td>
                    <td>{{ __($appointment->appointment_status) }}</td>

                </tr>
                @endforeach

            </tbody>
        </table>
        {{ $appoints->links() }}
    </div>
    