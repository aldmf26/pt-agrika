<table class="table table-bordered" id="table_scroll">
    <thead>
        <tr>
            <th width="5px">No</th>
            <th>Nama</th>
            <th>Divisi</th>
            <th class="text-center">
                Check
                <br>
                <input type="checkbox" name="" class="checkall" id="">
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pegawai as $p)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $p->nama }}</td>
                <td>{{ $p->divisi->divisi }}</td>
                <td class="text-center">
                    <input type="checkbox" class="check_item" name="id_pegawai[]" value="{{ $p->karyawan_id_dari_api }}"
                        id="">
                </td>
            </tr>
        @endforeach
    </tbody>

</table>
