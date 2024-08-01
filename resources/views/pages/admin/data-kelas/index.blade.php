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
                      <h2 class="text-center mt-2"> Informasi Jurusan </h2>

                        <div class="row">

                            <div class="col-md-4">
                                <div class="card">
                                  <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                      <h5 class="card-title">Multi media</h5>
                                      <div class="d-flex gap-2">

                                        {{-- edit data --}}
                                        <button type="button" class="btn btn-primary shadow-none" data-bs-toggle="modal" data-bs-target="#edit"><i class="ri-pencil-fill"></i></button>
                                        <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog">
                                            <form action="" method="post" enctype="multipart/form-data">
                                              @csrf
                                              @method('put')
                                              <div class="modal-content">
                                              <div class="modal-header">
                                                  <h5 class="modal-title">Edit Data</h5>
                                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                              </div>
                                              <div class="modal-body">
                                                inputan untuk edit
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
                                        <button type="button" class="btn btn-danger shadow-none" data-bs-toggle="modal" data-bs-target="#hapus-jurusan"><i class="bi bi-trash"></i></button>
                                        <div class="modal fade" id="hapus-jurusan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h5 class="modal-title"> Hapus Informasi Jurusan </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                  </div>
                                                    <div class="modal-body text-center">
                                                        <p style="color: black">Apakah anda yakin untuk menghapus ?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary btn-sm shadow-none" data-bs-dismiss="modal">Tidak</button>
                                                        <form action="" method="POST" style="display: inline;">
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
 
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-12">
              <div class="card">
                  <div class="card-body pt-3">
                    <h2 class="text-center mt-2"> Informasi Kelas </h2>
                    <div class="card-body pt-3">
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
                                      <th>Aksi</th>
                                    </tr>
                                </thead>
                              <tbody>
                                  <tr>
                                      <td> 1 </td>
                                      <td> XII MM 1 </td>
                                      <td>Multi Media</td>
                                      <td>
                                          <a href=" " class="btn btn-primary btn-sm">
                                              <i class="bi bi-pencil-fill"></i>
                                          </a>
                                          <button type="button" class="btn btn-danger btn-sm shadow-none" data-bs-toggle="modal" data-bs-target="#hapus">
                                              <i class="bi bi-trash-fill"></i>
                                          </button>
                                          <div class="modal fade" id="hapus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                          <form action="" method="POST" style="display: inline;">
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
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
          </div>

        </div>
    </section>
@endsection