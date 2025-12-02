<div class="header">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <img src="{{ asset('images/mylogo1.png') }}" alt="" width="200" class="nav-logo">
            <div>
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'font-weight-bold' : '' }}">@lang('frontend.homepage')</a>
            </div>
        </div>
    </div>
</div>