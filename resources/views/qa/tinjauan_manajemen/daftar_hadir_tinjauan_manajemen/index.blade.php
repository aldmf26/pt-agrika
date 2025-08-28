<x-app-layout :title="$title">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">

                </div>
                <div class="card-body">
                    <table id="example" class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center ">No</th>
                                <th class="text-nowrap ">Hari / Tanggal</th>
                                <th class="text-nowrap ">Waktu</th>
                                <th class="text-nowrap " width="60%">Agenda</th>
                                <th class="text-nowrap ">PIC</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($agenda as $a)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="text-nowrap">
                                        {{ tanggal($a->tanggal) }}</td>

                                    <td class="text-nowrap">{{ date('H:i', strtotime($a->dari_jam)) }} -
                                        {{ date('H:i', strtotime($a->sampai_jam)) }}</td>
                                    </td>
                                    <td>
                                        @foreach (explode('||', $a->agendas) as $i => $agenda)
                                            {{ $i + 1 }}. {{ $agenda }} <br>
                                        @endforeach
                                    </td>
                                    <td>{{ $a->pics }}</td>
                                    <td>
                                        <a href="{{ route('qa.daftar_hadir_tinjauan_manajemen.print', ['nota_agenda' => $a->nota_agenda, 'tanggal' => $a->tanggal]) }}"
                                            target="_blank" class="btn btn-sm btn-primary"><i
                                                class="fas fa-print"></i></a>

                                        {{-- <a href="{{ route('qa.daftar_hadir_tinjauan_manajemen.index', ['tanggal' => $d->tanggal]) }}"
                                            class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a> --}}
                                    </td>
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
