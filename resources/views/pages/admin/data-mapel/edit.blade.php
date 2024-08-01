@extends('layouts.main')

@section('content')
    <div class="pagetitle">
        <h1>{{ $title }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('data-mapel.index') }}">Mapel</a></li>
                <li class="breadcrumb-item active">{{ $title }}</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body pt-3">
                        <form action="{{ route('data-mapel.update', $mapel->id) }}" method="POST">
                            @csrf
                            @method('PUT') <!-- Metode HTTP PUT untuk pembaruan -->
                            <div class="row mb-3">
                                <label for="nama_mapel" class="col-sm-2 col-form-label">Nama Mapel</label>
                                <div class="col-sm-10">
                                    <input type="text" name="nama_mapel" class="form-control @error('nama_mapel') is-invalid @enderror" id="nama_mapel" value="{{ old('nama_mapel', $mapel->nama_mapel) }}" required>
                                    @error('nama_mapel')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('data-mapel.index') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
