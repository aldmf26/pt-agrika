<x-app-layout :title="$title">
    <div class="container mt-4" x-data="alpineFunc">
        <form action="" method="post">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row mt-4">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Identitas</label>
                                <select x-model="identitas" class="form-control" name="identitas">
                                    <option value="">-- Pilih Identitas --</option>

                                    @foreach ($identitas as $p)
                                        <option value="{{ $p->nama }}">Bahan
                                            {{ ucwords($p->nama) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <table class="table table-bordered" id="tableScroll">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Nama Barang</th>
                                        <th class="text-center">Kode Barang</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody">
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($penerimaan as $d)
                                        <tr>
                                            <td>{{ $no }}</td>
                                            <td>{{ $d->barang->nama_barang }}</td>
                                            <td>{{ $d->kode_lot }}</td>
                                            <td class="text-center">
                                                <input x-model="barangChecked" class="form-check-input" type="checkbox"
                                                    value="{{ $d->kode_lot }}" id="cek-{{ $d->kode_lot }}">
                                                <label class="form-check-label" for="cek-{{ $d->kode_lot }}">
                                                </label>
                                            </td>
                                        </tr>
                                        @php
                                            $no++;
                                        @endphp
                                    @endforeach
                                    @foreach ($penerimaanBarang as $d)
                                        <tr>
                                            <td>{{ $no }}</td>
                                            <td>{{ $d->barang->nama_barang }}</td>
                                            <td>{{ $d->kode_lot }}</td>
                                            <td class="text-center">
                                                <input x-model="barangChecked" class="form-check-input" type="checkbox"
                                                    value="{{ $d->kode_lot }}" id="cek-{{ $d->kode_lot }}">
                                                <label class="form-check-label" for="cek-{{ $d->kode_lot }}">
                                                </label>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <input type="hidden" x-model="barangChecked" name="barangChecked">
                            <button type="submit" class="btn btn-primary float-end">Simpan</button>
                        </div>

                    </div>

                    {{-- <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nama Barang</label>
                                <select class="select2suplier selectBarang" name="id_barang">
                                    <option value="">-- Pilih Item --</option>
                                    @foreach ($barangs as $p)
                                        <option data-supplier="{{ $p->supplier->nama_supplier }}"
                                            data-kode="{{ $p->kode_barang }}" value="{{ $p->id }}">
                                            {{ $p->kode_barang }} |
                                            {{ $p->nama_barang }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">

                            <div x-show="identitas == 'baku sbw'" class="form-group">
                                <label>No. Reg SBW</label>
                                <select class="select2suplier" name="noregrbw">
                                    <option value="">-- Pilih No reg --</option>
                                    @foreach ($penerimaan as $p)
                                        <option value="{{ $p->noreg_rumah_walet }}">{{ $p->noreg_rumah_walet }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div x-show="identitas !== 'baku sbw'" class="form-group">
                                <label>Nama Produsen</label>
                                <input class="form-control" type="text" placeholder="nama produsen"
                                    name="nmprodusen">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="">Tanggal Kedatangan</label>
                                    <input type="date" value="{{ date('Y-m-d') }}" name="tgl_kedatangan"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="">Kode Lot</label>
                                    <input readonly type="text" name="no_lot" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="">Kode Grading/Bahan</label>
                                    <input readonly type="text" name="kode_grading" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="">Keterangan</label>
                                    <input type="text" name="keterangan" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    <div class="text-end">
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
                    identitas: "kemas",
                    barangChecked: [],
                }))
            })
        </script>
        <script>
            $(document).ready(function() {

                $('.selectBarang').change(function(e) {
                    e.preventDefault();

                    var kode = $(this).find(':selected').data('kode');
                    var no_lot = $(this).find(':selected').data('no_lot');
                    var supplier = $(this).find(':selected').data('supplier');

                    $("input[name=no_lot]").val(no_lot);
                    $("input[name=kode_grading]").val(kode);
                    $("input[name=nmprodusen]").val(supplier);
                });
            });
        </script>
    @endsection
</x-app-layout>
