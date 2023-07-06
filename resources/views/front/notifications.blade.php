@extends('front.layouts.front')
@section('title')
{{ __('admin.Notifications') }}
@endsection
@section('content')
<section class="main-section notice">
  @php($notifications=App\Models\Notification::latest()->paginate(10))
  <div class="container">
      <h4 class="main-heading">{{ __('admin.Notifications') }}</h4>
      <div class="bg-white p-3 rounded-2 shadow">
          @foreach($notifications as $notification)
          {{ $notification->markAsSeen() }}
          <div class="p-3 border-bottom">
            <a href="{{ $notification->link }}">
              @if (Carbon::now()->diffInMinutes(Carbon::parse($notification->seen_at)) < 1) <span class="text-danger new">
                جديد </span>
                @endif
              <span class="text-main-color"> {{ $notification->title }}:</span>
              {{ $notification->body }}
              
            </a>
          </div>
          @endforeach
      </div>
  </div>
</section>

@endsection