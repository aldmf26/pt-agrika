<x-app-layout :title="$title">
    <div class="container mt-4" x-data="alpineFunc">
        <form action="" method="post">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-2">
                            <div class="form-group">
                                <label for="">Hari/Tanggal</label>
                                <input type="date" name="tanggal_terima" value="{{ date('Y-m-d') }}"
                                    class="form-control" x-model="tgl">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-bordered">

                                <thead class="bg-info text-center align-middle">
                                    <tr>
                                        <th class="text-white" rowspan="2">No</th>
                                        <th class="text-white" rowspan="2">Nama dan Jenis Kode Produk (XXXX)</th>
                                        <th class="text-white" colspan="2">Jumlah</th>
                                        <th class="text-white" rowspan="2">No Batch/ <span style="font-size: 8px">
                                                Kode SBW kotor untuk Sarang Walet</span>
                                        </th>
                                        <th class="text-white" rowspan="2">Lot Produk Jadi</th>
                                        <th class="text-white" rowspan="2">Barcode</th>
                                        <th class="text-white" rowspan="2">Tanggal Produksi (YYMMDD)</th>
                                        <th class="text-white" rowspan="2">Status OK/Tidak</th>
                                        <th class="text-white" rowspan="2">Aksi</th>
                                    </tr>
                                    <tr>
                                        <th class="text-white">Serah</th>
                                        <th class="text-white">Diterima</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template x-for="(row, index) in rows">
                                        <tr>
                                            <td x-text="index + 1"></td>
                                            <td>
                                                <select x-select2 class="select2-alpine" name="id_produk[]"
                                                    style="width: 100%;">
                                                    <option value="">-- Pilih Item --</option>
                                                    @foreach ($produks as $p)
                                                        <option value="{{ $p->id }}">{{ $p->nama_produk }} |
                                                            {{ $p->satuan }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="serah[]"
                                                    placeholder="100 pack mika">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="terima[]"
                                                    placeholder="100 pack mika">
                                            </td>
                                            <td>
                                                <input class="form-control" type="text"
                                                    placeholder="tuliskan kode batch SBW kotor" name="nomor_batch[]">
                                            </td>
                                            <td>
                                                <input class="form-control" type="text" placeholder="lot produk jadi"
                                                    name="lot[]">

                                            </td>
                                            <td>
                                                <input class="form-control" type="text" placeholder="kode barcode"
                                                    name="barcode[]">

                                            </td>
                                            <td>
                                                <input class="form-control" type="date" name="tanggal_produksi[]">
                                            </td>
                                            <td>
                                                <select name="status[]" class="form-select">
                                                    <option value="ok">OK</option>
                                                    <option value="tidak">TIDAk</option>
                                                </select>
                                            </td>
                                            <td>
                                                <button type="button" class="btn-block btn btn-xs btn-danger"
                                                    @click="rows.splice(index, 1)"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    </template>
                                    <tr>
                                        <td colspan="10">
                                            <button type="button" class="btn-block btn btn-xs btn-primary"
                                                @click="rows.push('')"><i class="fas fa-plus"></i> Produk</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <h6>Barang diterima Warehouse FG/ Produk Jadi:</h6>
                            <div class="mb-3">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Nama Penerima</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td x-text="tgl">{{ date('Y-m-d') }}</td>
                                            <td>
                                                <input type="text" class="form-control" name="nama_penerima"
                                                    placeholder="Nama Penerima">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div class="col-6">
                            <h6>Penyerahan Barang oleh Warehouse FG/Produk Jadi:</h6>
                            <div class="mb-3">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Nama Penerima</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td x-text="tgl">{{ date('Y-m-d') }}</td>
                                            <td>
                                                <input type="text" class="form-control" name="nama_penyerah"
                                                    placeholder="Nama Penerima">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex justify-content-evenly">
                                <h6 class="text-center">Diterima Warehouse FG/Produk Jadi</h6>
                                <h6 class="text-center">Diserahterimakan Produksi</h6>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="">Nama Ttd</label>
                                        <input type="text" class="form-control" name="nama_ttd"
                                            placeholder="Nama Penerima ttd">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Tanggal : </label>
                                        <label x-text="tgl" for="">{{ date('Y-m-d') }}</label>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="float-end btn btn-primary">Simpan</button>
                        </div>
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
    @endsection
</x-app-layout>
