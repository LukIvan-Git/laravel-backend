@extends('common.base')
@section('content')
<main>
    <section id="welcome-section" class="d-flex align-items-center" style="background-image: url('{{ asset('images/hero-banner.jpg') }}')">
        <div class="bg-overlay"></div>
        <div class="banner-content mx-auto px-4">
                <div class="d-grid banner-grid align-items-center">
                    <div class="text-left">
                       <span style="color:#4da6ff"><h1>@lang('frontend.greetings')</h1></span>
                        <p>{!! $page->translated_data['content'] !!}
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <section id="skills-section" class="py-5">
        <div class="container text-center">
            <div class="d-inline-block heading my-2">@lang('frontend.skills_heading')</div>
            <div class="description mb-2 mb-lg-4">@lang('frontend.skills_description')</div>
            <div class="row">
                @foreach ($tech_items as $ti)
                    <div class="col-12 col-md-6 col-xl-3 mb-4">
                    <div class="skill-box">
                        <div class="mb-3">
                            <img class="skill-img" src="{{ asset('images/' . $ti->icon_path) }}" alt="Skill 1">
                        </div>
                        <h5>{{ $ti->name }}</h5>
                        <div class="description w-100">
                            @foreach ($ti['details'] as $ds)
                                <div class="list">
                                <span>{{ $ds['name'] }}</span>
                                <div class="rate">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $ds['proficiency'])
                                                <span class="filled">&#9733;</span>
                                            @else
                                                <span class="empty">&#9733;</span>
                                            @endif
                                        @endfor
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </section>
</main>

@endsection