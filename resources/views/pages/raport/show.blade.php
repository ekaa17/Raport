<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>E - Rapor Semester {{ $tahun_ajaran->semester }} ({{ $tahun_ajaran->tahun_ajaran }})</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('assets/img/logo.png') }}" rel="icon">
  <link href="{{ asset('assets/img/logo.png') }}" rel="logo">

  {{-- <style>
    * {
        border: 1px solid red;
    }
  </style> --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>

  <div class="my-5 mx-3">
    <div style="margin: 15px 0px">
        <table class="w-50">
            <tr>
                <td> Nama Peserta Didik </td>
                <td> : </td>
                <td> {{ $siswa->nama }} </td>
            </tr>
            <tr>
                <td> Nomor Induk / NISN </td>
                <td> : </td>
                <td> {{ $siswa->nomor_induk }} / {{ $siswa->nisn }} </td>
            </tr>
            <tr>
                <td> Kelas </td>
                <td> : </td>
                <td> {{ $siswa->kelas->kelas }} {{ $siswa->kelas->nama_kelas }} </td>
            </tr>
            <tr>
                <td> Tahun Pelajaran </td>
                <td> : </td>
                <td> 2023/2024 </td>
            </tr>
            <tr>
                <td> Semester </td>
                <td> : </td>
                <td> Ganjil </td>
            </tr>
        </table>
    </div>

    <b> A. Nilai Akademik </b>
    <div class="d-flex justify-content-center align-items-center mb-3">
      <table class="table table-bordered text-center" class="my-0">
        <thead>
            <tr class="table-warning">
                <th> No </th>
                <th> Mata Pelajaran </th>
                <th> Kepribadian </th>
                <th> Nilai Tugas </th>
                <th> Predikat </th>
            </tr>
        </thead>
        <tbody>
            @if(count($kelompokA) > 0)
                <tr>
                    <td colspan="7" class="text-start"> Kelompok A (Muatan Nasional) </td>
                </tr>
                @foreach ($kelompokA as $index => $nilai)
                    <tr>
                        <td> {{ $index + 1 }} </td>
                        <td class="text-start"> {{ $nilai->detail_mapel_kelas->mapel->nama_mapel }} </td>
                        <td> {{ $nilai->nilai_kepribadian ?? '-' }} </td>
                        @php
                            $rataRata = round(($nilai->nilai_tugas + $nilai->nilai_uts + $nilai->nilai_uas) / 3);
                        @endphp
                    
                        <td> {{ $rataRata }} </td>
                        <td>
                            @if ($rataRata >= 91)
                                A
                            @elseif ($rataRata >= 81)
                                B
                            @elseif ($rataRata >= 70)
                                C
                            @else
                                D
                            @endif
                        </td>
                    </tr>
                @endforeach
            @endif

            @if(count($kelompokB) > 0)
                <tr>
                    <td colspan="7" class="text-start"> Kelompok B </td>
                </tr>
                @foreach ($kelompokB as $index => $nilai)
                    <tr>
                        <td> {{ $index + 1 }} </td>
                        <td class="text-start"> {{ $nilai->detail_mapel_kelas->mapel->nama_mapel }} </td>
                        <td> {{ $nilai->nilai_kepribadian ?? '-' }} </td>
                        @php
                            $rataRata = round(($nilai->nilai_tugas + $nilai->nilai_uts + $nilai->nilai_uas) / 3);
                        @endphp
                    
                        <td> {{ $rataRata }} </td>
                        <td>
                            @if ($rataRata >= 91)
                                A
                            @elseif ($rataRata >= 81)
                                B
                            @elseif ($rataRata >= 70)
                                C
                            @else
                                D
                            @endif
                        </td>
                    </tr>
                @endforeach
            @endif

            @if(count($kelompokC) > 0)
                <tr>
                    <td colspan="7" class="text-start"> Kelompok C (Muatan Lokal) </td>
                </tr>
                @foreach ($kelompokC as $index => $nilai)
                    <tr>
                        <td> {{ $index + 1 }} </td>
                        <td class="text-start"> {{ $nilai->detail_mapel_kelas->mapel->nama_mapel }} </td>
                        <td> {{ $nilai->nilai_kepribadian ?? '-' }} </td>
                        @php
                            $rataRata = round(($nilai->nilai_tugas + $nilai->nilai_uts + $nilai->nilai_uas) / 3);
                        @endphp
                    
                        <td> {{ $rataRata }} </td>
                        <td>
                            @if ($rataRata >= 91)
                                A
                            @elseif ($rataRata >= 81)
                                B
                            @elseif ($rataRata >= 70)
                                C
                            @else
                                D
                            @endif
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
      </table>
    </div>

    <br>
    
    <p class="text-end mx-5 my-0"> Cilegon, {{ date('d M Y') }} </p>
    <div class="d-flex justify-content-between align-items-start mx-5">
        <!-- Orangtua / Wali -->
        <div class="text-start" style="flex: 1; padding: 0 20px;">
            <p>Mengetahui, <br> Orangtua / Wali</p>
            <div style="height: 100px;" class="d-flex justify-content-start align-items-center"> <!-- Mengatur tinggi area agar tetap proporsional -->
                <b>.......................</b>
            </div>
        </div>
    
        <!-- Wali Kelas -->
        <div class="text-end" style="flex: 1; padding: 0 20px;">
            <p>WALI KELAS</p>
            @if ($siswa->nilai->first()->status == 'ditandatangani walikelas' || $siswa->nilai->first()->status == 'selesai')
                <div style="display: flex; flex-direction: column; align-items: end;">
                    <img src="{{ asset('assets/img/ttd-staff/'.$wali_kelas->staff->tanda_tangan) }}" alt="{{ $wali_kelas->staff->tanda_tangan }}" class="img-fluid mb-2" style="max-width: 75px">
                    <b>{{ $wali_kelas->staff->nama }}</b>
                    <p>NIP. {{ $wali_kelas->staff->nip }}</p>
                </div>
            @else
                <div style="height: 100px;"></div> <!-- Placeholder if signature not available -->
            @endif
        </div>
    </div>

    <div class="d-flex justify-content-center align-items-center text-center mt-2 mx-5">
    
        <!-- Wali Kelas -->
        <div>
            <p>
                Mengetahui, <br>
                Kepala Sekolah
            </p>
            @if ( $siswa->nilai->first()->status == 'selesai')
                <div style="display: flex; flex-direction: column; align-items: center;">
                    <img src="{{ asset('assets/img/ttd-staff/'.$kepala_sekolah->tanda_tangan) }}" alt="{{ $kepala_sekolah->tanda_tangan }}" class="img-fluid mb-2" style="max-width: 75px">
                    <b>{{ $kepala_sekolah->nama }}</b>
                    <p>NIP. {{ $kepala_sekolah->nip }}</p>
                </div>
            @else
                <div style="height: 100px;"></div> <!-- Placeholder if signature not available -->
            @endif
        </div>
    </div>

  </div>

  <script type="text/javascript">
    window.print();
  </script>
</body>

</html>
