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
                <div class="col-12 col-md-6 col-xl-3 mb-4">
                    <div class="skill-box">
                        <div class="mb-3">
                            <img class="skill-img" src="{{ asset('images/html.png') }}" alt="Skill 1">
                        </div>
                        <h5>@lang('frontend.frontend')</h5>
                        <div class="description w-100">
                            <div class="list">
                                <span>@lang('frontend.javascript')</span>
                                <div class="rate">
                                    <span class="filled">&#9733;</span>
                                    <span class="filled">&#9733;</span>
                                    <span class="filled">&#9733;</span>
                                    <span class="filled">&#9733;</span>
                                    <span class="filled">&#9733;</span>
                                </div>
                            </div>
                            <div class="list">
                                <span>@lang('frontend.css')</span>
                                <div class="rate">
                                    <span class="filled">&#9733;</span>
                                    <span class="filled">&#9733;</span>
                                    <span class="filled">&#9733;</span>
                                    <span class="filled">&#9733;</span>
                                    <span class="">&#9733;</span>
                                </div>
                            </div>
                            <div class="list">
                                <span>@lang('frontend.bootstrap')</span>
                                <div class="rate">
                                    <span class="filled">&#9733;</span>
                                    <span class="filled">&#9733;</span>
                                    <span class="filled">&#9733;</span>
                                    <span class="filled">&#9733;</span>
                                    <span class="filled">&#9733;</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-3 mb-4">
                    <div class="skill-box">
                        <div class="mb-3">
                            <img class="skill-img" src="{{ asset('images/vue.jpg') }}" alt="Skill 2">
                        </div>
                        <h5>@lang('frontend.vuejs')</h5>
                        <div class="description w-100">
                            <div class="list">
                                <span>Vue 2</span>
                                <div class="rate">
                                    <span class="filled">&#9733;</span>
                                    <span class="filled">&#9733;</span>
                                    <span class="filled">&#9733;</span>
                                    <span class="filled">&#9733;</span>
                                    <span class="filled">&#9733;</span>
                                </div>
                            </div>
                            <div class="list">
                                <span>Vue 3</span>
                                <div class="rate">
                                    <span class="filled">&#9733;</span>
                                    <span class="filled">&#9733;</span>
                                    <span class="filled">&#9733;</span>
                                    <span class="">&#9733;</span>
                                    <span class="">&#9733;</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-3 mb-4">
                    <div class="skill-box">
                        <div class="mb-3">
                            <img class="skill-img" src="{{ asset('images/laravel.png') }}" alt="Skill 3">
                        </div>
                        <h5>@lang('frontend.laravel')</h5>
                        <div class="description w-100">
                        <div class="list">
                                <span>@lang('frontend.eloquent_orm')</span>
                                <div class="rate">
                                    <span class="filled">&#9733;</span>
                                    <span class="filled">&#9733;</span>
                                    <span class="filled">&#9733;</span>
                                    <span class="">&#9733;</span>
                                    <span class="">&#9733;</span>
                                </div>
                        </div>
                        <div class="list">
                                <span>@lang('frontend.database_management')</span>
                                <div class="rate">
                                    <span class="filled">&#9733;</span>
                                    <span class="filled">&#9733;</span>
                                    <span class="filled">&#9733;</span>
                                    <span class="filled">&#9733;</span>
                                    <span class="">&#9733;</span>
                                </div>
                        </div>
                        <div class="list">
                                <span>@lang('frontend.cms')</span>
                                <div class="rate">
                                    <span class="filled">&#9733;</span>
                                    <span class="filled">&#9733;</span>
                                    <span class="filled">&#9733;</span>
                                    <span class="filled">&#9733;</span>
                                    <span class="">&#9733;</span>
                                </div>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-3 mb-4">
                    <div class="skill-box">
                        <div class="mb-3">
                            <img class="skill-img" src="{{ asset('images/api.png') }}" alt="Skill 4">
                        </div>
                        <h5>@lang('frontend.api')</h5>
                        <div class="description w-100">
                        <div class="list">
                                <span>@lang('frontend.payment_gateway')</span>
                                <div class="rate">
                                    <span class="filled">&#9733;</span>
                                    <span class="filled">&#9733;</span>
                                    <span class="filled">&#9733;</span>
                                    <span class="filled">&#9733;</span>
                                    <span class="">&#9733;</span>
                                </div>
                        </div>
                        <div class="list">
                                <span>@lang('frontend.smtp')</span>
                                <div class="rate">
                                    <span class="filled">&#9733;</span>
                                    <span class="filled">&#9733;</span>
                                    <span class="filled">&#9733;</span>
                                    <span class="filled">&#9733;</span>
                                    <span class="">&#9733;</span>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</main>

@endsection