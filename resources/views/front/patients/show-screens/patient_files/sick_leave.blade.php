<button class="btn-main-sm mb-2 " data-bs-toggle="modal" data-bs-target="#add_file">
    {{ __('admin.Add file') }}
    <i class="fa fa-plus icon"></i>
</button>
<div class="table-responsive">
    <table class="table main-table">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('admin.name') }}</th>
                <th>{{ __('admin.Hour') }}</th>
                <th>{{ __('admin.Date') }}</th>
                <th>{{ __('admin.Uploaded by') }}</th>
                <th>{{ __('admin.file') }}</th>
                <th>{{ __('admin.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($patient->sick_leave_files()->paginate(10) as $file)
                <tr>
                    <td>{{ $file->id }}</td>
                    <td>{{ $file->file_name }}</td>
                    <td>{{ $file->created_at->format('Y-m-d') }}</td>
                    <td>{{ $file->created_at->toTimeString() }}</td>
                    <td>{{ $file->employee->name }}</td>
                    <td>
                        <a href="{{ display_file($file->file_path) }}" download="" class="btn btn-purple btn-sm">
                            <i class="fa fa-eye"></i>
                        </a>
                    </td>
                    <td>
                        <a href="" class="btn btn-sm btn-danger text-white" data-bs-toggle="modal"
                            data-bs-target="#delete_agent{{ $file->id }}">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
                <!-- All Modal -->
                <!-- Modal Show File -->
                <div class="modal fade modal-img" id="show-file" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body p-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                                <img class="w-100 h-auto" src="{{ display_file($file->file_path) }}" alt="">
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Modal Add File -->
                <div class="modal fade" id="delete_agent{{ $file->id }}" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>


                            <div class="modal-body">
                                {{ __('admin.are sure of the deleting process?') }}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-primary"
                                    data-bs-dismiss="modal">{{ __('admin.No') }}</button>
                                <button class="btn btn-sm  btn-danger" data-bs-dismiss="modal"
                                    wire:click='delete_file({{ $file }})'>{{ __('admin.Yes') }}</button>
                            </div>

                        </div>

                    </div>
                </div>
            @endforeach

        </tbody>
    </table>
    {{ $patient->sick_leave_files()->paginate(10)->links() }}
</div>

{{-- Modal --}}
<div class="modal fade" id="add_file" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div> -->
            <div class="modal-body">
                <div class="row row-gap-24">
                    <div class="col-12">
                        <label for="">{{ __('admin.name') }}</label>
                        <input class="form-control" type="text" wire:model.defer="file_name" id="">
                    </div>
                    <div class="col-12">
                        <label for="">{{ __('admin.file') }}</label>
                        <input class="form-control" type="file" wire:model.defer="file" id="">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-danger"
                    data-bs-dismiss="modal">{{ __('admin.No') }}</button>
                <button class="btn btn-sm   btn-primary" data-bs-dismiss="modal"
                    wire:click='save_file'>{{ __('admin.Yes') }}</button>
            </div>

        </div>

    </div>
</div>
