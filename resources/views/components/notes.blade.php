<a data-bs-toggle="modal" href="#notes" class="btn btn-outline-primary btn-sm">Note's</a>
<x-modal id="notes" title="Note's" btnSave="T" size="modal-lg">
    <ul>
        @php
            $list = [
                'daftar karyawan diambil dari API program sarang di tbl hasil_wawancara',
                'hrga 2 data penilaian kompetensi muncul yg lebih dari 3 bulan aja, data absennya mengambil dari absen cabut yg posisi staf cabut aja',
                'hrga 2 data penilaian kompetensi yang di print data nya dummy untuk penilaian 1. penilaian parameter itu pakai random',
            ];
        @endphp
        @foreach ($list as $li)
            <li>{{ $li }}</li>
        @endforeach
    </ul>
</x-modal>
