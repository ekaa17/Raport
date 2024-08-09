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
                            <h5 class="card-title">Total : {{ $data_jurusan->count() }} Jurusan</h5>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah-jurusan">
                                <i class="bi bi-plus-square"></i> Tambah
                            </button>
                        </div>
                        <div class="row">
                            @foreach ($data_jurusan as $item)
                            <div class="col-md-4">
                                <div class="card">
                                  <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                      <h5 class="card-title">{{ $item->nama_jurusan }}</h5>
                                      <div class="d-flex gap-2">

                                        {{-- edit data --}}
                                        <button type="button" class="btn btn-primary shadow-none" data-bs-toggle="modal" data-bs-target="#edit{{ $item->id }}"><i class="ri-pencil-fill"></i></button>
                                        <div class="modal fade" id="edit{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog">
                                            <form action="{{ route('jurusan.update', $item->id) }}" method="post" enctype="multipart/form-data">
                                              @csrf
                                              @method('put')
                                              <div class="modal-content">
                                              <div class="modal-header">
                                                  <h5 class="modal-title">Edit Data</h5>
                                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                              </div>
                                              <div class="modal-body">
                                                <label for="nama_jurusan" class="form-label">Nama Jurusan</label>
                                                <input type="text" name="nama_jurusan" class="form-control @error('nama_jurusan') is-invalid @enderror shadow-none" id="nama_jurusan" value="{{ $item->nama_jurusan }}">
                                                @error('nama_jurusan') 
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div> 
                                                @enderror
                                              </div>
                                              <div class="modal-footer">
                                                  <button type="button" class="btn text-secondary shadow-none" data-bs-dismiss="modal">Kembali</button>
                                                  <button type="submit" class="btn btn-success text-white shadow-none">Kirim</button>
                                              </div>
                                              </div>
                                          </form>
                                          </div>
                                        </div>


                                        {{-- hapus data --}}
                                        <button type="button" class="btn btn-danger shadow-none" data-bs-toggle="modal" data-bs-target="#hapus-jurusan{{ $item->id }}"><i class="bi bi-trash"></i></button>
                                        <div class="modal fade" id="hapus-jurusan{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h5 class="modal-title"> Hapus Informasi Jurusan </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                  </div>
                                                    <div class="modal-body text-center">
                                                        <p style="color: black">Apakah anda yakin untuk menghapus jurusan {{ $item->nama_jurusan }}?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary btn-sm shadow-none" data-bs-dismiss="modal">Tidak</button>
                                                        <form action="{{ route('jurusan.destroy', $item->id) }}" method="POST" style="display: inline;">
                                                            @method('delete')
                                                            @csrf
                                                            <input type="submit" value="Hapus" class="btn btn-danger btn-sm shadow-none">
                                                        </form> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                            @endforeach 
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- tambah jurusan --}}
        <div class="modal fade" id="tambah-jurusan" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('jurusan.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Data Jurusan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="m-1">
                            <label for="nama_jurusan" class="form-label">Nama Jurusan</label>
                            <input type="text" name="nama_jurusan" class="form-control @error('nama_jurusan') is-invalid @enderror shadow-none" id="nama_jurusan" value="{{ old('nama_jurusan') }}">
                            @error('nama_jurusan') 
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div> 
                            @enderror
                        </div>          
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn text-secondary shadow-none" data-bs-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-success text-white shadow-none">Kirim</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </section>
@endsection