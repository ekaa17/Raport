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
        <ul id="info-data" class="nav-content {{ Request::is('tahun-ajaran*') || Request::is('jurusan*') || Request::is('data-kelas*') || Request::is('data-walikelas*') || Request::is('data-mapel*') ? '' : 'collapse' }}" data-bs-parent="#sidebar-nav">
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

          <!-- Mata Pelajaran Nav -->
          <li class="nav-item">
            <a href="{{ url('/data-mapel') }}" class="nav-link {{ Request::is('data-mapel*') ? 'active' : '' }}">
              <i class="bi bi-circle"></i>
              <span>Mata Pelajaran</span>
            </a>
          </li><!-- End Mata Pelajaran Nav -->

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
        </ul>
      </li><!-- End Informasi Data Nav -->
    @endif

    @php
      use Illuminate\Support\Facades\DB;
      $kelas = DB::table('detail_mapel_kelas')
          ->join('data_kelas', 'detail_mapel_kelas.kelas_id', '=', 'data_kelas.id')
          ->join('data_mapels', 'detail_mapel_kelas.mapel_id', '=', 'data_mapels.id')
          ->select('detail_mapel_kelas.id', 'data_kelas.kelas', 'data_kelas.nama_kelas',  'data_mapels.nama_mapel')
          ->where('detail_mapel_kelas.pengajar_id', auth()->user()->id)
          ->get();
    @endphp
    @if (auth()->user()->role == 'guru')
      @if(DB::table('detail_mapel_kelas')->where('pengajar_id' , auth()->user()->id)->exists())
        <!-- Penilaian Nav -->
        <li class="nav-item">
          <a class="nav-link" data-bs-target="#info-data" data-bs-toggle="collapse" href="#">
            <i class="bi bi-bag-plus-fill"></i>
            <span> Penilaian</span>
            <i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="info-data" class="nav-content" data-bs-parent="#sidebar-nav">
            <!-- Kelas Nav -->
            @foreach ($kelas as $item)
            <li class="nav-item">
                <a href="{{ route('data-nilai.show', $item->id) }}" class="nav-link {{ Request::routeIs('data-nilai.show') && Request::segment(2) == $item->id ? 'active' : '' }}">
                    <i class="bi bi-circle"></i>
                    <span>{{ $item->kelas }} {{ $item->nama_kelas }} | {{ $item->nama_mapel }}</span>
                </a>
            </li>
            @endforeach          
          </ul>
        </li><!-- End Penilaian Nav -->
      @endif
    @endif

    @php
      use App\Models\data_wali_kelas;
      $waliKelas = data_wali_kelas::where('id_staff', auth()->user()->id)->exists();
    @endphp

    @if (auth()->user()->role == 'guru' && $waliKelas)
        <!-- Raport Nav -->
        <li class="nav-item">
          <a href="/data-raport/{{ auth()->user()->waliKelas->kelas->first()->id }}" class="nav-link {{ Request::is('data-raport*') ? '' : 'collapsed' }}">
            <i class="bi bi-book"></i>
            <span>Raport {{ auth()->user()->waliKelas->kelas->first()->kelas }} {{ auth()->user()->waliKelas->kelas->first()->nama_kelas }}</span>
          </a>
        </li><!-- End Raport Nav -->
    @endif

    @if (auth()->user()->role == 'kepala sekolah')
        <!-- Raport Nav -->
        <li class="nav-item">
          <a href="/data-raport" class="nav-link {{ Request::is('data-raport') || Request::is('nilai-raport*') ? '' : 'collapsed' }}">
            <i class="bi bi-book"></i>
            <span>Raport</span>
          </a>
        </li><!-- End Raport Nav -->
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
