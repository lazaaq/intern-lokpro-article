<div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="d-flex justify-content-between">
            <div class="logo">
                <a href="/{{ user()->role }}/profile"><img src="/backend/images/logo/logo.png" alt="Logo" srcset=""></a>
            </div>
            <div class="toggler">
                <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
            </div>
        </div>
    </div>

    <ul class="menu">
        <li class="sidebar-title">Menu</li>

        <li class="sidebar-item {{ nav_on(['dashboard']) }}">
            <a href="/{{ user()->role }}/dashboard" class='sidebar-link'>
                <i class="bi bi-grid-fill"></i>
                <span>Dashboard</span>
            </a>
        </li>
        
        {{-- <li class="sidebar-item ">
            <a href="/{{ user()->role }}/profile" class='sidebar-link'>
                <i class="far fa-id-badge"></i>
                <span>Profile</span>
            </a>
        </li> --}}
        
        <li class="sidebar-item {{ nav_on(['Management']) }}">
            <a href="/{{ user()->role }}/Management" class='sidebar-link'>
                <i class="fas fa-building"></i>
                <span>Company Management</span>
            </a>
        </li>

        <li class="sidebar-item  has-sub {{ nav_on(['See_All_Job', 'Post_Job']) }}">
            <a href="#" class='sidebar-link'>
                <i class="fas fa-address-card"></i>
                <span>Job</span>
            </a>
            <ul class="submenu {{ nav_on(['See_All_Job', 'Post_Job']) }}">
                <li class="submenu-item {{ nav_on(['See_All_Job']) }}">
                    <a href="{{ route('job.index') }}">See All</a>
                </li>
                <li class="submenu-item {{ nav_on(['Post_Job']) }}">
                    <a href="{{ route('job.create') }}">Post New Job</a>
                </li>
            </ul>
        </li>

        <li class="sidebar-item">
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit" class='sidebar-link btn btn-transparent'>
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </button>
            </form>
        </li>
    </ul>
</div>
</div>
</div>