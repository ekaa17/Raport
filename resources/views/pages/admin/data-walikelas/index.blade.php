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
                                <div class="d-flex justify-content-between align-items-center">
                                    <form action="" class="w-25">
                                        <select name="" id="" class="form-select">
                                            <option value="">2021/2022</option>
                                            <option value="">2022/2023</option>
                                        </select>
                                    </form>
                                    <a href=" " class="btn btn-primary">
                                        <i class="bi bi-plus"></i> Tahun Pelajaran
                                    </a>
                                </div>
                            </div>
 
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-12">
              <div class="card">
                  <div class="card-body pt-3">
                      <div class="table-responsive">
                          <table class="table datatable" id="pegawai">
                              <thead>
                                  <tr>
                                      <th>No.</th>
                                      <th>Kelas</th>
                                      <th>Jurusan</th>
                                      <th>Wali Kelas</th>
                                      <th>  </th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <tr>
                                      <td> 1 </td>
                                      <td> XII MM 1 </td>
                                      <td>Multi Media</td>
                                      <td>Bu Aan</td>
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