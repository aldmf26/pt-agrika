<x-app-layout :title="$title">
    <div class="card">
        <div class="card-header">
            <button data-bs-toggle="modal" data-bs-target="#tambah" class="btn btn-primary float-end"><i
                    class="fas fa-plus"></i> add</button>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="example">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Retain sampel</th>
                        <th>Tanggal sampel</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $d)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $d->retain_sampel }}</td>
                            <td>{{ $d->tgl }}</td>
                            <td><a target="_blank"
                                    href="{{ route('qc.pemeriksaanretail.print', ['retain_sampel' => $d->retain_sampel, 'tgl' => $d->tgl]) }}"
                                    class="btn btn-sm btn-primary"><i class="fas fa-print"></i> print</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
    <form action="{{ route('qc.pemeriksaanretail.store') }}" method="POST">
        @csrf
        <x-modal_plus size="modal-xl" id="tambah">
            <div class="row" x-data="{ rows: [{ id: Date.now() }] }">
                <div class="col-lg-2">
                    <label for="">Retain sampel</label>
                    <input type="text" class="form-control" name="retain_sampel">
                </div>
                <div class="col-lg-2">
                    <label for="">Tanggal</label>
                    <input type="date" class="form-control" name="tgl">
                </div>
                <div class="col-lg-4">
                    <label for="">Standard kebutuhan sampel</label><br>

                    <label for="sampel6" class="me-2">
                        <input type="radio" name="standar_kebutuhan" id="sampel6" value="6"> 6
                    </label>

                    <label for="sampel12" class="me-2">
                        <input type="radio" name="standar_kebutuhan" id="sampel12" value="12"> 12
                    </label>

                    <label for="sampel18" class="me-2">
                        <input type="radio" name="standar_kebutuhan" id="sampel18" value="18"> 18
                    </label>

                    <label for="sampel24" class="me-2">
                        <input type="radio" name="standar_kebutuhan" id="sampel24" value="24"> 24
                    </label>
                </div>
                <div class="col-lg-12">
                    <hr>
                </div>
                <template x-for="(row, index) in rows" :key="row.id">
                    <div class="row mb-4">
                        <div class="col-lg-2">
                            <label for="">Production Date</label>
                            <input type="date" class="form-control" name="production_date[]">
                        </div>
                        <div class="col-lg-2">
                            <label for="">Expired Date</label>
                            <input type="date" class="form-control" name="expired_date[]">
                        </div>
                        <div class="col-lg-2">
                            <label for="">Warna (1 sd 4)</label> <br>
                            <label :for="`warna1_${index}`" class="me-2">
                                <input type="radio" :name="`warna_${index}`" :id="`warna1_${index}`" value="1"> 1
                            </label>
                            <label :for="`warna2_${index}`" class="me-2">
                                <input type="radio" :name="`warna_${index}`" :id="`warna2_${index}`" value="2"> 2
                            </label>
                            <label :for="`warna3_${index}`" class="me-2">
                                <input type="radio" :name="`warna_${index}`" :id="`warna3_${index}`" value="3"> 3
                            </label>
                            <label :for="`warna4_${index}`" class="me-2">
                                <input type="radio" :name="`warna_${index}`" :id="`warna4_${index}`" value="4">
                                4
                            </label>

                        </div>
                        <div class="col-lg-2">
                            <label for="">Bau (1 sd 4)</label> <br>
                            <label :for="`bau1_${index}`" class="me-2">
                                <input type="radio" :name="`bau_${index}`" :id="`bau1_${index}`" value="1">
                                1
                            </label>
                            <label :for="`bau2_${index}`" class="me-2">
                                <input type="radio" :name="`bau_${index}`" :id="`bau2_${index}`" value="2">
                                2
                            </label>
                            <label :for="`bau3_${index}`" class="me-2">
                                <input type="radio" :name="`bau_${index}`" :id="`bau3_${index}`" value="3">
                                3
                            </label>
                            <label :for="`bau4_${index}`" class="me-2">
                                <input type="radio" :name="`bau_${index}`" :id="`bau4_${index}`" value="4">
                                4
                            </label>

                        </div>
                        <div class="col-lg-2">
                            <label for="">Tekstur (1 sd 4)</label> <br>
                            <label :for="`tekstur1_${index}`" class="me-2">
                                <input type="radio" :name="`tekstur_${index}`" :id="`tekstur1_${index}`"
                                    value="1">
                                1
                            </label>
                            <label :for="`tekstur2_${index}`" class="me-2">
                                <input type="radio" :name="`tekstur_${index}`" :id="`tekstur2_${index}`"
                                    value="2">
                                2
                            </label>
                            <label :for="`tekstur3_${index}`" class="me-2">
                                <input type="radio" :name="`tekstur_${index}`" :id="`tekstur3_${index}`"
                                    value="3">
                                3
                            </label>
                            <label :for="`tekstur4_${index}`" class="me-2">
                                <input type="radio" :name="`tekstur_${index}`" :id="`tekstur4_${index}`"
                                    value="4">
                                4
                            </label>

                        </div>

                        <div class="col-lg-4 mt-2">
                            <label for="">Kandungan Nitrit (ppm)</label>
                            <input type="number" class="form-control" name="kandungan_nitrit[]">
                        </div>
                        <div class="col-lg-4 mt-2">
                            <label for="">Keterangan dan Tindakan Koreksi</label>
                            <input type="text" class="form-control" name="keterangan[]">
                        </div>
                        <div class="col-lg-1 d-flex align-items-end">
                            <button type="button" class="btn btn-danger" @click="rows.splice(index, 1)"
                                x-show="rows.length > 1">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                        <div class="col-lg-12">
                            <hr>
                        </div>
                    </div>
                </template>
                <div class="col-lg-12">
                    <button type="button" class="btn btn-primary mt-2 btn-block"
                        @click="rows.push({ id: Date.now() }); $nextTick()">
                        <i class="fas fa-plus"></i> Tambah Baris
                    </button>
                </div>


            </div>
        </x-modal_plus>
    </form>
</x-app-layout>
