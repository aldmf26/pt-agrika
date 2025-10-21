<x-app-layout title="{{ $title }}">

    <form action="{{ route('hrga5.2.update') }}" method="POST">
        @csrf


        <input type="hidden" name="jenis" value="{{ $jenis }}">
        <input type="hidden" name="tahun" value="{{ $tahun }}">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-6">
                        <table class="table">
                            <tr>
                                <td colspan="3">Nama Sarana/Prasarana Umum</td>

                                <td colspan="5"> : {{ ucfirst(strtolower($items->nama_item)) }}</td>
                            </tr>
                            <tr>
                                <td colspan="3">Jumlah</td>

                                <td colspan="2"> : {{ ucfirst(strtolower($items->jumlah)) }}</td>
                            </tr>
                            <tr>
                                <td colspan="3">Lokasi</td>

                                <td colspan="2"> : {{ ucfirst(strtolower($items->lokasi)) }}</td>
                            </tr>
                            <tr>
                                <td colspan="3">Tahun Pemeriksaan</td>

                                <td colspan="2"> : {{ ucfirst(strtolower($tahun)) }}</td>
                            </tr>

                        </table>
                    </div>
                </div>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table width="100%" class="table table-bordered">
                        <thead>


                            <tr class="table-bawah" style="font-size: 11px">
                                <th class="dhead text-center  align-middle " style="white-space: nowrap">Tanggal</th>
                                <th class="dhead text-center  align-middle " style="white-space: nowrap">Urutan unit /
                                    <br>
                                    Ruang
                                </th>
                                <th class="dhead text-center  align-middle " style="white-space: nowrap">Perawatan/ <br>
                                    Perbaikan</th>
                                <th class="dhead text-center  align-middle " style="white-space: nowrap" width="25%">
                                    Jenis <br>
                                    yang dilakukan</th>
                                <th class="dhead text-center  align-middle " style="white-space: nowrap">Kondisi <br>
                                    kebersihan <br>
                                    akhir</th>
                                <th class="dhead text-center  align-middle " style="white-space: nowrap">Kondisi fungsi
                                    <br>
                                    akhir
                                </th>
                                <th class="dhead text-center  align-middle " style="white-space: nowrap">Kesimpulan <br>
                                    (Ok/Not OK)</th>
                                <th class="dhead text-center  align-middle " style="white-space: nowrap">Paraf Pelaksana
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($union as $r)
                                <tr class="table-bawah" style="font-size: 11px">
                                    <td class="text-end text-nowrap">{{ tanggal($r->tanggal) }}

                                        <input type="hidden" name="id[]" value="{{ $r->id }}">
                                    </td>
                                    @if ($items->jenis_item == 'ac')
                                        <td class="text-start" style="white-space: normal">
                                            {{ ucfirst(strtolower($items->no_identifikasi)) }} -
                                            {{ ucfirst(strtolower($items->lokasi)) }}</td>
                                    @else
                                        @php
                                            $rincian = DB::table('rincian_ruangan')
                                                ->where('id', $r->rincian_id)
                                                ->first();
                                        @endphp
                                        <td class="text-start" style="white-space: normal">
                                            {{ ucfirst(strtolower($rincian->nama_rincian)) }}
                                        </td>
                                    @endif

                                    <td class="text-start">{{ ucfirst(strtolower($r->ket)) }}</td>
                                    <td class="text-start">
                                        <input type="text" class="form-control" name="kesimpulan[]"
                                            value="{{ $r->kesimpulan }}" style="font-size: 12px">
                                    </td>
                                    <td class="text-start">
                                        {{ $r->ket == 'perawatan' ? 'Bersih ' : 'Kembali bersih' }}
                                    </td>
                                    <td class="text-start" class="text-start" style="white-space: normal">
                                        <input type="text" class="form-control" name="fungsi[]"
                                            value="{{ $r->fungsi }}" style="font-size: 12px">
                                    </td>
                                    <td class="text-start">
                                        Ok
                                    </td>
                                    <td class="text-start"></td>


                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary float-end"><i class="fas fa-save"></i>
                    Save
                </button>
                <a class="btn btn-secondary float-end me-2"
                    href="{{ route('hrga5.2.index', ['jenis' => $jenis]) }}">Kembali</a>
            </div>
        </div>
    </form>


</x-app-layout>
