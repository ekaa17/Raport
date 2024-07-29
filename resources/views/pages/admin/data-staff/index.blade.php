@extends('layouts.main')

@section('content')
    <div class="pagetitle">
        <h1>{{ $title }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active"> {{ $title }} </li>
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
                            <h5 class="card-title">Total : 0 Staff</h5>
                            <a href=" " class="btn btn-primary">
                                <i class="bi bi-plus"></i> Data Baru
                            </a>
                        </div>

                        <div class="table-responsive">
                            <table class="table datatable" id="pegawai">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th>NIP</th>
                                        <th>Gender</th>
                                        <th>Jabatan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td> 1 </td>
                                        <td>Nama</td>
                                        <td>NIP</td>
                                        <td>Gender</td>
                                        <td>Jabatan</td>
                                        <td>
                                            <a href=" " class="btn btn-primary btn-sm">
                                                <i class="bi bi-pencil-fill"></i>
                                            </a>
                                            <a href=" " class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash-fill"></i>
                                            </a>
                                            {{-- <button type="button" class="btn btn-danger btn-sm shadow-none" data-bs-toggle="modal" data-bs-target="#hapus{{ $item->id }}">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                            <div class="modal fade" id="hapus{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-center">Konfirmasi Hapus Data</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            <p style="color: black">Apakah anda yakin untuk menghapus data informasi dari <br> <b>{{ $item->nama_lengkap }}</b>?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary btn-sm shadow-none" data-bs-dismiss="modal">Tidak</button>
                                                            <form action="{{ route('data-staff.destroy', $item->id) }}" method="POST" style="display: inline;">
                                                                @method('delete')
                                                                @csrf
                                                                <input type="submit" value="Hapus" class="btn btn-danger btn-sm shadow-none">
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection