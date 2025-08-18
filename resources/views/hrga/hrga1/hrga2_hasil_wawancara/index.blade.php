<x-app-layout :title="$title">

    <div class="row" x-data="{ checked: [] }">
        <div class="col-lg-12">
            <a href="{{ route('hrga1.2.singkron') }}" class="btn btn-info ms-2 btn-sm float-end mb-2"><i
                    class="fas fa-sync"></i>
                Singkron Data</a>

            {{-- <a href="{{ route('hrga1.2.create') }}" class="btn btn-primary ms-2 btn-sm float-end mb-2"><i
                    class="fas fa-plus"></i>
                Hasil Wawancara</a> --}}

            {{-- <a href="#" class="btn float-end btn-sm btn-primary"
                @click.prevent="window.location.href = `/hrga/1/2-hasil-wawancara/print?checked=${$data.checked.join(',')}`"><i
                    class="fas fa-print"></i> Print
                <span x-transition x-text="checked.length ? `(${checked.length})` : 'Semua'"></span>
            </a> --}}


        </div>
        <div class="col-12">
            <table class="table" id="example">
                <thead>
                    <tr>
                        <th class="dhead">No</th>
                        <th class="dhead">Nama calon karyawan</th>
                        <th class="dhead">No KTP</th>
                        <th class="dhead text-center">Usia</th>
                        <th class="dhead">Jenis kelamin</th>
                        <th class="dhead">Posisi</th>
                        <th class="dhead">Keputusan</th>
                        <th class="dhead">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $d)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $d->nama ?? '' }}</td>
                            <td>{{ $d->nik ?? '' }}</td>
                            <td class="text-center">
                                @if (isset($d->tgl_lahir))
                                    {{ \Carbon\Carbon::parse($d->tgl_lahir)->age }} Tahun
                                @endif
                            </td>
                            <td>{{ $d->jenis_kelamin ?? '' }}</td>
                            <td>{{ $d->posisi ?? '' }}</td>
                            <td>{{ $d->keputusan ?? 'Dilanjutkan' }}</td>
                            <td>
                                {{-- <a href="{{ route('hrga1.2.edit', $d->karyawan_id_dari_api) }}"
                                    class="btn btn-sm btn-primary"><i class="fas fa-pen"></i> Edit </a> --}}

                                <a target="_blank" href="{{ route('hrga1.2.print', $d->karyawan_id_dari_api) }}"
                                    class="btn btn-sm btn-primary"><i class="fas fa-print"></i> Print </a>
                            </td>
                            {{-- <td>
                                <input type="checkbox" class="form-check-input" :value="{{ $d->id }}"
                                    x-model="checked">
                            </td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</x-app-layout>
