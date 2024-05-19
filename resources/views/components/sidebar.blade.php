<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">SIRAPAT</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">SRP</a>
        </div>
        <ul class="sidebar-menu">

            <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="nav-item">
                    <a href="{{ route('profile.index') }}" class="nav-link"><i class="fas fa-fire"></i><span>Profil</span></a>
            </li>
            @can('admin')
            <li class="nav-item">
                    <a href="{{ route('schedule.index') }}" class="nav-link"><i class="fas fa-fire"></i><span>Jadwal Rapat</span></a>
            </li>
            <li class="nav-item">
                    <a href="{{ route('user.index') }}" class="nav-link"><i class="fas fa-fire"></i><span>User</span></a>
            </li>
            <li class="nav-item">
                    <a href="{{ route('student.index') }}" class="nav-link"><i class="fas fa-fire"></i><span>Mahasiswa</span></a>
            </li>
            @endcan
    </aside>
</div>
