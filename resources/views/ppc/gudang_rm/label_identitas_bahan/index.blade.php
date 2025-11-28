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
                    <th>Identitas</th>
                    <th>Kode Lot</th>
                    <th>Nama Barang / Bahan baku</th>
                    <th>Nama Produsen / No. Reg SBW</th>
                    <th>Tanggal Kedatangan</th>
                    <th>Kode Grading</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                {{-- @forelse ($kemasan as $k)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>Kemasan</td>
                        <td>{{ $k->kode_lot }}</td>
                        <td>{{ $k->barang->nama_barang }}</td>
                        <td>{{ $k->supplier->nama_supplier }}</td>
                        <td>{{ tanggal($k->tanggal_penerimaan) }}</td>
                        <td>-</td>
                        <td>
                            <input type="hidden" name="checked" :value="JSON.stringify(checked)">
                            <input type="checkbox" class="form-check-input" :value="'{{ $k['id'] }}:kemasan'"
                                x-model="checked"
                                :disabled="checked.length >= 6 && !checked.includes('{{ $k['id'] }}:kemasan')">
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="8" class="text-center">Tidak ada data kemasan</td>
                    </tr>
                @endforelse --}}
                @forelse ($items as $d)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ ucfirst($d['identitas']) }}</td>
                        <td>{{ $d['kode_lot'] }}</td>
                        <td>{{ $d['nama_barang'] }}</td>
                        <td>{{ $d['nama_produsen'] }}</td>
                        <td>{{ tanggal($d['tanggal_kedatangan']) }}</td>
                        <td>{{ $d['kode_grading'] }}</td>
                        <td>{{ $d['keterangan'] }}</td>
                        <td>
                            <input type="hidden" name="checked" :value="JSON.stringify(checked)">
                            <input type="checkbox" class="form-check-input"
                                :value="'{{ $d['kode_lot'] }}:{{ $d['identitas'] }}'" x-model="checked"
                                :disabled="checked.length >= 9 && !checked.includes('{{ $d['kode_lot'] }}:{{ $d['identitas'] }}')">
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">Tidak ada data label identitas bahan</td>
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>
</x-app-layout>
