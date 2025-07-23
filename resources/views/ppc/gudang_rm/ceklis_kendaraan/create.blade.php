<x-app-layout :title="$title">
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4>Form Pemeriksaan Kendaraan</h4>
                <span>BERI TANDA V UNTUK TIAP KOLOM YANG SESUAI STANDARD DAN TANDA X UNTUK TIAP KOLOM YANG TIDAK SESUAI
                    STANDAR</span>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="date" name="tanggal" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Jam Kedatangan</label>
                                <input type="time" name="jam_datang" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nomor Kendaraan</label>
                                <input type="text" name="nomor_kendaraan" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Jenis Kendaraan</label>
                                <select name="jenis_kendaraan" class="form-control" required>
                                    <option value="Internal">Internal</option>
                                    <option value="Ekspedisi">Ekspedisi</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nama Ekspedisi</label>
                                <input type="text" name="ekspedisi" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Pengemudi</label>
                                <input type="text" name="pengemudi" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Noreg Rumah Walet</label>
                                <select class="select2suplier" name="noreg_rumah_walet">
                                    <option value="">-- Pilih No reg --</option>
                                    @foreach ($penerimaan as $p)
                                        <option value="{{ $p->noreg_rumah_walet }}">{{ $p->noreg_rumah_walet }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="table-responsive mt-4">
                        <table class="table table-bordered">
                            <thead class="bg-light">
                                <tr>
                                    <th>No</th>
                                    <th>Kondisi Kendaraan</th>
                                    <th width="100">WH</th>
                                    <th width="100">QA</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kondisi as $item)
                                    <tr>
                                        <td>{{ $item->nomor }}</td>
                                        <td>
                                            {{ $item->kondisi }}
                                            <input type="hidden" name="nomor_kondisi[]" value="{{ $item->id }}">
                                        </td>
                                        <td class="text-center">
                                            <select name="check_wh[]" class="form-control">
                                                <option value="">-</option>
                                                <option value="V">V</option>
                                                <option value="X">X</option>
                                            </select>
                                        </td>
                                        <td class="text-center">
                                            <select name="check_qa[]" class="form-control">
                                                <option value="">-</option>
                                                <option value="V">V</option>
                                                <option value="X">X</option>
                                            </select>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Keputusan</label>
                                <select name="keputusan" class="form-control" required>
                                    <option value="">Pilih</option>
                                    <option value="Y">Ya (Y)</option>
                                    <option value="T">Tidak (T)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Pemeriksa</label>
                                <input type="text" name="pemeriksa" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <label>Komentar</label>
                        <textarea name="komentar" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="mt-4 float-end">
                        <a href="{{ route('ppc.gudang-fg.2.index') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
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
    @endsection
</x-app-layout>
