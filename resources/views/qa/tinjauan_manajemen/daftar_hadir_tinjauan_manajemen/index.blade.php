<x-app-layout :title="$title">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <form action="{{ route('qa.daftar_hadir_tinjauan_manajemen.print') }}" method="GET">
                        <div class="row">
                            <div class="col-lg-6">

                                <select name="" id="" class="form-control tgl">
                                    <option value="">Pilih Tanggal</option>
                                    @foreach ($agenda as $t)
                                        <option value="{{ $t->tanggal }}">{{ date('d-m-Y', strtotime($t->tanggal)) }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-primary float-end">Print</button>
                            </div>
                        </div>
                    </form>
                </div>
                <style>
                    #loading-spinner {
                        margin: 20px 0;
                    }
                </style>
                <div id="loading-spinner" style="display:none; text-align:center;">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <div class="card-body" style="display:none;">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Bagian</th>
                                <th class="text-center">Tanda Tangan</th>
                                <th class="text-center">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pegawai as $p)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $p->nama }}</td>
                                    <td class="text-center">{{ $p->posisi }}</td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @section('scripts')
        <script>
            $(document).ready(function() {
                $('.tgl').change(function() {
                    // Tampilkan loading spinner
                    $('#loading-spinner').show();
                    $('.card-body').hide();
                    // Delay sebentar sebelum menampilkan konten
                    setTimeout(function() {
                        $('#loading-spinner').hide(); // Sembunyikan loading
                        $('.card-body').show(); // Tampilkan konten
                    }, 1000); // 1000ms = 1 detik (bisa disesuaikan)
                });
            });
        </script>
    @endsection






</x-app-layout>
