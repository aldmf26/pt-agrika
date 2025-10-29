<x-app-layout :title="$title">
    <div class="container mt-4" x-data="alpineFunc">
        <form action="" method="post">
            @csrf
            <div class="card">
                <input type="hidden" name="kategori" value="{{ $kategori }}">
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
                                <span x-text="'#' + item.kode"></span>
                            </h5>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Tanggal Penerimaan</label>
                                    <input type="date" @change="updateExpiredDate(index)"
                                        x-model="item.tgl_penerimaan" name="tgl_penerimaan[]" class="form-control"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Tanggal Expired</label>
                                    <input type="date" x-model="item.tgl_expired" name="tgl_expired[]"
                                        class="form-control" required>

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
                                    <input type="text" name="no_kendaraan[]" x-model="item.no_kendaraan"
                                        class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Pengemudi</label>
                                    <input type="text" name="pengemudi[]" x-model="item.pengemudi"
                                        class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Jumlah Barang</label>
                                    <input :value="item.jumlah" type="number" name="jumlah_barang[]"
                                        class="form-control" required>
                                    <input type="hidden" name="id_barang[]" :value="item.id_barang">
                                </div>
                            </div>
                            </table>
                        </div>
                </div>
                </template>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Save</button>
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

                    selectedPo: '',
                    items: [],
                    allPo: @json($po),
                    updateItems() {
                        const selected = this.allPo.find(po => po.no_po === this.selectedPo);
                        console.log(selected);
                        if (selected && selected.purchase_request?.item) {
                            this.items = selected.purchase_request.item.map(it => {
                                const tglPenerimaan = it.tgl_dibutuhkan || new Date().toISOString()
                                    .slice(0, 10);
                                // Menghitung expired 2 tahun dari tgl_dibutuhkan
                                const expiredDate = new Date(it.tgl_dibutuhkan || new Date());
                                expiredDate.setFullYear(expiredDate.getFullYear() + 2);
                                const expired = expiredDate.toISOString().slice(0, 10);

                                return {
                                    id: it.id,
                                    nama: it.item_spesifikasi ?? 'Tidak ditemukan',
                                    kode: it.barang?.kode_barang ?? 'Tidak ditemukan',
                                    id_barang: it.barang?.id ?? null,
                                    jumlah: it.jumlah,
                                    tgl_penerimaan: tglPenerimaan,
                                    tgl_expired: expired,
                                    no_kendaraan: '-',
                                    pengemudi: '-',
                                    jumlah_barang: '',
                                    jumlah_sampel: '',
                                    keputusan: '',
                                    keputusan_catatan: '',
                                };
                            });
                        } else {
                            this.items = [];
                        }
                    },
                    updateExpiredDate(index) {
                        const item = this.items[index];
                        if (item.tgl_penerimaan) {
                            const expiredDate = new Date(item.tgl_penerimaan);
                            expiredDate.setFullYear(expiredDate.getFullYear() + 2);
                            item.tgl_expired = expiredDate.toISOString().slice(0, 10);
                        }
                    }

                }))
            })
        </script>
    @endsection
</x-app-layout>
