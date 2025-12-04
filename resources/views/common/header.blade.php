<div class="header">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <img src="{{ asset('images/mylogo1.png') }}" alt="" width="200" class="nav-logo">
            <div class="nav-links">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">@lang('frontend.homepage')</a>
                <a href="{{ route('my_career') }}" class="{{ request()->routeIs('my_career') ? 'active' : '' }}">@lang('frontend.my_career')</a>
                <a href="{{ route('contact_me') }}" class="{{ request()->routeIs('contact_me') ? 'active' : '' }}">@lang('frontend.contact_me')</a>

            </div>
        </div>
    </div>
</div>