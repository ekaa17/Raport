<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <!-- Dashboard Nav -->
    <li class="nav-item">
      <a href="{{ url('/dashboard') }}" class="nav-link {{ Request::is('dashboard') ? '' : 'collapsed' }}">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li><!-- End Dashboard Nav -->

    @if (auth()->user()->role == 'admin')
      <!-- Siswa Nav -->
      <li class="nav-item">
        <a href="{{ url('/data-siswa') }}" class="nav-link {{ Request::is('data-siswa*') ? '' : 'collapsed' }}">
          <i class="bi bi-people-fill"></i>
          <span>Siswa</span>
        </a>
      </li><!-- End Siswa Nav -->

      <!-- Staff Nav -->
      <li class="nav-item">
        <a href="{{ url('/data-staff') }}" class="nav-link {{ Request::is('data-staff*') ? '' : 'collapsed' }}">
          <i class="bi bi-person-badge-fill"></i>
          <span>Staff</span>
        </a>
      </li><!-- End Staff Nav -->

      <!-- Informasi Data Nav -->
      <li class="nav-item">
        <a class="nav-link" data-bs-target="#info-data" data-bs-toggle="collapse" href="#">
          <i class="bi bi-bag-plus-fill"></i>
          <span>Informasi Data</span>
          <i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="info-data" class="nav-content {{ Request::is('tahun-ajaran*') || Request::is('jurusan*') || Request::is('data-kelas*') || Request::is('data-walikelas*') || Request::is('data-mapel*') ? '' : 'collapsed' }}" data-bs-parent="#sidebar-nav">
          <!-- Tahun Pelajaran Nav -->
          <li class="nav-item">
            <a href="{{ url('/tahun-ajaran') }}" class="nav-link {{ Request::is('tahun-ajaran*') ? 'active' : '' }}">
              <i class="bi bi-circle"></i>
              <span>Tahun Pelajaran</span>
            </a>
          </li><!-- End Tahun Pelajaran Nav -->

          <!-- Jurusan Nav -->
          <li class="nav-item">
            <a href="{{ url('/jurusan') }}" class="nav-link {{ Request::is('jurusan*') ? 'active' : '' }}">
              <i class="bi bi-circle"></i>
              <span>Jurusan</span>
            </a>
          </li><!-- End Jurusan Nav -->

          <!-- Kelas Nav -->
          <li class="nav-item">
            <a href="{{ url('/data-kelas') }}" class="nav-link {{ Request::is('data-kelas*') ? 'active' : '' }}">
              <i class="bi bi-circle"></i>
              <span>Kelas</span>
            </a>
          </li><!-- End Kelas Nav -->

          <!-- Wali Kelas Nav -->
          <li class="nav-item">
            <a href="{{ url('/data-walikelas') }}" class="nav-link {{ Request::is('data-walikelas*') ? 'active' : '' }}">
              <i class="bi bi-circle"></i>
              <span>Wali Kelas</span>
            </a>
          </li><!-- End Wali Kelas Nav -->

          <!-- Mata Pelajaran Nav -->
          <li class="nav-item">
            <a href="{{ url('/data-mapel') }}" class="nav-link {{ Request::is('data-mapel*') ? 'active' : '' }}">
              <i class="bi bi-circle"></i>
              <span>Mata Pelajaran</span>
            </a>
          </li><!-- End Mata Pelajaran Nav -->
        </ul>
      </li><!-- End Informasi Data Nav -->
    @endif

    <!-- Logout Nav -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="/logout">
        <i class="bi bi-box-arrow-right"></i>
        <span>Logout</span>
      </a>
    </li><!-- End Logout Nav -->

  </ul>

</aside><!-- End Sidebar -->
