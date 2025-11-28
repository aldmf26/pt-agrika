<x-app-layout :title="$title">
    <x-nav-link />
    <br>
    <br>
    <div x-data="{ checked: [] }">
        <div class="d-flex justify-content-end gap-2">

            {{-- <div>
            <button data-bs-toggle="modal" data-bs-target="#tambah" type="button" class="btn btn-sm btn-primary"><i
                    class="fas fa-plus"></i> Barang </button>
            <div x-data="{ showProduk: false }">
                <x-modal btnSave="T" idModal="tambah" title="Tambah Produk" size="modal-lg">
                    @livewire('ppc.tbh-barang')
                </x-modal>
            </div>
        </div> --}}
            {{-- <div>
                <a href="{{ route('ppc.gudang-rm.5.create') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i>
                    Label Identitas Bahan</a>

            </div> --}}
            <div>
                <a x-show="checked.length" href="#" class="float-end btn btn-sm btn-primary" target="_blank"
                    @click.prevent="window.location.href = `/ppc/gudang-rm/5-label-identitas-bahan/print?checked=${encodeURIComponent(checked.join(','))}&k={{ $k }}`">
                    <i class="fas fa-print"></i> Print
                    <span x-transition x-text="checked.length ? `(${checked.length})` : 'Semua'"></span>
                </a>
            </div>
        </div>


        <table id="example" class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Kode Lot</th>
                    <th>Nama Barang / Bahan baku</th>
                    <th>Nama Produsen / No. Reg SBW</th>
                    <th>Tanggal Kedatangan</th>
                    <th>Kode Grading</th>
                    <th>No Box</th>
                    <th>pcs</th>
                    <th>gr</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $i)
                    @php
                        $sbw = DB::table('sbw_kotor')
                            ->leftJoin('grade_sbw_kotor', 'sbw_kotor.grade_id', '=', 'grade_sbw_kotor.id')
                            ->leftJoin('rumah_walet', 'sbw_kotor.rwb_id', '=', 'rumah_walet.id')
                            ->select('sbw_kotor.*', 'grade_sbw_kotor.nama', 'rumah_walet.nama as rumah_walet')
                            ->where('nm_partai', 'like', '%' . $i['nm_partai'] . '%')
                            ->first();
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $sbw->no_invoice }}</td>
                        <td>{{ $sbw->nama ?? '-' }}</td>
                        <td>{{ $sbw->rumah_walet ?? '-' }}</td>
                        <td>{{ tanggal($sbw->tgl) ?? '-' }}</td>
                        <td>{{ $i['nm_partai'] }}</td>
                        <td>{{ $i['kode_lot'] }}</td>
                        <td>{{ $i['pcs_awal'] }}</td>
                        <td>{{ $i['gr_awal'] }}</td>

                        <td>
                            <input type="hidden" name="checked" :value="JSON.stringify(checked)">
                            <input type="checkbox" class="form-check-input"
                                :value="'{{ $i['kode_lot'] }}:{{ 'sbw' }}'" x-model="checked"
                                :disabled="checked.length >= 9 && !checked.includes('{{ $i['kode_lot'] }}:{{ 'sbw' }}')">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
