<x-app-layout :title="$title">
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
                <a x-show="checked.length" href="#" class="float-end btn btn-sm btn-primary"
                    @click.prevent="window.location.href = `/ppc/gudang-rm/5-label-identitas-bahan/print?checked=${encodeURIComponent(checked.join(','))}`">
                    <i class="fas fa-print"></i> Print
                    <span x-transition x-text="checked.length ? `(${checked.length})` : 'Semua'"></span>
                </a>
            </div>
        </div>

        <table id="example" class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Identitas</th>
                    <th>Nama Barang / Bahan baku</th>
                    <th>Nama Produsen / No. Reg SBW</th>
                    <th>Tanggal Kedatangan</th>
                    <th>Kode Lot</th>
                    <th>Kode Grading</th>
                    {{-- <th>Keterangan</th> --}}
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($items as $d)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ ucfirst($d['identitas']) }}</td>
                        <td>{{ $d['nama_barang'] }}</td>
                        <td>{{ $d['nama_produsen'] }}</td>
                        <td>{{ tanggal($d['tanggal_kedatangan']) }}</td>
                        <td>{{ $d['kode_lot'] }}</td>
                        <td>{{ $d['kode_grading'] }}</td>
                        <td>
                            <input type="hidden" name="checked" :value="JSON.stringify(checked)">
                            <input type="checkbox" class="form-check-input"
                                :value="'{{ $d['id'] }}:{{ $d['identitas'] }}'" x-model="checked"
                                :disabled="checked.length >= 6 && !checked.includes('{{ $d['id'] }}:{{ $d['identitas'] }}')">
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</x-app-layout>
