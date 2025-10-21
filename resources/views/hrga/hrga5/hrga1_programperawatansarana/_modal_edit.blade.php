<div class="modal fade" id="editModal{{ $p->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $p->id }}"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('hrga5.1.update', $p->id) }}" method="POST">
                @csrf

                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title" id="editModalLabel{{ $p->id }}">Edit Program Perawatan</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label for="item_id{{ $p->id }}" class="form-label">Item</label>
                            <select name="item_id" id="item_id{{ $p->id }}" class=" select5" required>
                                @foreach ($items as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $item->id == $p->item_id ? 'selected' : '' }}>
                                        {{ $item->nama_item }} - {{ $item->no_identifikasi }} -
                                        {{ $item->lokasi->lokasi ?? '-' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="frekuensi{{ $p->id }}" class="form-label">Frekuensi Perawatan
                                (bulan)</label>
                            <input type="number" name="frekuensi_perawatan" id="frekuensi{{ $p->id }}"
                                class="form-control" value="{{ $p->frekuensi_perawatan }}" required>
                        </div>

                        <div class="col-md-6">
                            <label for="penanggung{{ $p->id }}" class="form-label">Penanggung Jawab</label>
                            <input type="text" name="penanggung_jawab" id="penanggung{{ $p->id }}"
                                class="form-control" value="{{ $p->penanggung_jawab }}" required>
                        </div>

                        <div class="col-md-6">
                            <label for="tanggal{{ $p->id }}" class="form-label">Tanggal Mulai</label>
                            <input type="date" name="tanggal_mulai" id="tanggal{{ $p->id }}"
                                class="form-control" value="{{ $p->tanggal_mulai }}" required>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning text-white">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

@section('scripts')
    <script>
        $('.modal').on('shown.bs.modal', function() {
            $(this).find('.select5').select2({
                dropdownParent: $(this),
                width: '100%'
            });
        });
    </script>
@endsection
