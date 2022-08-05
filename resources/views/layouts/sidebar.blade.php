<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src={{asset("AdminLTE/dist/img/AdminLTELogo.png")}} alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Sistem Penilaian Siswa</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src={{asset("AdminLTE/dist/img/user2-160x160.jpg")}} class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::user()->name}}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          {{-- <li class="nav-header">EXAMPLES</li> --}}
          @if (Auth::user()->role_id == 1)
            <li class="nav-item">
                <a href="{{route('admin/penilaian')}}" class="nav-link">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                    Penilaian
                </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                <i class="nav-icon far fa-envelope"></i>
                <p>
                    Manajemen
                    <i class="fas fa-angle-left right"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('admin/student')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Siswa</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/mailbox/compose.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Compose</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/mailbox/read-mail.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Read</p>
                    </a>
                </li>
                </ul>
            </li>
          @else
          <li class="nav-item">
            <a href="{{route('student/LihatNilai')}}" class="nav-link">
            <i class="nav-icon fas fa-file"></i>
            <p>
                Lihat Nilai
            </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('admin/penilaian')}}" class="nav-link">
            <i class="nav-icon fas fa-user"></i>
            <p>
                Profil
            </p>
            </a>
        </li>
          @endif
          <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link" 
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>
                Logout
            </p>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>