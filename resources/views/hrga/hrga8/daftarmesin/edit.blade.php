<div class="row fw-bold mb-2">
    <div class="col-lg-4">Nama Mesin</div>
    <div class="col-lg-4">Jumlah</div>
    <div class="col-lg-4">Lokasi</div>

</div>

<!-- Dynamic Rows -->

<div class="row mb-2">
    <div class="col-lg-4">
        <input type="hidden" class="form-control" name="id" value="{{ $item->id }}" required>
        <input type="text" class="form-control" name="nama_mesin" value="{{ $item->nama_mesin }}" required>
    </div>

    <div class="col-lg-4">
        <input type="text" class="form-control" name="jumlah" value="{{ $item->jumlah }}"
            placeholder="Jumlah : 2 ruangan" required>
    </div>
    <div class="col-lg-4">
        <select name="lokasi_id" class="select2_baru" id="">
            <option value="">Pilih Lokasi</option>
            @foreach ($lokasi as $lokasi)
                <option value="{{ $lokasi->id }}" @selected($item->lokasi_id == $lokasi->id)>{{ $lokasi->lokasi }}</option>
            @endforeach
        </select>
    </div>
    {{-- <div class="col-lg-2">
        <select name="jenis_item" class="select2_baru jenis" id="">
            <option value="">Pilih Jenis</option>
            <option value="ruangan" @selected($item->jenis_item == 'ruangan')>Ruangan</option>
            <option value="ac" @selected($item->jenis_item == 'ac')>Ac</option>
        </select>
    </div>
    <style>
        .hilang {
            display: none;
        }
    </style> --}}

    <div class="col-lg-4 mt-2 ">
        <label>Kriteria Pemeriksaaan</label>

    </div>
    <div class="col-lg-4 mt-2 ">
        <label>Metode</label>

    </div>
</div>
@foreach ($kriteria as $r)
    <div class="col-lg-12 ">
        <div class="row">

            <div class="col-lg-4 mt-2">
                <input type="hidden" name="kriteria_id[]" value="{{ $r->id }}">
                <input type="text" class="form-control" name="kriteria[]" value="{{ $r->kriteria }}"
                    placeholder="Rincian Item" required>

            </div>
            <div class="col-lg-4 mt-2">

                <input type="text" class="form-control" name="metode[]" value="{{ $r->metode }}"
                    placeholder="Metode" required>

            </div>
        </div>
    </div>
@endforeach
<div x-data="itemForm()" class="row ruangan ">
    <template x-for="(item, index) in items" :key="index">
        <div class="col-lg-12">
            <div class="row">

                <div class="col-lg-4 mt-2">

                    <input type="text" class="form-control" name="kriteria[]" x-model="item.rincian">
                </div>
                <div class="col-lg-4 mt-2">

                    <input type="text" class="form-control" name="metode[]" x-model="item.metode">
                </div>
                <div class="col-lg-4 mt-2">
                    <button type="button" class="btn btn-sm btn-danger" @click="items.splice(index, 1)">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </div>
            </div>
        </div>
    </template>

    <div class="col-lg-12 mt-2">
        <label>Aksi</label><br>
        <button type="button" class="btn btn-sm btn-success tambah-item" @click="addItem">
            <i class="fas fa-plus"></i> Tambah Item
        </button>
    </div>
</div>
