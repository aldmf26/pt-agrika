<x-app-layout :title="$title">
    <div class="container mt-4" x-data="alpineFunc">
        <form action="" method="post">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label>Jenis SBW Kotor</label>
                                <input type="text" name="jenis" class="form-control" required placeholder="mixed">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>No Lot SBW</label>
                                <input type="text" placeholder="Tgl datang-nomor rumah walet" name="no_lot" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Tanggal Penerimaan</label>
                                <input type="date" name="tgl_penerimaan" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Alamat Rumah Walet</label>
                                <input type="text" name="alamat_rumah_walet" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>No Kendaraan</label>
                                <input type="text" name="no_kendaraan" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Pengemudi</label>
                                <input type="text" name="pengemudi" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Jumlah SBW Kotor (Kg)</label>
                                <input type="number" name="jumlah_gr" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Jumlah Pcs</label>
                                <input type="number" name="jumlah_pcs" class="form-control" required>
                            </div>
                        </div>
                    </div>
                  
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <tr>
                                    <th>No Reg Rumah Walet: </th>
                                    <td>
                                        <input type="text" name="noreg_rumah_walet" class="form-control"
                                            placeholder="tulis nomor rumah walet">
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
                                        $labels = ['Warna', 'Kondisi (bulu berat & ringan, bebas jamur)', 'Grade', 'Kadar air'];
                                        $inputNames = ['warna', 'kondisi', 'grade', 'kadar_air'];
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
                                                    value="diterima dengan Catatan (sortir)">
                                                <label for="ditolak" class="form-check-label">Diterima dengan Catatan (sortir)</label>
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
