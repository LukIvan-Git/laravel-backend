<div class="header re-hide">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <img src="{{ asset('images/mylogo1.png') }}" alt="" width="200" class="nav-logo">
            <div class="nav-links">
                @foreach($menus as $menu)
                    <a href="{{ route($menu['route']) }}" class="{{ request()->routeIs($menu['route']) ? 'active' : '' }}">{{ $menu['title'] }}</a>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="re-header re-show">
    <div class="container h-100">
        <div class="position-relative h-100">
            <div class="d-flex justify-content-center align-items-center w-100 h-100">
                <img src="{{ asset('images/mylogo1.png') }}" alt="" width="150" class="nav-logo">
            </div>
            <div id="nav-toggle" class="">
                <img class="" src={{ asset('images/list.svg') }}></img>
            </div>
        </div>
    </div>
</div>
<div class="re-menu">
    <div class="re-nav-links">
        <ul class="custom-list">
            @foreach($menus as $menu)
                <li><a href="{{ route($menu['route']) }}">{{ $menu['title'] }}</a></li>
            @endforeach
        </ul>
        <div class="icon-list text-center py-3">
            <a href="#"><i class="bi bi-facebook"></i></a>
            <a href="#"><i class="bi bi-twitter"></i></a>
            <a href="#"><i class="bi bi-instagram"></i></a>
            <a href="#"><i class="bi bi-linkedin"></i></a>
        </div>
    </div>
</div>