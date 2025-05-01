<x-app-layout :title="$title">
    <div class="container mt-4" x-data="alpineFunc">
        <form action="" method="post">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row mt-4">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Nama Barang</label>
                                <select class="select2suplier" name="id_barang">
                                    <option value="">-- Pilih Item --</option>
                                    @foreach ($barangs as $p)
                                        <option value="{{ $p->id }}" data-kode="{{ $p->kode_barang }}">
                                            {{ $p->nama_barang }} |
                                            {{ $p->kode_bahan_baku->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Tanggal Penerimaan</label>
                                <input type="date" name="tgl_penerimaan" class="form-control"
                                    value="{{ date('Y-m-d') }}" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Tanggal Expired</label>
                                <input type="date" name="tgl_expired" class="form-control"
                                    value="{{ date('Y-m-d') }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>No Kendaraan</label>
                                <input type="text" name="no_kendaraan" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Pengemudi</label>
                                <input type="text" name="pengemudi" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Jumlah Barang</label>
                                <input type="number" name="jumlah_barang" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Jumlah Sampel</label>
                                <input placeholder="berdasarkan standar Pengambilan Sampel" type="number" name="jumlah_sampel" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <tr>
                                    <th>KODE LOT:</th>
                                    <td>
                                        <input type="text" name="kode_lot" class="form-control"
                                            placeholder="kode lot">
                                    </td>
                                </tr>
                                <tr>
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
                                        $labels = ['Warna termasuk hasil print kemasan', 'Kondisi Kemasan', 'Ukuran Kemasan'];
                                        $inputNames = ['warna', 'kondisi', 'ukuran'];
                                    @endphp
                                    @foreach ($labels as $index => $label)
                                    <tr>
                                        <th>{{ $label }}</th>
                                        <td>
                                            <div class="form-group">
                                                @for ($i = 1; $i <= 2; $i++)
                                                    <div class="form-check form-check-inline">
                                                        <input id="id{{ $i }}{{ $index }}" class="form-check-input" type="checkbox"
                                                            name="{{ $inputNames[$index] }}[]" value="{{ $i }}">
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
                                                <input id="diterima" class="form-check-input" type="radio" name="keputusan"
                                                    value="Diterima">
                                                <label for="diterima" class="form-check-label">Diterima</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input id="ditolak" class="form-check-input" type="radio" name="keputusan"
                                                    value="Ditolak">
                                                <label for="ditolak" class="form-check-label">Ditolak</label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary" >Simpan</button>
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
            }, 100);
        });
    </script>
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('alpineFunc', () => ({
                    rows: [],
                    tgl: "{{ date('Y-m-d') }}"
                }))
            })
        </script>
        <script>
           
            function updateKodeLot() {
                var kode_barang = $('.select2suplier').find(':selected').data('kode') || '';
                var tgl_kedatangan = $('input[name="tgl_penerimaan"]').val();
                var tgl_expired = $('input[name="tgl_expired"]').val();

                if (tgl_kedatangan && tgl_expired && kode_barang) {
                    var kedatangan_parts = tgl_kedatangan.split('-');
                    var kd_tgl = kedatangan_parts[2];
                    var kd_bulan = kedatangan_parts[1];
                    var kd_tahun = kedatangan_parts[0];

                    var expired_parts = tgl_expired.split('-');
                    
                    var exp_bulan = expired_parts[1];
                    var exp_tahun = expired_parts[0];

                    var kode_lot = `${kd_tgl}${kd_bulan}${kd_tahun}${kode_barang}${exp_bulan}${exp_tahun}`;
                    $("input[name=kode_lot]").val(kode_lot);
                }
            }

            // Event listener untuk semua elemen yang mempengaruhi kode lot
            $('.select2suplier, input[name="tgl_penerimaan"], input[name="tgl_expired"]').change(updateKodeLot);

            // Panggil fungsi sekali saat halaman dimuat (jika ada data default)
            $(document).ready(updateKodeLot);
        </script>
    @endsection
</x-app-layout>
