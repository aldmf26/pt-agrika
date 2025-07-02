<x-app-layout :title="$title">
    <x-nav-link route="pur.seleksi.1.index" />
    <br>
    <div class="d-flex justify-content-end gap-2">
        <div>

        </div>
        <div>

            <a href="{{ route('pur.seleksi.1.print', ['kategori' => $k]) }}" class="btn btn-sm btn-primary"><i
                    class="fas fa-print"></i>
                Print</a>

            <a href="{{ route('pur.seleksi.1.create') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i>
                Daftar Supplier</a>
        </div>
    </div>

    <table id="example" class="table table-dark table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Supplier</th>
                <th>Alamat Supplier</th>
                <th>Produsen</th>
                <th>Contact Person</th>
                <th>No Telp</th>
                <th>Jenis Produk / Layanan</th>
                <th width="100">Hasil Evaluasi</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if ($k == 'satu')
                @foreach ($datas as $d)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $d->nama_supplier }}</td>
                        <td>{{ $d->alamat }}</td>
                        <td>{{ $d->produsen }}</td>
                        <td>{{ $d->contact_person }}</td>
                        <td>{{ $d->no_telp }}</td>
                        <td>{{ $d->kategori }}</td>
                        <td>
                            @foreach ($d->evaluasi as $evaluasi)
                                <a href="{{ route('pur.seleksi.1.evaluasi', $d->id) }}"
                                    class="btn btn-xs btn-primary">evaluasi Bulan {{ $evaluasi->periode_evaluasi }}</a>
                            @endforeach
                        </td>
                        <td>{{ $d->ket }}</td>
                        <td>


                            <a href="{{ route('pur.seleksi.1.edit', $d->id) }}" class="btn btn-xs btn-primary"><i
                                    class="fas fa-edit"></i></a>

                            <a onclick="return confirm('Yakin ingin menghapus data ini?')"
                                href="{{ route('pur.seleksi.1.destroy', $d->id) }}" class="btn btn-xs btn-danger"><i
                                    class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            @else
                @foreach ($rumah_walet as $r)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $r->nama }}</td>
                        <td>{{ $r->alamat }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Supllier material SBW</td>
                        <td></td>
                        <td></td>
                        <td>
                            <a href="{{ route('pur.seleksi.1.edit', $r->id) }}" class="btn btn-xs btn-primary"><i
                                    class="fas fa-edit"></i></a>
                            <a onclick="return confirm('Yakin ingin menghapus data ini?')"
                                href="{{ route('pur.seleksi.1.destroy', $r->id) }}" class="btn btn-xs btn-danger"><i
                                    class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            @endif


        </tbody>
    </table>

</x-app-layout>
