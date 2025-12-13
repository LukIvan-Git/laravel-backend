@extends('common.base')
@push('page-title')
    <title>Contact Me</title>
@section('content')
<main>              
    <section id="contact-me" class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 order-1 order-lg-0 col-lg-6">
                    <div class="image-container onebyone text-center">
                        <img src="{{ asset('images/contact-me.png') }}" alt="Contact Me" class="">
                    </div>
                </div>
                <div class="col-12 order-0 order-lg-1 col-lg-6">
                    <p>@lang('frontend.contactme')</p>
                    <form action="{{ route('contact_me') }}" method="POST" id="contactform">
                        @csrf
                        <input type="hidden" name="g-recaptcha-response" id="contact-me-recaptcha-token">
                        <div class="position-relative mb-3">
                            <label for="name" class="custom-label">
                                <i class="bi bi-person"></i>
                            </label>
                            <input type="text" class="custom-input" id="name" name="name" value="{{ old('name') }}" placeholder="@lang('frontend.name')" required/>
                        </div>
                        <div class="position-relative mb-3">
                            <label for="email" class="custom-label">
                                <i class="bi bi-envelope"></i>
                            </label>
                            <input type="email" class="custom-input" id="email" name="email" value="{{ old('email') }}" placeholder="@lang('frontend.email')" required/>
                        </div>
                        <div class="position-relative mb-3">
                            <label for="message" class="custom-label">
                                <i class="bi bi-chat"></i>
                            </label>
                            <textarea class="custom-textarea" id="message" name="message" placeholder="@lang('frontend.message')" value="{{ old('message') }}" required></textarea>
                        </div>
                        <div class="position-relative mb-3 text-center text-white">
                            <div id="btn-wrapper">
                                <label id="send-icon" class="custom-label for-btn">
                                    <i class="bi bi-send"></i>
                                </label>
                                <label  id="send-check-icon" class="custom-label for-btn">
                                    <i class="bi bi-send-check"></i>
                                </label>
                                <button id="submit-btn" type="button" class="custom-button">@lang('frontend.send_message')</button>   
                            </div>
                        </div>
                    </form>
                    @if(session('success'))
                        <div class="alert alert-success mt-2">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-danger mt-2">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
            </div>
        </div>
</main>
<script>
     $('#contactUsForm').on("submit", function(event) {
            event.preventDefault();
            var form = this;
            grecaptcha.enterprise.ready(function() {
                grecaptcha.enterprise.execute('{{ env("GOOGLE_RECAPTCHA_SITE_KEY") }}', { action: 'contactme' }).then(function(token) {
                $('#contact-me-recaptcha-token').value = token;
                form.submit();
                });
            });
    });
</script>
@endsection