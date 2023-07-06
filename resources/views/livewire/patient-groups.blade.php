<section class="main-section users">
    <x-alert></x-alert>
    @include('front.patient_groups.add_or_update')
    <div class="container">
        <h4 class="main-heading">مجموعات المرضى</h4>
        <div class="section-content bg-white shadow rounded-3 p-4">
            <div class="d-flex align-items-center flex-wrap justify-content-end mb-2">
                <button class="btn-main-sm" data-bs-toggle="modal" data-bs-target="#add_or_update">
                    {{ __('admin.Add') }}
                    <i class="icon fa-solid fa-plus me-1"></i>
                </button>
            </div>
            <div class="table-responsive">
                <table class="table main-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('admin.name') }}</th>
                            <th>{{ __('admin.rate') }}</th>
                            <th>{{ __('admin.count') }}</th>
                            <th class="text-center">{{ __('admin.managers') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($patient_groups as $patient_group)
                            <tr>
                                <td>{{ $patient_group->id }}</td>
                                <td>{{ $patient_group->name }}</td>
                                <td>{{ $patient_group->rate }} %</td>
                                <td>{{ $patient_group->patients->count() }}</td>
                                <td>
                                    <div class="d-flex align-items-center justify-content-center gap-1">
                                        <button data-bs-toggle="modal" data-bs-target="#add_or_update"
                                            class="btn btn-sm btn-info text-white ms-1"
                                            wire:click='edit({{ $patient_group }})'>
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>

                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#delete_agent{{ $patient_group->id }}">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @include('front.patient_groups.delete')
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        <!-- All Modal -->
        <!-- Modal repeat -->

    </div>
</section>
