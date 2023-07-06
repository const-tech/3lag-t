<section class="main-section users">
    <!-- @if ($errors->any())
    @foreach ($errors->all() as $error)
    <div class="alert alert-warning">{{$error}}</div>
    @endforeach
    @endif -->
    <x-alert></x-alert>
    @include('front.categories.add_or_update')
    <div class="container">
        <h4 class="main-heading">{{ __('admin.categories') }}</h4>
        <div class="section-content bg-white p-4 shadow rounded-3">
            <div class="d-flex align-items-center flex-wrap gap-1 mt-3 justify-content-between mb-2">
            <a href="{{ route('front.expenses.index') }}" class="btn btn-sm btn-primary" >
            {{ __('admin.Expenses') }}
                </a>
                <button   class="btn-main-sm" data-bs-toggle="modal"
                data-bs-target="#add_or_update" >
                    {{ __('admin.Add category') }}
                    <i class="icon fa-solid fa-plus me-1"></i>
                </button>
            </div>
            <div class="table-responsive">
                <table class="table main-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('admin.name') }}</th>
                            <th>{{ __('admin.sub of') }}</th>
                            <th class="text-center">{{ __('admin.managers') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->main?->name }}</td>
                            <td>
                                <div class="d-flex align-items-center justify-content-center gap-1">
                                    <button data-bs-toggle="modal"
                                    data-bs-target="#add_or_update"  class="btn btn-sm btn-info text-white" wire:click='edit({{ $category }})'>
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger"  data-bs-toggle="modal"
                                    data-bs-target="#delete_agent{{ $category->id }}">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @include('front.categories.delete')
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        <!-- All Modal -->
        <!-- Modal repeat -->

    </div>
</section>
