<!-- resources/views/pages/admin/data-wali-kelas/create.blade.php -->
@extends('layouts.main')

@section('content')
    <div class="pagetitle">
        <h1>{{ $title }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('data-walikelas.index') }}">Wali Kelas</a></li>
                <li class="breadcrumb-item active">{{ $title }}</li>
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
                        <form action="{{ route('data-walikelas.store') }}" method="POST">
                            @csrf

                            <div class="row mb-3">
                                <label for="id_kelas" class="col-md-4 col-form-label">Kelas</label>
                                <div class="col-md-8">
                                    <select id="id_kelas" name="id_kelas" class="form-select @error('id_kelas') is-invalid @enderror">
                                        <option value="" disabled selected>Pilih Kelas</option>
                                        @foreach($kelas as $k)
                                            <option value="{{ $k->id }}">{{ $k->kelas }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_kelas')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="id_staff" class="col-md-4 col-form-label">Staff</label>
                                <div class="col-md-8">
                                    <select id="id_staff" name="id_staff" class="form-select @error('id_staff') is-invalid @enderror">
                                        <option value="" disabled selected>Pilih Staff</option>
                                        @foreach($staff as $s)
                                            <option value="{{ $s->id }}">{{ $s->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_staff')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="data_tahun_ajaran" class="col-md-4 col-form-label">Tahun Ajaran</label>
                                <div class="col-md-8">
                                    <select id="data_tahun_ajaran" name="data_tahun_ajaran" class="form-select @error('data_tahun_ajaran') is-invalid @enderror">
                                        <option value="" disabled selected>Pilih Tahun Ajaran</option>
                                        @foreach($tahunAjaran as $t)
                                            <option value="{{ $t->id }}">{{ $t->tahun }}</option>
                                        @endforeach
                                    </select>
                                    @error('data_tahun_ajaran')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a href="{{ route('data-walikelas.index') }}" class="btn btn-secondary">Batal</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
