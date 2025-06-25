<x-app-layout :title="$title">
    <div class="container mt-4" x-data="alpineFunc">
        <form action="" method="post">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>No PO</label>
                                <select name="no_po" x-model="selectedPo" @change="updateItems" class="form-control">
                                    <option value="">Pilih No PO</option>
                                    @foreach ($po as $item)
                                        <option value="{{ $item->no_po }}">
                                            {{ $item->no_po }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <template x-for="(item, index) in items" :key="item.id">
                        <div class="row mt-4">
                            <h5 class=" p-2 text-start bg-info text-white">
                                <span x-text="(index + 1) + '. ' + item.nama"></span>
                                <span x-text="item.kode"></span>
                            </h5>
                            {{-- <div class="col-md-3">
                            <div class="form-group">
                                <label>Nama Barang</label>
                                <input type="text" name="nama_barang" class="form-control" placeholder="Nama Barang"
                                    required readonly>
                                @livewire('select2-barang', ['kategori' => 'kemasan'])
                            </div>
                        </div> --}}
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Tanggal Penerimaan</label>
                                    <input type="date" x-model="item.tgl_penerimaan" name="tgl_penerimaan[]"
                                        class="form-control" required>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Tanggal Expired</label>
                                    <input type="date" x-model="item.tgl_expired" name="tgl_expired[]"
                                        class="form-control" required readonly>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Kode Kemasan</label>
                                    <input type="text"
                                        :value="item.tgl_penerimaan.split('-')[2] + '-' + item.tgl_penerimaan.split(
                                                '-')[1] + '-' + item.tgl_penerimaan.split('-')[0] + '-' + item
                                            .kode + '-' + item.tgl_expired.split('-')[1] + '-' + item
                                            .tgl_expired.split('-')[0].slice(-2)"
                                        name="kode_lot[]" class="form-control" readonly>

                                </div>
                            </div>
                            <div class="col-md-3"></div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>No Kendaraan</label>
                                    <input type="text" name="no_kendaraan[]" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Pengemudi</label>
                                    <input type="text" name="pengemudi[]" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Jumlah Barang</label>
                                    <input :value="item.jumlah" type="number" name="jumlah_barang[]"
                                        class="form-control" required>
                                </div>
                            </div>
                            {{-- <div class="col-md-3">
                                <div class="form-group">
                                    <label>Jumlah Sampel</label>
                                    <input placeholder="berdasarkan standar Pengambilan Sampel" type="number"
                                        name="jumlah_sampel" class="form-control" required>
                                </div>
                            </div> 
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>KODE KEMASAN:</th>
                                        <td>
                                            <input type="text"
                                                :value="item.tgl_penerimaan.split('-')[2] + '-' + item.tgl_penerimaan.split(
                                                        '-')[1] + '-' + item.tgl_penerimaan.split('-')[0] + '-' + item
                                                    .kode + '-' + item.tgl_expired.split('-')[1] + '-' + item
                                                    .tgl_expired.split('-')[0].slice(-2)"
                                                name="items[x][kode_lot]" class="form-control">
                                        </td>
                                    </tr>
                                    {{-- <tr>
                                        <th>Kriteria Penerimaan</th>
                                        <td>
                                            <div class="form-group">
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label">1</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label">2</label>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        @php
                                            $checkLabel = "<i class='fas fa-check'></i>";
                                            $labels = [
                                                'Warna termasuk hasil print kemasan',
                                                'Kondisi Kemasan',
                                                'Ukuran Kemasan',
                                            ];
                                            $inputNames = ['warna', 'kondisi', 'ukuran'];
                                        @endphp
                                        @foreach ($labels as $index => $label)
                                    <tr>
                                        <th>{{ $label }}</th>
                                        <td>
                                            <div class="form-group">
                                                @for ($i = 1; $i <= 2; $i++)
                                                    <div class="form-check form-check-inline">
                                                        <input id="id{{ $i }}{{ $index }}"
                                                            class="form-check-input" type="checkbox"
                                                            name="{{ $inputNames[$index] }}[]"
                                                            value="{{ $i }}">
                                                        <label for="id{{ $i }}{{ $index }}"
                                                            class="form-check-label">{!! $checkLabel !!}</label>
                                                    </div>
                                                @endfor
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <th>Keputusan:</th>
                                        <td>
                                            <div class="form-group">
                                                <div class="form-check form-check-inline">
                                                    <input id="diterima" class="form-check-input" type="radio"
                                                        name="keputusan" value="Diterima">
                                                    <label for="diterima" class="form-check-label">Diterima</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input id="ditolak" class="form-check-input" type="radio"
                                                        name="keputusan" value="Ditolak">
                                                    <label for="ditolak" class="form-check-label">Ditolak</label>
                                                </div>

                                                <div class="form-check form-check-inline">
                                                    <input id="diterimacatatan" class="form-check-input" type="radio"
                                                        name="keputusan" value="Diterima dengan Catatan">
                                                    <label for="diterimacatatan" class="form-check-label">Diterima
                                                        dengan
                                                        Catatan</label>
                                                </div>
                                                <div class="form-check form-check-inline ms-2">
                                                    <input class="form-control form-control-sm" type="text"
                                                        name="keputusan_catatan" value=""
                                                        placeholder="catatan keputusan">
                                                </div>
                                            </div>
                                        </td>
                                    </tr> --}}
                            </table>
                        </div>
                </div>
                </template>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
    </div>
    </form>
    </div>
    @section('scripts')
        <script>
            $(document).ready(function() {
                // Delay the initialization slightly to ensure DOM is fully ready
                setTimeout(function() {
                    $('.select2suplier').select2();
                    $('.select2po').select2();
                }, 100);

                $('.select2po').change(function(e) {
                    e.preventDefault();
                    var ttl_produk = $('.select2po').find(':selected').data('ttl-produk');
                    $('#ttl_produk').text(ttl_produk);
                });
            });

            document.addEventListener('alpine:init', () => {
                Alpine.data('alpineFunc', () => ({
                    rows: [],
                    tgl: "{{ date('Y-m-d') }}",
                    tgl_penerimaan: "{{ date('Y-m-d') }}",
                    tgl_expired: new Date(new Date("{{ date('Y-m-d') }}").setFullYear(new Date(
                        "{{ date('Y-m-d') }}").getFullYear() + 2)).toISOString().slice(0, 10),
                    selectedPo: '',
                    items: [],
                    allPo: @json($po),
                    updateItems() {
                        const selected = this.allPo.find(po => po.no_po === this.selectedPo);
                        if (selected && selected.purchase_request?.item) {
                            this.items = selected.purchase_request.item.map(it => {
                                const today = new Date().toISOString().slice(0, 10);
                                const expired = new Date(new Date().setFullYear(new Date()
                                    .getFullYear() + 2)).toISOString().slice(0, 10);

                                return {
                                    id: it.id,
                                    nama: it.item_spesifikasi ?? 'Tidak ditemukan',
                                    kode: it.barang.kode_barang,
                                    jumlah: it.jumlah,
                                    tgl_penerimaan: today,
                                    tgl_expired: expired,
                                    no_kendaraan: '',
                                    pengemudi: '',
                                    jumlah_barang: '',
                                    jumlah_sampel: '',
                                    keputusan: '',
                                    keputusan_catatan: '',
                                };
                            });
                        } else {
                            this.items = [];
                        }
                    }

                }))
            })
        </script>
    @endsection
</x-app-layout>
