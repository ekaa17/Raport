@extends('layouts.main')

@section('content')
    <div class="pagetitle">
        <h1>{{ $title }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
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
                        <div class="d-flex align-items-center justify-content-between m-3">
                            <h5 class="card-title">Total : {{ $mapel->count() }} Mapel</h5>
                            <a href="{{ route('data-mapel.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus"></i> Data Baru
                            </a>
                        </div>

                        <div class="row">
                            @foreach ($mapel as $item)
                            <div class="col-md-4">
                                <div class="card">
                                  <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                      <h5 class="card-title">{{ $item->nama_mapel }}</h5>
                                      <div class="d-flex gap-2">

                                        {{-- edit data --}}
                                        <a href="{{ route('data-mapel.edit', $item->id) }}" class="btn btn-primary shadow-none">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>

                                        {{-- hapus data --}}
                                        <button type="button" class="btn btn-danger shadow-none" data-bs-toggle="modal" data-bs-target="#hapus-mapel{{ $item->id }}"><i class="bi bi-trash"></i></button>
                                        <div class="modal fade" id="hapus-mapel{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h5 class="modal-title"> Hapus Informasi Mata Pelajaran </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                  </div>
                                                    <div class="modal-body text-center">
                                                        <p style="color: black">Apakah anda yakin untuk menghapus mata pelajaran {{ $item->nama_mapel }}?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary btn-sm shadow-none" data-bs-dismiss="modal">Tidak</button>
                                                        <form action="{{ route('data-mapel.destroy', $item->id) }}" method="POST" style="display: inline;">
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
    </section>
@endsection
