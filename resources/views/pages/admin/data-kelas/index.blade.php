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
                    <div class="d-flex align-items-center justify-content-end m-3">
                        <a href="{{ route('data-kelas.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus"></i> Data Baru
                        </a>
                    </div>
                      <div class="table-responsive">
                          <table class="table datatable" id="pegawai">
                              <thead>
                                  <tr>
                                      <th>No.</th>
                                      <th>Kelas</th>
                                      <th>Jurusan</th>
                                      <th>Mata Pelajaran</th>
                                      <th>Aksi</th>
                                    </tr>
                                </thead>
                              <tbody>
                                @foreach($data_kelas as $index => $item)
                                    <tr>
                                        <td> {{ $index + 1 }} </td>
                                        <td> 
                                            @if ( $item->kelas == 10)
                                                X
                                            @elseif ( $item->kelas == 11)
                                                XI
                                            @else
                                                XII
                                            @endif
                                            {{ $item->nama_kelas }}
                                        </td>
                                        <td>{{ $item->jurusan->nama_jurusan }}</td>
                                        <td>
                                            <ol>
                                                @foreach ($item->detail_mapel_kelas as $detail)
                                                    <li> {{ $detail->mapel->nama_mapel }} 
                                                        <button type="button" class="btn btn-danger btn-sm shadow-none" data-bs-toggle="modal" data-bs-target="#hapus-mapel{{ $detail->id }}">
                                                            <i class="bi bi-trash-fill"></i>
                                                        </button>
                                                        <div class="modal fade" id="hapus-mapel{{ $detail->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title text-center">Konfirmasi Hapus Data</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body text-center">
                                                                        <p style="color: black">Apakah anda yakin untuk menghapus mata pelajaran  {{ $detail->mapel->nama_mapel }}  ?</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary btn-sm shadow-none" data-bs-dismiss="modal">Tidak</button>
                                                                        <form action="/hapus-kelas-mapel/{{ $detail->id }}" method="POST" style="display: inline;">
                                                                            @method('delete')
                                                                            @csrf
                                                                            <input type="submit" value="Hapus" class="btn btn-danger btn-sm shadow-none">
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div></li>
                                                @endforeach
                                            </ol>

                                            {{-- tambah mapel --}}
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah-mapel">
                                                <i class="bi bi-plus-square"></i> tambah mata pelajaran
                                            </button>
                                            <div class="modal fade" id="tambah-mapel" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <form action="/data-kelas-mapel" method="post">
                                                    @csrf
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Tambah Data Mata Pelajaran</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="hidden" name="kelas_id" value="{{ $item->id }}">

                                                            <div class="m-1">
                                                                <label for="mapel_id" class="form-label">Nama Mata Pelajaran</label>
                                                                <select name="mapel_id" id="mapel_id" class="form-select @error('mapel_id') is-invalid @enderror">
                                                                    <option selected disabled>Pilih Mata Pelajaran</option>
                                                                    @foreach ($data_mapel as $mapel)
                                                                      <option value="{{ $mapel->id }}" {{ old('mapel_id') == $mapel->id ? 'selected' : '' }}> {{ $mapel->nama_mapel }} </option>  
                                                                    @endforeach
                                                                  </select>
                                                                @error('mapel_id') 
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div> 
                                                                @enderror
                                                            </div>          
                                                        </div>
                                                        <div class="modal-footer d-flex justify-content-between">
                                                            <button type="button" class="btn btn-secondary shadow-none" data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-success text-white shadow-none">Tambah</button>
                                                        </div>
                                                    </div>
                                                </form>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{ route('data-kelas.edit', $item->id) }}" class="btn btn-primary btn-sm">
                                                <i class="bi bi-pencil-fill"></i>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm shadow-none" data-bs-toggle="modal" data-bs-target="#hapus{{ $item->id }}">
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
                                                            <p style="color: black">Apakah anda yakin untuk menghapus data?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary btn-sm shadow-none" data-bs-dismiss="modal">Tidak</button>
                                                            <form action="{{ route('data-kelas.destroy', $item->id) }}" method="POST" style="display: inline;">
                                                                @method('delete')
                                                                @csrf
                                                                <input type="submit" value="Hapus" class="btn btn-danger btn-sm shadow-none">
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
          </div>

        </div>

    </section>
@endsection