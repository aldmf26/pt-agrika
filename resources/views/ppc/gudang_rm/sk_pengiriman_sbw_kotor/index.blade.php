<x-app-layout :title="$title">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-end gap-2">
                <div>

                </div>
                <div>

                </div>
            </div>

            <table id="example" class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama/ No. Registrasi Rumah Walet</th>
                        <th>Alamat Rumah Walet</th>
                        <th>Tujuan IKH</th>
                        <th>No. Registrasi IKPH</th>
                        <th>Alamat IKPH</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sk as $d)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $d->nm_walet }}</td>
                            <td>{{ $d->alamat }}</td>
                            <td>PT. Agrika Gatya Arum</td>
                            <td>339</td>
                            <td>Jl. Teluk tiram darat no 5B Rt 26 / RW 002 Telawang, Banjarmasin Barat, Kota
                                Banjarmasin, Kalimantan Selatan</td>
                            <td><a target="_blank" href="{{ route('ppc.gudang-rm.4.print', $d->rwb_id) }}"
                                    class="btn btn-sm btn-warning"><i class="fas fa-print"></i> </a></td>


                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


</x-app-layout>
