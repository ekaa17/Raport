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
                            <h5 class="card-title">Total : {{ $data_kelas->count() }} Kelas</h5>
                        </div>

                        @foreach ($data_kelas as $item)
                          <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                  <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                      <h5 class="card-title">
                                        @if ( $item->kelas == 10)
                                            X
                                        @elseif ( $item->kelas == 11)
                                            XI
                                        @else
                                            XII
                                        @endif
                                        {{ $item->nama_kelas }}
                                      </h5>
                                      <div class="d-flex gap-2">
                                        <a href="{{ route('data-siswa.show', $item->id) }}" class="btn btn-info"> Data Siswa <i class="bi bi-chevron-double-right"></i></a>
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
    </section>
@endsection