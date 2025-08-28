<x-app-layout :title="$title" :container="'container-fluid'">
    <form action="{{ route('qa.kesigapan.1.update') }}" method="post">
        @csrf

        <div class="row">
            <div class="col-3">
                <div class="form-group">
                    <label for="">Tanggal</label>
                    <input type="date" name="tgl" value="{{ $kesigapan->tgl }}" class="form-control">
                    <input type="hidden" name="id" value="{{ $kesigapan->id }}" class="form-control">
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="">Jenis Insiden</label>
                    <input type="text" name="jenis_insiden" placeholder="jenis insiden"
                        value="{{ $kesigapan->jenis_insiden }}" class="form-control">
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="">Lokasi</label>
                    <select name="lokasi1" class="form-control  select2">
                        <option value="Seluruh Area Perusahaan" @selected($kesigapan->lokasi == 'Seluruh Area Perusahaan')>Seluruh Area Perusahaan
                        </option>
                        @foreach ($lokasi as $d)
                            <option value="{{ $d->lokasi }}" @selected($kesigapan->lokasi == $d->lokasi)>
                                {{ $d->lokasi }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="">Penyebab</label>
                    <input type="text" name="penyebab" placeholder="Penyebab" class="form-control"
                        value="{{ $kesigapan->penyebab }}">
                </div>
            </div>
            <div class="col-3  mt-2">
                <div class="form-group">
                    <label for="">Akibat</label>
                    <input type="text" name="akibat" placeholder="Akibat" class="form-control"
                        value="{{ $kesigapan->akibat }}">
                </div>
            </div>
            <div class="col-3  mt-2">
                <div class="form-group">
                    <label for="">Dari Jam </label>
                    <input type="time" name="dari_jam" class="form-control" value="{{ $kesigapan->dari_jam }}">
                </div>
            </div>
            <div class="col-3  mt-2">
                <div class="form-group">
                    <label for="">Sampai Jam </label>
                    <input type="time" name="sampai_jam" class="form-control" value="{{ $kesigapan->sampai_jam }}">
                </div>
            </div>
            <div class="col-3  mt-2">
                <div class="form-group">
                    <label for="">Keterangan </label>
                    <select name="kejadian" id="" class="form-control">
                        <option value="">Pilih Keterangan</option>
                        <option value="disengaja" @selected($kesigapan->kejadian == 'disengaja')>Disengaja</option>
                        <option value="tidak disengaja" @selected($kesigapan->kejadian == 'tidak disengaja')>Tidak Disengaja</option>
                    </select>
                </div>
            </div>


        </div>
        <div class="row">


            <div class="col-12" x-data="{
                rows: {{ Js::from($detail) }}.length > 0 ? {{ Js::from($detail) }} : [{}]
            }">
                <label for="">Detail Perlokasi</label>
                <table class="table table-bordered">
                    <thead class="bg-info">
                        <tr>
                            <th class="text-white" rowspan="2">Lokasi</th>
                            <th class="text-white text-center" colspan="2">Korban</th>
                            <th class="text-white text-center" colspan="2">Kerugian Material</th>
                            <th class="text-white" rowspan="2">Potensi Bahaya Pada Produk</th>
                            <th class="text-white" rowspan="2">Tindakan <br> Pengendalian</th>
                            <th class="text-white" rowspan="2" width="100px">PIC</th>
                            <th class="text-white" rowspan="2">Aksi</th>
                        </tr>
                        <tr>
                            <th class="text-white">Cedera</th>
                            <th class="text-white">Meninggal</th>
                            <th class="text-white">Infrastruktur</th>
                            <th class="text-white">Produk</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template x-for="(row, index) in rows" :key="index">
                            <tr>
                                <td>
                                    <select name="lokasi2[]" class="select2" x-model="row.lokasi">
                                        <option value="">Lokasi</option>
                                        @foreach ($lokasi as $l)
                                            <option value="{{ $l->lokasi }}">{{ $l->lokasi }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select name="cedera[]" class="select2" x-model="row.cedera">
                                        <option value="Tidak Ada">Tidak Ada</option>
                                        <option value="Ada">Ada</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="meninggal[]" class="select2" x-model="row.meninggal">
                                        <option value="Tidak Ada">Tidak Ada</option>
                                        <option value="Ada">Ada</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="infrastruktur[]" class="select2" x-model="row.infrastruktur">
                                        <option value="Tidak Ada">Tidak Ada</option>
                                        <option value="Ada">Ada</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="produk[]" class="select2" x-model="row.produk">
                                        <option value="Tidak Ada">Tidak Ada</option>
                                        <option value="Ada">Ada</option>
                                    </select>
                                </td>
                                <td>
                                    <textarea name="potensi_bahaya[]" cols="5" rows="2" class="form-control" x-text="row.potensi_bahaya"></textarea>
                                </td>
                                <td>
                                    <textarea name="tindakan[]" cols="5" rows="2" class="form-control" x-text="row.tindakan"></textarea>
                                </td>
                                <td>
                                    <input type="text" name="pic[]" class="form-control" x-model="row.pic">
                                </td>
                                <td>
                                    <span @click="rows.splice(index, 1); $nextTick(() => initSelect2())"
                                        class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></span>
                                </td>
                            </tr>
                        </template>
                        <tr>
                            <td colspan="9">
                                <button type="button" class="btn btn-xs btn-info text-white btn-block"
                                    @click="rows.push({}); $nextTick(() => initSelect2())">
                                    <i class="fas fa-plus"></i> Baris
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
        <button type="submit" class="btn btn-sm btn-primary float-end">Save</button>
    </form>

    @section('scripts')
        <script>
            function initSelect2() {
                $('.select2').select2();
            }

            $(document).ready(function() {
                initSelect2();

                $('.dimintaoleh').change(function() {
                    var divisi = $(this).find(':selected').data('divisi');
                    $('#posisi').val(divisi);
                });

                $('.kategori').change(function() {
                    var kategori = $(this).val();
                    var url = new URL(window.location.href);
                    url.searchParams.set('kategori', kategori);
                    window.location.href = url.href;
                });
            });
        </script>
    @endsection
</x-app-layout>
