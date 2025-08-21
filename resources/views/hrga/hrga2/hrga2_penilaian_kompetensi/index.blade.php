<x-app-layout :title="$title">
    <div class="card">
        <div class="card-body">
            <div class="row">

                <div class="col-12">
                    {{-- <a href="{{route('hrga2.2.absen')}}" class="btn btn-primary btn-sm float-end mb-2"><i class="fa fa-plus"></i> Absen
                        Office</a> --}}

                    <a href="{{ route('hrga2.2.singkron') }}" class="btn btn-info me-2 btn-sm float-end mb-2"><i
                            class="fas fa-sync"></i> S Data</a>
                </div>
                <div class="col-12">
                    <table class="table table-bordered" id="example">
                        <thead>
                            <tr>
                                <th class="dhead">#</th>
                                <th class="dhead">Nama Karyawan</th>
                                <th class="dhead">Nik</th>
                                <th class="dhead">Usia</th>
                                <th class="dhead">Jenis Kelamin</th>
                                <th class="dhead">Divisi</th>
                                <th class="dhead">Posisi</th>
                                <th class="dhead">Tanggal Masuk</th>
                                <th class="dhead">Periode <br> Masa Percobaan</th>
                                <th class="dhead">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $d)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $d->nama }}</td>
                                    <td>{{ $d->nik }}</td>
                                    <td>{{ umur($d->tgl_lahir) }} Tahun</td>
                                    <td>{{ $d->jenis_kelamin }}</td>
                                    <td>{{ $d->divisi }}</td>
                                    <td>{{ $d->posisi ?? '' }}</td>
                                    <td>
                                        {{ $d->tgl_masuk == null ? '-' : tanggal($d->tgl_masuk) }}
                                        @if ($d->tgl_masuk != null)
                                            ({{ $lamaKerja = (int) \Carbon\Carbon::parse($d->tgl_masuk)->diffInYears(now()) }}
                                            tahun
                                            {{ $lamaKerja2 = (int) \Carbon\Carbon::parse($d->tgl_masuk)->diffInMonths(now()) % 12 }}
                                            bulan)
                                        @endif
                                    </td>
                                    <td>
                                        @if ($d->status_karyawan != 'Karyawan Tetap')
                                            {{ $d->status_karyawan }} bulan
                                            {{-- , berakhir tanggal
                                            {{ tanggal(date('Y-m-d', strtotime('+' . $d->status_karyawan . ' month', strtotime($d->tgl_masuk)))) }} --}}
                                        @else
                                            {{ $d->status_karyawan }}
                                        @endif
                                    </td>
                                    </td>
                                    <td class="d-flex gap-1">
                                        {{-- <a target="_blank" href="{{ route('hrga2.2.penilaian', $d->id_karyawan) }}"
                                        class="btn btn-sm btn-primary">Lihat Penilaian</a> --}}
                                        <a target="_blank"
                                            href="{{ route('hrga2.2.print', [$d->id_karyawan, $d->divisi_id]) }}"
                                            class="btn btn-sm btn-info">Print</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
