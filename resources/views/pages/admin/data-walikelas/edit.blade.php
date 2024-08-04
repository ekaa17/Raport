@extends('layouts.main')

@section('content')
    <div class="pagetitle">
        <h1>{{ $title }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('data-kelas.index') }}">Kelas</a></li>
                <li class="breadcrumb-item active">{{ $title }}</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body pt-3">
                        <form action="{{ route('data-walikelas.update', $waliKelas->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label for="id_kelas" class="col-md-3 col-form-label">Kelas</label>
                                <div class="col-md-9">
                                    <select id="id_kelas" name="id_kelas" class="form-select @error('id_kelas') is-invalid @enderror">
                                        <option value="" disabled selected>Pilih Kelas</option>
                                        @foreach($kelas as $k)
                                            <option value="{{ $k->id }}" {{ old('id_kelas', $waliKelas->id_kelas) == $k->id ? 'selected' : '' }}>{{ $k->kelas }} {{ $k->nama_kelas }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_kelas')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="id_staff" class="col-md-3 col-form-label">Staff</label>
                                <div class="col-md-9">
                                    <select id="id_staff" name="id_staff" class="form-select @error('id_staff') is-invalid @enderror">
                                        <option value="" disabled selected>Pilih Staff</option>
                                        @foreach($staff as $s)
                                            <option value="{{ $s->id }}" {{ old('id_staff', $waliKelas->id_staff) == $s->id ? 'selected' : '' }}>{{ $s->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_staff')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="text-center">
                                <a href="{{ route('data-walikelas.index') }}" class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
