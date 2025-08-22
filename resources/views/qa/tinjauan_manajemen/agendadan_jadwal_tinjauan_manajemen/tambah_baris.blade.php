<div class="row baris{{ $count }}">
    <div class="col-lg-11 mt-2">
        <textarea name="agenda[]" class="form-control" id="" cols="5" rows="2"></textarea>
    </div>
    {{-- <div class="col-lg-4 mt-2">
        <select name="pic[]" class="select-baris" required>
            <option value="">Pilih PIC</option>
            @foreach ($pegawai as $p)
                <option value="{{ $p->id }}">{{ ucfirst(strtolower($p->nama)) }}</option>
            @endforeach
        </select>
    </div> --}}
    <div class="col-lg-1">
        <button type="button" class="btn btn-danger mt-2 btn-block hapus-baris" baris="baris{{ $count }}"><i
                class="fas fa-trash"></i></button>
    </div>
</div>
