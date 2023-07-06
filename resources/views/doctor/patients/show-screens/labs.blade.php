<div class="table-responsive">
    <table class="table main-table">
        <tr>
            <td>#</td>
            <td>{{ __('Date')}}</td>
            <td>{{ __('service')}}</td>
        </tr>
        @forelse($labRequests as $request)
        <tr>
            <td>{{$loop->iteration}}</td>
            {{-- <td>{{__('status.'.$request->status)}}</td>
            <td>{{$request->delivered_at ?? "لم يحدد"}}</td> --}}
            <td>{{$request->created_at->format('Y-m-d')}}</td>
            <td>{{$request->service->name}}</td>
        </tr>
        @empty
        <tr>
            <td colspan="5">{{ __('There are no requests')}}</td>
        </tr>
        @endforelse
    </table>
    {{ $labRequests->links() }}
</div>
