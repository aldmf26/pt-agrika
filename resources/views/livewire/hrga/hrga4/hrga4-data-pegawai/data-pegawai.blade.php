<div>
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <div class="d-flex gap-1 justify-content-end">
        <button class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Data</button>
        <button wire:click="print" class="btn btn-sm btn-primary"><i class="fas fa-print"></i> Print
            {{ !empty($cekPegawai) ? '(' . count($cekPegawai) . ')' : 'Semua' }}</button>
    </div>

    <x-wire-table :datas="$datas">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="">No</th>
                    <th class="pointer" wire:click='sortBy("divisi_id")'>Divisi / Dept <i
                            class="fas fa-sort float-end"></i></th>
                    <th class="pointer" wire:click='sortBy("nik")'>Nik <i class="fas fa-sort float-end"></i></th>
                    <th class="pointer" wire:click='sortBy("nama")'>Nama <i class="fas fa-sort float-end"></i></th>
                    <th class="">Jenis Kelamin/ <br>Tgl lahir</th>
                    <th class="">Status</th>
                    <th class="pointer" wire:click='sortBy("tgl_masuk")'>Tgl Masuk <i class="fas fa-sort float-end"></i>
                    </th>
                    <th class="">Berhenti</th>
                    <th class="pointer" wire:click='sortBy("posisi")'>Posisi <i class="fas fa-sort float-end"></i></th>
                    <th class="text-center">Ttd</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            @foreach ($datas as $i => $d)
                <tbody>
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $d->divisi->divisi ?? '' }}</td>
                        <td>{{ $d->nik }}</td>
                        <td>{{ $d->nama }}</td>
                        <td>{{ $d->jenis_kelamin }} / {{ $d->tgl_lahir }}</td>
                        <td>{{ $d->status }}</td>
                        <td>
                            {{ $d->tgl_masuk == null ? '-' : $d->tgl_masuk }}
                            @if ($d->tgl_masuk != null)
                                ({{ $lamaKerja = (int) \Carbon\Carbon::parse($d->tgl_masuk)->diffInYears(now()) }}
                                tahun
                                {{ $lamaKerja2 = (int) \Carbon\Carbon::parse($d->tgl_masuk)->diffInMonths(now()) % 12 }}
                                bulan)
                            @endif
                        </td>
                        <td>{{ $d->deleted_at == null ? '-' : tanggal($d->deleted_at) }}</td>
                        <td>{{ $d->posisi }}</td>
                        <td>
                            <x-ttd-barcode :id_pegawai="$d->id" />
                        </td>
                        <td align="center">
                            <input wire:key="checkbox-{{ $d->id }}-{{ $datas->currentPage() }}"
                                class="pointer form-check-input" type="checkbox" value="{{ $d->id }}"
                                wire:model.live="cekPegawai" />


                        </td>
                    </tr>

                </tbody>
            @endforeach
        </table>
    </x-wire-table>
</div>
