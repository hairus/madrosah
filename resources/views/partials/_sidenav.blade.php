<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="{{url('/')}}" class="site_title"><i class="fa fa-paw"></i> <span>Rapot Madrasah</span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile">
            <div class="profile_pic">
                <img src="{{asset('/public/images/img.jpg')}}" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Assalamu Alaikum Admin,</span>
                <h2>{{auth()->user()->name}}</h2>
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
         <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                    <li><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Dashboard</a>
                    </li>
                    <li><a><i class="fa fa-user"></i>Admin <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ url('/admin/inputSiswa/') }}">Tambah Siswa</a></li>
                            <li><a href="{{ url('admin/absen') }}">Absen Siswa</a></li>
                            <li><a href="{{ url('admin/laporan') }}">Cetak Laporan Bulanan</a></li>
                            <li><a href="{{ url('admin/smt') }}">Aktifasi Semester</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-edit"></i>Nilai Rapor<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ url('admin/kelas') }}">Input Nilai</a></li>
                            <li><a href="{{ url('rapor/sia') }}">Input SIA</a></li>
                            <li><a href="{{ url('rapor/kep') }}">Input Kepribadian</a></li>
                            <li><a href="{{ url('rapor/cetak') }}">Cetak Rapor</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-cogs"></i>Settings <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{url('/admin/add')}}">Tambah User</a></li>
                            <li><a href="{{url('/admin/showUser')}}">List User</a></li>
                        </ul>
                    </li>
                </ul>
            </div>

        </div>
        <!-- /sidebar menu -->

        @include('partials._sidenav_footer')
    </div>
</div>