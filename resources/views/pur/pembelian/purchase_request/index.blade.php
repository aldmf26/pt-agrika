<x-app-layout :title="$title">
    <div class="d-flex justify-content-between gap-2">
        <nav>
            <x-nav-link route="pur.pembelian.1.index" />
        </nav>
        <br>
        <div>
            @if ($kategori != 'lainnya')
                <a href="{{ route('pur.pembelian.1.create', ['kategori' => $kategori]) }}"
                    class="btn btn-sm btn-primary"><i class="fas fa-plus"></i>
                    Purchase Request</a>
            @endif
        </div>
    </div>

    <table id="example" class="table table-dark table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th class="text-start">No PR</th>
                <th class="text-end">Tanggal</th>
                <th>Diminta Oleh</th>
                <th>Posisi</th>
                <th width="200">Alasan Permintaan</th>
                <td class="text-center">Aksi</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $d)
                @if ($kategori == 'lainnya')
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="text-start">{{ $d->no_pr }}</td>
                        <td class="text-end">{{ tanggal($d->tgl) }}</td>
                        <td>Sinta</td>
                        <td>BK</td>
                        <td>Untuk memenuhi kebutuhan proses cetak, sesuai dengan jumlah team yang tersedia dan target
                            produksi</td>
                        <td class="text-center">
                            <a class="btn btn-xs btn-primary"
                                href="{{ route('pur.pembelian.1.print_sbw', [
                                    'no_pr' => $d->no_pr,
                                    'tgl' => $d->tgl,
                                    'rwb_id' => $d->rwb_id,
                                ]) }}"><i
                                    class="fas fa-print"></i></a>
                        </td>
                    </tr>
                @else
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="text-start">{{ $d->no_pr }}</td>

                        <td class="text-end">{{ tanggal($d->tgl) }}</td>
                        <td>{{ $d->diminta_oleh }}</td>
                        <td>{{ $d->posisi }}</td>
                        <td>{{ $d->alasan_permintaan }}</td>
                        <td align="center">
                            @if ($d->status == 'disetujui')
                                @if ($d->sudahPo->count() == 0)
                                    <a class="btn btn-xs btn-info"
                                        href="{{ route('pur.pembelian.2.create', ['id_pr' => $d->id, 'kategori' => $kategori]) }}">po</a>
                                @endif
                            @else
                                <a class="btn btn-xs btn-info"
                                    href="{{ route('pur.pembelian.1.selesai', [$d->id, $kategori]) }}">selesai</a>
                            @endif
                            @can('presiden')
                                <a class="btn btn-xs btn-info ms-1"
                                    onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"
                                    href="{{ route('pur.pembelian.1.destroy', [$d->id, $kategori]) }}"><i
                                        class="fas fa-trash"></i></a>
                            @endcan

                            <a class="btn btn-xs btn-primary" href="{{ route('pur.pembelian.1.print', $d->id) }}"><i
                                    class="fas fa-print"></i></a>
                        </td>
                    </tr>
                @endif
            @endforeach


        </tbody>
    </table>
    <x-modal title="Detail Purchase Order" idModal="detail" btnSave="T">
        @livewire('pur.detail')
    </x-modal>
</x-app-layout>
