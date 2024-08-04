@extends('layouts.main')

@section('content')
    <div class="pagetitle">
        <h1>{{ $title }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item">{{ $title }}</li>
                <li class="breadcrumb-item active">{{ $data_nilai->mapel->nama_mapel }}</li>
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
                            <h5 class="card-title">Total : {{ $data_nilai->kelas->siswas->count() }}  Siswa</h5>
                        </div>

                        <div class="table-responsive">
                            <table class="table datatable table-bordered" id="pegawai">
                                <thead>
                                    <tr>
                                        <th rowspan="2">No.</th>
                                        <th rowspan="2">Nomor Induk</th>
                                        <th rowspan="2">Nama</th>
                                        <th colspan="4" class="text-center"> Nilai </th>
                                    </tr>
                                    <tr>
                                        <th> Nilai Harian </th>
                                        <th> UTS </th>
                                        <th> UAS </th>
                                        <th> Nilai Kepribadian </th>
                                    </tr>
                                </thead>
                                {{-- <thead>
                                    <tr>
                                        <th> No. </th>
                                        <th> Nomor induk </th>
                                        <th> Nama </th>
                                        <th> Nilai Harian </th>
                                        <th> UTS </th>
                                        <th> UAS </th>
                                    </tr>
                                </thead> --}}
                                <tbody>
                                    @foreach ($data_nilai->kelas->siswas as $index => $siswa)
                                        @php
                                            $nilaiMapel = $siswa->nilai->firstWhere('detail_mapel_id', $data_nilai->id);
                                        @endphp
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $siswa->nomor_induk }}</td>
                                            <td>{{ $siswa->nama }}</td>
                                            <td>
                                                @if($nilaiMapel)
                                                    <form action="{{ route('data-nilai.update', $nilaiMapel->id) }}" method="POST" class="d-flex">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="text" class="form-control" name="nilai_tugas" value="{{ $nilaiMapel->nilai_tugas ?? '' }}">
                                                        <button type="submit" class="btn btn-primary btn-sm">
                                                            <i class="bi bi-check-square"></i>
                                                        </button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('data-nilai.store') }}" method="POST" class="d-flex">
                                                        @csrf
                                                        <input type="hidden" name="detail_mapel" value="{{ $data_nilai->id }}">
                                                        <input type="hidden" name="nomor_induk" value="{{ $siswa->id }}">
                                                        <input type="text" class="form-control" name="nilai_tugas">
                                                        <button type="submit" class="btn btn-primary btn-sm">
                                                            <i class="bi bi-check-square"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                            @if($nilaiMapel && isset($nilaiMapel->nilai_tugas))
                                                <td>
                                                    <form action="{{ route('data-nilai.update', $nilaiMapel->id) }}" method="POST" class="d-flex">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="text" class="form-control" name="nilai_uts" value="{{ $nilaiMapel->nilai_uts ?? '' }}">
                                                        <button type="submit" class="btn btn-primary btn-sm">
                                                            <i class="bi bi-check-square"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            @else
                                                <td> - </td>
                                            @endif
                                            @if($nilaiMapel && isset($nilaiMapel->nilai_tugas) && isset($nilaiMapel->nilai_uts))
                                                <td>
                                                    <form action="{{ route('data-nilai.update', $nilaiMapel->id) }}" method="POST" class="d-flex">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="text" class="form-control" name="nilai_uas" value="{{ $nilaiMapel->nilai_uas ?? '' }}">
                                                        <button type="submit" class="btn btn-primary btn-sm">
                                                            <i class="bi bi-check-square"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            @else
                                                <td> - </td>
                                            @endif
                                            @if($nilaiMapel && isset($nilaiMapel->nilai_tugas) && isset($nilaiMapel->nilai_uts) && isset($nilaiMapel->nilai_uas))
                                                <td>
                                                    <form action="{{ route('data-nilai.update', $nilaiMapel->id) }}" method="POST" class="d-flex">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="text" class="form-control" name="nilai_kepribadian" value="{{ $nilaiMapel->nilai_kepribadian ?? '' }}">
                                                        <button type="submit" class="btn btn-primary btn-sm">
                                                            <i class="bi bi-check-square"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            @else
                                                <td> - </td>
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
