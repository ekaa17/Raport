@extends('layouts.main')

@section('content')
    <div class="pagetitle">
        <h1>{{ $title }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item">{{ $title }}</li>
                <li class="breadcrumb-item active">{{ $data_nilai->kelas->kelas }} {{ $data_nilai->kelas->nama_kelas }}</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-xl-12">
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-1"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif (session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-octagon me-1"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>

            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body pt-3">
                        <div class="d-flex align-items-center justify-content-between m-3">
                            <h5 class="card-title">Kelas : {{ $data_nilai->kelas->kelas }} {{ $data_nilai->kelas->nama_kelas }}</h5>
                            <h5 class="card-title">Total : {{ $data_nilai->kelas->siswas->count() }} Siswa</h5>
                        </div>

                        <div class="table-responsive">
                            <table class="table datatable table-bordered" id="pegawai">
                                <thead>
                                    <tr>
                                        <th rowspan="2">No.</th>
                                        <th rowspan="2">Nomor Induk</th>
                                        <th rowspan="2">Nama</th>
                                        @foreach ($data_nilai->kelas->detail_mapel_kelas as $mapel)
                                            <th colspan="4" class="text-center">{{ $mapel->mapel->nama_mapel }}</th>
                                        @endforeach
                                        {{-- <th rowspan="2" colspan="2"></th> --}}
                                    </tr>
                                    <tr>
                                        @foreach ($data_nilai->kelas->detail_mapel_kelas as $mapel)
                                            <th>Nilai Harian</th>
                                            <th>UTS</th>
                                            <th>UAS</th>
                                            <th>Nilai Kepribadian</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_nilai->kelas->siswas as $index => $siswa)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $siswa->nomor_induk }}</td>
                                            <td>{{ $siswa->nama }}</td>
                                            @foreach ($data_nilai->kelas->detail_mapel_kelas as $mapel)
                                                @php
                                                    $nilaiMapel = $siswa->nilai->firstWhere('detail_mapel_id', $mapel->id);
                                                @endphp
                                                <td>{{ $nilaiMapel->nilai_tugas ?? '-' }}</td>
                                                <td>{{ $nilaiMapel->nilai_uts ?? '-' }}</td>
                                                <td>{{ $nilaiMapel->nilai_uas ?? '-' }}</td>
                                                <td>{{ $nilaiMapel->nilai_kepribadian ?? '-' }}</td>
                                            @endforeach
                                            
                                            @if (auth()->user()->role == 'guru')
                                                {{-- Check if all values are filled --}}
                                                @php
                                                    $allFilled = $data_nilai->kelas->detail_mapel_kelas->every(function ($mapel) use ($siswa) {
                                                        $nilai = $siswa->nilai->firstWhere('detail_mapel_id', $mapel->id);
                                                        return $nilai && $nilai->nilai_tugas && $nilai->nilai_uts && $nilai->nilai_uas && $nilai->nilai_kepribadian;
                                                    });
                                                @endphp
                                                @if ($allFilled)
                                                    <td>
                                                        <a href="/raport/{{ $siswa->id }}" class="btn btn-info" target="_blank">
                                                            <i class="bi bi-eye"></i>
                                                        </a>                                                    
                                                    </td>
                                                    <td>
                                                        @if ($siswa->nilai->first()->status == null)    
                                                            <a href="/raport-ttd/{{ $siswa->id }}" class="btn btn-success">
                                                                <i class="bi bi-pencil"></i> 
                                                            </a> 
                                                        @elseif ($siswa->nilai->first()->status == 'ditandatangani walikelas') 
                                                            <button disabled="disabled" class="btn btn-secondary">  <i class="bi bi-pencil"></i>  </button>
                                                        @elseif ($siswa->nilai->first()->status == 'selesai') 
                                                            <a href="/download/{{ $siswa->id }}" class="btn btn-success" target="_blank">
                                                                <i class="bi bi-download"></i> 
                                                            </a> 
                                                        @endif
                                                    </td>
                                                @else
                                                    <td> - </td>
                                                    <td> - </td>
                                                @endif
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
