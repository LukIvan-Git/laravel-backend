<div class="header">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <img src="{{ asset('images/mylogo1.png') }}" alt="" width="200" class="nav-logo">
            <div class="nav-links">
                @foreach($menus as $menu)
                    <a href="{{ route($menu['route']) }}" class="{{ request()->routeIs($menu['route']) ? 'active' : '' }}">{{ $menu['title'] }}</a>
                @endforeach

                {{-- <a href="{{ route('homepage') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">@lang('frontend.homepage')</a>
                <a href="{{ route('my_careers') }}" class="{{ request()->routeIs('my_careers') ? 'active' : '' }}">@lang('frontend.my_career')</a>
                <a href="{{ route('contact_me') }}" class="{{ request()->routeIs('contact_me') ? 'active' : '' }}">@lang('frontend.contact_me')</a> --}}

            </div>
        </div>
    </div>
</div>