<aside id="sidebar-wrapper">
    @if (Auth::check())
        <div class="sidebar-brand">
            <a href="/">{{ Str::upper(Auth::user()->role) }}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="/">{{ Str::upper(Auth::user()->role) }}</a>
        </div>
    @else
        <div class="sidebar-brand">
            <a href="/">User</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="/">User</a>
        </div>
    @endif
    @auth
        
        <ul class="sidebar-menu">
            <li class="{{ Route::current()->getName() == 'dashboard' ? 'active' : '' }}"><a class="nav-link"
                    href="{{ Route('dashboard') }}"><i class="fas fa-fire"></i> <span>Beranda</span></a></li>
        </ul>
        @if (Auth::user()->role == 'admin')
            <ul class="sidebar-menu">
                
                <li class="{{ Route::current()->getName() == 'user' ? 'active' : '' }}"><a class="nav-link"
                        href="{{ Route('user') }}"><i class="fas fa-user"></i> <span>Master User</span></a></li>
            </ul>
            <ul class="sidebar-menu">
                <li class="{{ Route::current()->getName() == 'setting' ? 'active' : '' }}"><a class="nav-link"
                        href="{{ Route('setting') }}"><i class="fas fa-wrench"></i> <span>Pengaturan</span></a></li>
            </ul>
            <ul class="sidebar-menu">
                <li class="{{ Route::current()->getName() == 'fasilitas' ? 'active' : '' }}"><a class="nav-link"
                        href="{{ Route('fasilitas') }}"><i class="fas fa-image"></i> <span>Data Image</span></a></li>
            </ul>
        @endif
        <ul class="sidebar-menu">
            <li class="{{ Route::current()->getName() == 'pemetaan' ? 'active' : '' }}"><a class="nav-link"
                    href="{{ Route('pemetaan') }}"><i class="fas fa-map"></i> <span>Data Pemetaan</span></a></li>
        </ul>
        
    @else
    <ul class="sidebar-menu">
        <li><a class="nav-link"
        href="{{ Route('home') }}"><i class="fas fa-fire"></i> <span>Beranda</span></a></li>
    </ul>
    @endif
    <ul class="sidebar-menu">
        <li class="{{ Route::current()->getName() == 'user.profile' ? 'active' : '' }}"><a class="nav-link"
        href="{{ Route('user.profile') }}"><i class="fas fa-user"></i> <span>Profile</span></a></li>
    </ul>
</aside>
