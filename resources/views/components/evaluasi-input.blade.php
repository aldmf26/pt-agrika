@props(['evaluasi', 'kriteria'])

@if (!empty($evaluasi->detail))
    @foreach ($evaluasi->detail as $detail)
        @if ($detail->jenis_kriteria == $kriteria && $detail->alasan != null)
            <div class="row" id="evaluasi_{{ $kriteria }}_{{ $detail->id }}">
                <div class="col-2">
                    <div class="form-group">
                        <label for="tanggal">Tanggal:</label>
                        <input value="{{ $detail->tanggal_ketidaksesuaian }}" type="date" id="tanggal"
                            name="{{ $kriteria }}_tanggal[]" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <label for="jumlah">Karena</label>
                        <input value="{{ $detail->alasan }}" type="text" id="karena"
                            name="{{ $kriteria }}_karena[]" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <label for="jumlah">Hasil Penilaian</label>
                        <input placeholder="Contoh: 90" value="{{ $detail->penilaian }}" type="text" id="karena"
                            name="{{ $kriteria }}_penilaian[]" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <label for="jumlah">Aksi</label><br>
                        <button type="button" class="btn btn-xs btn-danger hapusBaris"
                            data-kriteria="{{ $kriteria }}" data-row="{{ $detail->id }}"><i
                                class="fas fa-trash"></i></button>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
@endif

@section('scripts')
    <script>
        $(document).ready(function() {
            $('.hapusBaris').click(function() {
                var kriteria = $(this).attr('data-kriteria');
                var id = $(this).attr('data-row');
                $('#evaluasi_' + kriteria + '_' + id).remove();
            })
        });
    </script>
@endsection
