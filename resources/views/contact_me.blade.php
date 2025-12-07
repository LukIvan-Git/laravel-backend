@extends('common.base')
@section('content')
<main>              
    <section id="contact-me" class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 order-1 order-lg-0 col-lg-6">
                    <div class="image-container 1/1">
                        <img src="{{ asset('images/contact-me.png') }}" alt="Contact Me" class="">
                    </div>
                </div>
                <div class="col-12 order-0 order-lg-1 col-lg-6">
                    <p>@lang('frontend.contactme')</p>
                    <form action="" method="POST" id="contactform">
                        @csrf
                        <div class="position-relative mb-3">
                            <label for="name" class="custom-label">
                                <i class="bi bi-person"></i>
                            </label>
                            <input type="text" class="custom-input" id="name" name="name" placeholder="@lang('frontend.name')" required/>
                        </div>
                        <div class="position-relative mb-3">
                            <label for="email" class="custom-label">
                                <i class="bi bi-envelope"></i>
                            </label>
                            <input type="email" class="custom-input" id="email" name="email" placeholder="@lang('frontend.email')" required/>
                        </div>
                        <div class="position-relative mb-3">
                            <label for="message" class="custom-label">
                                <i class="bi bi-chat"></i>
                            </label>
                            <textarea class="custom-textarea" id="message" name="message" placeholder="@lang('frontend.message')" required></textarea>
                        </div>
                        <div class="position-relative mb-3 text-center text-white">
                            <label class="custom-label for-btn">
                                <i class="bi bi-send"></i>
                            </label>
                            <button type="submit" class="custom-button">@lang('frontend.send_message')</button>   
                        </div>
                        
                    </form>
            </div>
        </div>
</main>
@endsection