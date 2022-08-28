<header class="main-nav">
    <div class="sidebar-user text-center">
        <a class="setting-primary" href="javascript:void(0)">
            <i data-feather="settings"></i>
        </a>
        <img class="img-90 rounded-circle" src="/assets/images/dashboard/1.png" alt="" />
        {{-- <div class="badge-bottom"><span class="badge badge-primary">Admin TU</span></div> --}}
        <a href="javascript:void(0)"> <h6 class="mt-3 f-14 f-w-600">{{ auth()->user()->nama_user }}</h6></a>
        <p class="mb-0 font-roboto">{{ auth()->user()->level->level }}</p>
    </div>
    <nav>
        <div class="main-navbar">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="mainnav">
                <ul class="nav-menu custom-scrollbar">
                    <li class="back-btn">
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>General</h6>
                        </div>
                    </li>
                    @php
                        $level = 'admin';
                        if(auth()->user()->level->slug == 'guru'){
                            $level = 'guru';
                        }
                    @endphp
                    <li class="dropdown mb-1">
                        <a class="nav-link menu-title link-nav {{ Request::is($level.'/dashboard') ? 'active' : '' }}" href="/{{ $level }}/dashboard"><i data-feather="home"></i><span>Dashboard</span></a>
                    </li>

                    @admin
                    <li class="dropdown mb-1">
                        <a class="nav-link menu-title {{ Request::is($level.'/kriteria*') ? 'active' : '' }}" href="javascript:void(0)"><i data-feather="server"></i><span>Aspek Penilaian </span></a>
                        <ul class="nav-submenu menu-content" style="display: none;">
                            <li><a href="/{{$level}}/kriteria/penilaian" class="">Kriteria Penilaian</a></li>
                            <li><a href="/{{$level}}/kriteria/bobot" class="">Bobot Penilaian</a></li>
                        </ul>
                    </li>

                    <li class="dropdown mb-1">
                        <a class="nav-link menu-title link-nav {{ Request::is($level.'/tahun-ajar*') ? 'active' : '' }}" href="/{{$level}}/tahun-ajar"><i data-feather="calendar"></i><span>Tahun Ajar</span></a>
                    </li>

                    <li class="dropdown mb-1">
                        <a class="nav-link menu-title link-nav {{ Request::is($level.'/kelas*') ? 'active' : '' }}" href="/{{$level}}/kelas"><i data-feather="list"></i><span>Kelas</span></a>
                    </li>

                    <li class="dropdown mb-1">
                        <a class="nav-link menu-title link-nav {{ Request::is($level.'/user*') ? 'active' : '' }}" href="/{{$level}}/user"><i data-feather="user"></i><span>User Account</span></a>
                    </li>

                    @endadmin

                    <li class="dropdown mb-1">
                        <a class="nav-link menu-title link-nav {{ Request::is($level.'/siswa*') ? 'active' : '' }}" href="/{{$level}}/siswa"><i data-feather="users"></i><span>Siswa</span></a>
                    </li>

                    <li class="dropdown mb-1">
                        <a class="nav-link menu-title {{ Request::is($level.'/penilaian*') ? 'active' : '' }} " href="javascript:void(0)"><i data-feather="airplay"></i><span>Penilaian</span></a>
                        <ul class="nav-submenu menu-content"  style="display: none;">
                            <li><a href="/{{$level}}/penilaian/kelas" class="">Kelas Siswa</a></li>
                            <li><a href="/{{$level}}/penilaian/siswa" class="">Penilaian Siswa</a></li>
                        </ul>
                    </li>

                    {{-- <li class="sidebar-main-title">
                        <div>
                            <h6>Report</h6>
                        </div>
                    </li>
                    <li class="dropdown mb-1">
                        <a class="nav-link menu-title " href="javascript:void(0)"><i data-feather="hard-drive"></i><span>Laporan Kesiswaan</span></a>
                        <ul class="nav-submenu menu-content" style="display: none;">
                            <li><a href="ex-data-tables/datatable-ext-autofill.html" class="">Laporan Siswa Berprestasi</a></li>
                            <li><a href="ex-data-tables/datatable-ext-basic-button.html" class="">Laporan Siswa Berprestasi perKelas</a></li>
                            <li><a href="ex-data-tables/datatable-ext-basic-button.html" class="">Laporan Siswa Kelas</a></li>
                            <li><a href="ex-data-tables/datatable-ext-col-reorder.html" class="">Laporan Guru Aktif</a></li>
                        </ul>
                    </li> --}}
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
</header>
