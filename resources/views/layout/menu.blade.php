<nav class="bottom-navbar">
    <div class="container">
        <ul class="nav page-navigation justify-content-center">

            <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a href="{{ url('/dashboard') }}">
                    <i class="mdi mdi-monitor-dashboard menu-icon"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('riwayat.*') ? 'active' : '' }}">
                <a href="{{ route('riwayat.index') }}">
                    <i class="mdi mdi-history menu-icon"></i>
                    <span>Riwayat</span>
                </a>
            </li>

        </ul>
    </div>
</nav>

<style>
.page-navigation{
    display:flex;
    justify-content:center;
    gap:0px;
}

/* ukuran menu */
.page-navigation .nav-item{
    width:150px;
}

/* link menu */
.page-navigation .nav-item a{
    display:flex;
    justify-content:center;
    align-items:center;
    gap:8px;
    height:60px;                /* tinggi menu */
    border-radius:10px;
    text-decoration:none;
    color:#555;
    font-size:15px;
    transition:all .2s ease;
    margin: 10px;
}

/* icon */
.page-navigation .menu-icon{
    font-size:20px;
}

/* hover */
.page-navigation .nav-item a:hover{
    background:#f5f6fa;
}

/* active */
.page-navigation .nav-item.active a{
    background:#464dee;
    color:white;
    font-weight:500;
}

/* garis bawah active */
.page-navigation .nav-item.active{
    position:relative;
}
</style>
