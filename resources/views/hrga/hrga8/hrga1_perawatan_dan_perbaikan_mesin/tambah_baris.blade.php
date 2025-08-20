<div class="row mb-2" baris="baris{{ $count }}">
    <div class="col-lg-3">
        <select class="form-control select2_baru" name="item_mesin_id[]">
            <option value="">Pilih mesin</option>
            @foreach ($item as $i)
                <option value="{{ $i->id }}">{{ $i->nama_mesin }} -
                    {{ $i->lokasi->lokasi }}

                </option>
            @endforeach
        </select>
    </div>
    <div class="col-lg-3">
        <input type="number" class="form-control" name="frekuensi_perawatan[]" min="1" max="12"
            value="1">
    </div>
    <div class="col-lg-2">
        <input type="text" class="form-control" name="penanggung_jawab[]">
    </div>
    <div class="col-lg-2">
        <input type="date" class="form-control" name="tanggal_mulai[]">
    </div>
    <div class="col-lg-1 d-flex align-items-end">
        <button class="btn btn-danger btn-sm hapus-baris" baris="baris{{ $count }}">-</button>
    </div>
</div>
