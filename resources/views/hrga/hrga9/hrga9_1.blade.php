<x-app-layout title="{{ $title }}">
    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered ">
                    <thead>
                        <tr>
                            <th rowspan="2">#</th>
                            <th rowspan="2" class="nowrap">Nama Alat Ukur</th>
                            <th rowspan="2">Merek</th>
                            <th rowspan="2">Type / Nomor seri</th>
                            <th rowspan="2">Lokasi</th>
                            <th rowspan="2">Frekuensi kalibrasi</th>
                            <th rowspan="2">Rentang Min-Maks</th>
                            <th rowspan="2">Resolusi</th>
                            <th colspan="12" class="text-center">Tahun</th>
                        </tr>
                        <tr>
                            @foreach ($bulan as $b)
                                <th>{{ $b->nm_bulan }}</th>
                            @endforeach
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>
</x-app-layout>
