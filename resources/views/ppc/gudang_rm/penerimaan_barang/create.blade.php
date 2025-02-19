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
                                        <option value="{{ $p->id }}">{{ $p->nama_barang }} |
                                            {{ $p->kode_barang }}</option>
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
                                <label>Supplier</label>
                                <select class="select2suplier" name="id_suplier">
                                    <option value="">-- Pilih Item --</option>
                                    @foreach ($supliers as $p)
                                        <option value="{{ $p->id }}">{{ $p->nama_supplier }}</option>
                                    @endforeach
                                </select>
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
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label">3</label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    @php
                                        $checkLabel = "<i class='fas fa-check'></i>";
                                    @endphp
                                    <th>Quantity (jumlah)</th>
                                    <td>
                                        <div class="form-group">
                                            <div class="form-check form-check-inline">
                                                <input id="id1" class="form-check-input" type="checkbox"
                                                    name="quantity[]" value="1">
                                                <label for="id1"
                                                    class="form-check-label">{!! $checkLabel !!}</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input id="id2" class="form-check-input" type="checkbox"
                                                    name="quantity[]" value="2">
                                                <label for="id2"
                                                    class="form-check-label">{!! $checkLabel !!}</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input id="id3" class="form-check-input" type="checkbox"
                                                    name="quantity[]" value="3">
                                                <label for="id3"
                                                    class="form-check-label">{!! $checkLabel !!}</label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Visual (kebersihan)</th>
                                    <td>
                                        <div class="form-group">
                                            <div class="form-check form-check-inline">
                                                <input id="idd1" class="form-check-input" type="checkbox"
                                                    name="visual[]" value="1">
                                                <label for="idd1"
                                                    class="form-check-label">{!! $checkLabel !!}</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input id="idd2" class="form-check-input" type="checkbox"
                                                    name="visual[]" value="2">
                                                <label for="idd2"
                                                    class="form-check-label">{!! $checkLabel !!}</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input id="idd3" class="form-check-input" type="checkbox"
                                                    name="visual[]" value="3">
                                                <label for="idd3"
                                                    class="form-check-label">{!! $checkLabel !!}</label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
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
                                                <input id="diterimacatatan" class="form-check-input" type="radio" name="keputusan"
                                                    value="Diterima dengan Catatan (sortir)">
                                                <label for="diterimacatatan" class="form-check-label">Diterima dengan Catatan
                                                    (sortir)</label>
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
            document.addEventListener('alpine:init', () => {
                Alpine.data('alpineFunc', () => ({
                    rows: [],
                    tgl: "{{ date('Y-m-d') }}"
                }))
            })
        </script>
        <script>
            $(document).ready(function() {

                $('.select2suplier').select2({})
            });
        </script>
    @endsection
</x-app-layout>
