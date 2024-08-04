@extends('layouts.main')

@section('content')
    <div class="pagetitle">
        <h1>Create New Siswa</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/data-siswa">Siswa</a></li>
                <li class="breadcrumb-item active">Create</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <form action="/data-siswa/store" method="POST">
                            @csrf
                            <input type="hidden" name="kelas" value="{{ $kelas->id }}">
                            <div class="my-3">
                                <label for="nomor_induk" class="form-label">Nomor Induk</label>
                                <input type="text" class="form-control @error('nomor_induk') is-invalid @enderror" id="nomor_induk" name="nomor_induk" value="{{ old('nomor_induk') }}" >
                                @error('nomor_induk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}" >
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                <select class="form-select @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin" name="jenis_kelamin" >
                                    <option value="" disabled selected>Select Jenis Kelamin</option>
                                    <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3" >{{ old('alamat') }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Create</button>
                            <a href="/data-siswa" class="btn btn-secondary">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
