  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a href="{{ url('/dashboard') }}" class="nav-link {{ Request::is('dashboard') ? '' : 'collapsed' }}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      @if (auth()->user()->role == 'admin')
        <li class="nav-item">
          <a href="{{ url('/data-siswa') }}" class="nav-link {{ Request::is('data-siswa') || Request::is('data-siswa/create') || Request::is('data-siswa/*') || Request::is('data-siswa/*/edit') ? '' : 'collapsed' }}">
              <i class="bi bi-people-fill"></i>
              <span>Siswa</span>
          </a>
        </li><!-- End Siswa Nav -->

        <li class="nav-item">
          <a href="{{ url('/data-staff') }}" class="nav-link {{ Request::is('data-staff') || Request::is('data-staff/create') || Request::is('data-staff/*') || Request::is('data-staff/*/edit') ? '' : 'collapsed' }}">
              <i class="bi bi-person-badge-fill"></i>
              <span>Staff</span>
          </a>
        </li><!-- End Staff Nav -->

        <li class="nav-item">
          <a href="{{ url('/data-kelas') }}" class="nav-link {{ Request::is('data-kelas') || Request::is('data-kelas/create') || Request::is('data-kelas/*') || Request::is('data-kelas/*/edit') ? '' : 'collapsed' }}">
              <i class="bi bi-door-open"></i>
              <span>Kelas</span>
          </a>
        </li><!-- End Kelas Nav -->

        <li class="nav-item">
          <a href="{{ url('/data-walikelas') }}" class="nav-link {{ Request::is('data-walikelas') || Request::is('data-walikelas/create') || Request::is('data-walikelas/*') || Request::is('data-walikelas/*/edit') ? '' : 'collapsed' }}">
              <i class="bi bi-person-bounding-box"></i>
              <span>Wali Kelas</span>
          </a>
        </li><!-- End Wali Kelas Nav -->

        <li class="nav-item">
          <a href="{{ url('/data-mapel') }}" class="nav-link {{ Request::is('data-mapel') || Request::is('data-mapel/create') || Request::is('data-mapel/*') || Request::is('data-mapel/*/edit') ? '' : 'collapsed' }}">
              <i class="bi bi-book"></i>
              <span>Mata Pelajaran</span>
          </a>
        </li><!-- End Mata Pelajaran Nav -->
      @else
        
      @endif


      <li class="nav-item">
        <a class="nav-link collapsed" href="/logout">
            <i class="bi bi-box-arrow-right"></i>
            <span>Logout</span>
        </a>
      </li><!-- End Logout Nav -->

    </ul>

  </aside><!-- End Sidebar-->