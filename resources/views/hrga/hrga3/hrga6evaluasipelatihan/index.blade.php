<x-app-layout :title="$title">
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered" id="example">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Pelatihan</th>
                        <th>Nama</th>
                        <th>Divisi</th>
                        <th>Jenis Kelamin/ <br> Tanggal Lahir</th>
                        <th>Status</th>
                        <th>Tanggal Masuk</th>
                        <th>Posisi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($evaluasi as $e)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $e->tema_pelatihan }}</td>
                            <td>{{ $e->data_pegawai->nama }}</td>
                            <td>{{ $e->data_pegawai->divisi->divisi }}</td>
                            <td>{{ $e->data_pegawai->jenis_kelamin == 'P' ? 'Perempuan' : 'Laki-laki' }}
                                /
                                {{ date('d-m-Y', strtotime($e->data_pegawai->tgl_lahir)) }}
                            </td>
                            <td>{{ $e->data_pegawai->status }}</td>
                            <td>{{ date('d-m-Y', strtotime($e->data_pegawai->tgl_masuk)) }}</td>
                            <td>{{ $e->data_pegawai->posisi }}</td>
                            <td>
                                <a href="{{ route('hrga3.6.print', ['id_evaluasi' => $e->id]) }}" target="_blank"
                                    class="btn btn-primary btn-sm"> <i class="fas fa-print"></i></a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>

            </table>
        </div>
    </div>
</x-app-layout>
