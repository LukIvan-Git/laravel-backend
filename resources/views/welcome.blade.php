@extends('common.base')
@section('content')
<main>
    <section id="welcome-section" class="d-flex align-items-center" style="background-image: url('{{ asset('images/hero-banner.jpg') }}')">
        <div class="bg-overlay"></div>
        <div class="banner-content mx-auto px-4">
                <div class="d-grid banner-grid align-items-center">
                    <div class="text-left">
                       <h1>@lang('frontend.greetings')</h1>
                       <p>Your gateway to seamless WeChat Mini Program backend management.</p>
                       <p>get started by exploring our features and documentation.</p>
                    </h1>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection