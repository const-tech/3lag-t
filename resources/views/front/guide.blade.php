@extends('front.layouts.front')
@section('title')
دليل الاستخدام
@endsection
@section('content')
<section class="main-section section-guide">
    <div class="container">
        <div class="d-flex align-items-center gap-4 felx-wrap justify-content-between mb-3">
            <h4 class="main-heading mb-0">دليل الاستخدام</h4>
        </div>
        <div class="bg-white shadow p-4 rounded-3">
            <p>
                الاسئله المقاليه
            </p>
            <div class="accordion mt-3" id="accordionExample">
                @foreach ($manuals as $item)
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $item->id }}" aria-expanded="false">
                            {{ app()->getLocale() == 'en' ? ( $item->question_en ? $item->question_en : $item->question ) : $item->question }}
                        </button>
                    </h2>
                    <div id="collapse-{{ $item->id }}" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body fs-12px">
                            {!! app()->getLocale() == 'en' ? ( $item->answer_en ? $item->answer_en : $item->answer ) : $item->answer !!}
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>


    </div>
</section>
@endsection
