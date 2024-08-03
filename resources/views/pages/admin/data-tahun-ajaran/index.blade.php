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
                        <div class="row">

                            <div class="col-md-12">
                                @if(DB::table('data_tahun_ajarans')->where('status', '!=' ,'nonaktif')->exists())
                                    <div class="card-title">
                                        <p class="text-center"> Informasi Tahun Ajaran!  </p>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('tahun-ajaran.update', $data_tahun_ajaran->id) }}" method="POST">
                                            @method('put')
                                            @csrf
                                            <div>
                                                <label for="tahun_ajaran" class="form-label"> Tahun Ajaran </label>
                                                <input type="text" name="tahun_ajaran" class="form-control @error('tahun_ajaran') is-invalid @enderror shadow-none" id="tahun_ajaran" value="{{ $data_tahun_ajaran->tahun_ajaran }}" placeholder="Contoh : 2022/2023">
                                                @error('tahun_ajaran') 
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div> 
                                                @enderror
                                            </div>          
                                            <div class="mt-4">
                                                <label for="semester" class="form-label"> Semester </label>
                                                <select class="form-select @error('semester') is-invalid @enderror" id="semester" aria-label="Default select example" name="semester">
                                                    <option selected disabled>Pilih Semester</option>
                                                    <option value="Ganjil" {{  $data_tahun_ajaran->semester === 'Ganjil' ? 'selected' : '' }}>Semester Ganjil</option>
                                                    <option value="Genap" {{  $data_tahun_ajaran->semester === 'Genap' ? 'selected' : '' }}>Semester Genap</option>
                                                </select>
                                                @error('semester') 
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div> 
                                                @enderror
                                            </div> 
                                            <div class="col-md-12 my-4 d-flex justify-content-between align-items-center">
                                                <button type="submit" class="btn btn-success"> Update </button>

                                                {{-- tutup tahun ajaran --}}
                                                <button type="button" class="btn btn-danger shadow-none" data-bs-toggle="modal" data-bs-target="#tutup-tapel">Tutup Tahun Ajaran</button>
                                                <div class="modal fade" id="tutup-tapel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"> Tutup Tahun Ajaran </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                            <div class="modal-body text-center">
                                                                <p style="color: black">Apakah anda yakin untuk menutup tahun ajaran {{ $data_tahun_ajaran->tahun_ajaran }}, semester {{ $data_tahun_ajaran->semester }}?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary btn-sm shadow-none" data-bs-dismiss="modal">Tidak</button>
                                                                <a href="/tutup-tahun-ajaran" class="btn btn-danger btn-sm shadow-none"> Yakin </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                @else           
                                    <div class="d-flex justify-content-center align-items-center">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah-tahun-ajaran">
                                            <i class="bi bi-plus"></i> Tahun Ajaran Baru
                                        </button>
                                    </div>
                                @endif
                            </div>
 
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- tambah tahun-ajaran --}}
        <div class="modal fade" id="tambah-tahun-ajaran" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('tahun-ajaran.store') }}" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tahun Ajaran Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="m-1">
                            <label for="tahun_ajaran" class="form-label"> Tahun Ajaran </label>
                            <input type="text" name="tahun_ajaran" class="form-control @error('tahun_ajaran') is-invalid @enderror shadow-none" id="tahun_ajaran" value="{{ old('tahun_ajaran') }}" placeholder="Contoh : 2022/2023">
                            @error('tahun_ajaran') 
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div> 
                            @enderror
                        </div>          
                        <div class="mt-2 m-1">
                            <label for="semester" class="form-label"> Semester </label>
                            <select class="form-select @error('semester') is-invalid @enderror" id="semester" aria-label="Default select example" name="semester">
                                <option selected disabled>Pilih Semester</option>
                                <option value="Ganjil" {{  old('semester') === 'Ganjil' ? 'selected' : '' }}>Semester Ganjil</option>
                                <option value="Genap" {{  old('semester') === 'Genap' ? 'selected' : '' }}>Semester Genap</option>
                              </select>
                            @error('semester') 
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