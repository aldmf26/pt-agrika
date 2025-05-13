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

                                @livewire('select2-barang', ['kategori' => 'kemasan'])

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
                                <input placeholder="berdasarkan standar Pengambilan Sampel" type="number"
                                    name="jumlah_sampel" class="form-control" required>
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
                                                <input id="diterima" class="form-check-input" type="radio"
                                                    name="keputusan" value="Diterima">
                                                <label for="diterima" class="form-check-label">Diterima</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input id="ditolak" class="form-check-input" type="radio"
                                                    name="keputusan" value="Ditolak">
                                                <label for="ditolak" class="form-check-label">Ditolak</label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
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
       
    @endsection
</x-app-layout>
