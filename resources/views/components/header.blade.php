<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <ul class="navbar-nav mr-auto">
        <li><a href="#"
                data-toggle="sidebar"
                class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
    </ul>
    <div class="ml-auto">
        <li class="dropdown"><a href="#"
                data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                @if($foto_profil)
                    <img src="{{ URL::asset('storage/'.$foto_profil) }}" alt="Foto Profil" class="rounded-circle">
                @else
                    <img src="{{ asset('img/avatar/avatar-5.png') }}"class="rounded-circle">
                @endif
                    <div class="d-sm-none d-lg-inline-block">{{ auth()->user()->name }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                @can('user')
                <a href="{{ route('profile.index') }}"
                    class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Profile
                </a>
                @endcan
                {{--<a href="features-activities.html"
                    class="dropdown-item has-icon">
                    <i class="fas fa-bolt"></i> Activities
                </a>
                <a href="features-settings.html"
                    class="dropdown-item has-icon">
                    <i class="fas fa-cog"></i> Settings
                </a>--}}

                <a href="#" class="dropdown-item has-icon text-danger"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit()">

                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="post">
                    @csrf
                </form>
            </div>
        </li>
    </div>
</nav>
