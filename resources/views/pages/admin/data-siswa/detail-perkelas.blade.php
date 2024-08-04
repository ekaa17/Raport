@extends('layouts.main')

@section('content')
    <div class="pagetitle">
        <h1>{{ $title }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">
                    {{ $title }}
                    @if ( $kelas->kelas == 10)
                        X
                    @elseif ( $kelas->kelas == 11)
                        XI
                    @else
                        XII
                    @endif
                    {{ $kelas->nama_kelas }}
                </li>
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
                            <h5 class="card-title">Total : {{ $siswa->count() }} Siswa</h5>
                            <a href="/data-siswa/create/{{ $kelas->id }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-plus"></i> Data Baru
                            </a>
                        </div>

                        <div class="table-responsive">
                            <table class="table datatable" id="pegawai">
                                <thead>
                                    <tr>
                                        <th>Nomor Induk</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Alamat</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($siswa as $s)
                                        <tr>
                                            <td>{{ $s->nomor_induk }}</td>
                                            <td>{{ $s->nama }}</td>
                                            <td>{{ $s->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                            <td>{{ $s->alamat }}</td>\
                                            <td>
                                                <a href="/data-siswa/edit/{{ $s->id }}" class="btn btn-warning btn-sm">Edit</a>

                                                {{-- hapus data --}}
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus-siswa{{ $s->id }}"> Hapus </button>
                                                <div class="modal fade" id="hapus-siswa{{ $s->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                      <div class="modal-content">
                                                          <div class="modal-header">
                                                            <h5 class="modal-title"> Hapus Informasi Siswa </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                          </div>
                                                            <div class="modal-body text-center">
                                                                <p style="color: black">Apakah anda yakin untuk menghapus data {{ $s->nama }}?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary btn-sm shadow-none" data-bs-dismiss="modal">Tidak</button>
                                                                <form action="/data-siswa/destroy/{{ $s->id }}" method="POST" style="display: inline;">
                                                                    @method('delete')
                                                                    @csrf
                                                                    <input type="submit" value="Hapus" class="btn btn-danger btn-sm shadow-none">
                                                                </form> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
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
