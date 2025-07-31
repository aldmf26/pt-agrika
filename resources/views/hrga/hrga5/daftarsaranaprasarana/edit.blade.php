<div class="row fw-bold mb-2">
    <div class="col-lg-3">Nama Sarana dan Prasarana</div>
    <div class="col-lg-2">No identifikasi</div>
    <div class="col-lg-2">Jumlah</div>
    <div class="col-lg-2">Lokasi</div>
    <div class="col-lg-2">Jenis</div>
</div>

<!-- Dynamic Rows -->

<div class="row mb-2">
    <div class="col-lg-3">
        <input type="hidden" class="form-control" name="id" value="{{ $item->id }}" required>
        <input type="text" class="form-control" name="nama_item" value="{{ $item->nama_item }}" required>
    </div>
    <div class="col-lg-2">
        <input type="text" class="form-control" name="no_identifikasi" value="{{ $item->no_identifikasi }}"
            placeholder="No identifikasi" required>
    </div>
    <div class="col-lg-2">
        <input type="text" class="form-control" name="jumlah" value="{{ $item->jumlah }}"
            placeholder="Jumlah : 2 ruangan" required>
    </div>
    <div class="col-lg-2">
        <select name="lokasi_id" class="select2_baru" id="">
            <option value="">Pilih Lokasi</option>
            @foreach ($lokasi as $lokasi)
                <option value="{{ $lokasi->id }}" @selected($item->lokasi_id == $lokasi->id)>{{ $lokasi->lokasi }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-lg-2">
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
    </style>

    <div class="col-lg-4 mt-2 ruangan {{ $item->jenis_item == 'ruangan' ? '' : 'hilang' }}">
        <label>Rincian Item</label>

    </div>
</div>
@foreach ($rincian as $r)
    <div class="col-lg-12 {{ $item->jenis_item == 'ruangan' ? '' : 'hilang' }}">
        <div class="row">

            <div class="col-lg-4 mt-2">
                <input type="hidden" name="rincian_id[]" value="{{ $r->id }}">
                <input type="text" class="form-control" name="rincian[]" value="{{ $r->nama_rincian }}"
                    placeholder="Rincian Item" required>

            </div>
        </div>
    </div>
@endforeach
<div x-data="itemForm()" class="row ruangan {{ $item->jenis_item == 'ruangan' ? '' : 'hilang' }}">
    <template x-for="(item, index) in items" :key="index">
        <div class="col-lg-12">
            <div class="row">

                <div class="col-lg-4 mt-2">

                    <input type="text" class="form-control" name="rincian[]" x-model="item.rincian">
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
