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
                                    <input type="text" name="nama_mapel" class="form-control @error('nama_mapel') is-invalid @enderror" id="nama_mapel" value="{{ old('nama_mapel', $mapel->nama_mapel) }}">
                                    @error('nama_mapel')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="kelompok" class="col-sm-2 col-form-label">Kelompok</label>
                                <div class="col-sm-10">
                                    <select name="kelompok" id="kelompok" class="form-select @error('kelompok') is-invalid @enderror">
                                        <option value="" disabled selected>Pilih Kelompok</option>
                                        <option value="Kelompok A" {{ $mapel->kelompok == 'Kelompok A' ? 'selected' : '' }}>Kelompok A - Muatan Nasional</option>
                                        <option value="Kelompok B" {{ $mapel->kelompok == 'Kelompok B' ? 'selected' : '' }}>Kelompok B - </option>
                                        <option value="Kelompok C" {{ $mapel->kelompok == 'Kelompok C' ? 'selected' : '' }}>Kelompok C - Paket Keahlian</option>
                                    </select>
                                    @error('kelompok')
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
