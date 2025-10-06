<div>
    <div class="d-flex justify-content-between mb-2 align-items-center">

        <div>
            <h5 class="fw-bold text-success">Audit : {{ strtoupper($departemenAsli) }} </h5>

            <div class="input-group mb-3">
                <label class="input-group-text" for="tanggal">Tanggal</label>
                <input type="number" class="form-control" id="tanggal" wire:model.live="tanggalValue" min="1"
                    max="31" style="width: 100px">
                <span class="input-group-text">{{ $namaBulan }} {{ $tahun }}</span>
                <span class="text-muted text-warning text-sm mt-3 ms-2"><em>Tanggal bisa diubah</em></span>
            </div>
        </div>

        <div>
            <a href="{{ route('ia.1.print_audit_departemen', ['id' => $id, 'departemen' => $departemen, 'bulan' => $bulan, 'tahun' => $tahun]) }}"
                target="_blank" class="btn btn-sm btn-primary float-end mb-2"><i class="fas fa-print"></i> Print</a>
        </div>
    </div>

    <table class="table table-bordered table-sm table-hover">
        <thead style="position: sticky; top: 0; z-index: 1; background-color: white;">
            <tr>
                <th>Aspek yang Dinilai</th>
                <th>MIN</th>
                <th>MAJ</th>
                <th>SR</th>
                <th>KT</th>
                <th>OK</th>
                <th>Keterangan / <br> Tindakan Koreksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($headings as $heading)
                <tr>
                    <td colspan="7" class="bg-primary text-black">{{ $heading->nama }}</td>
                </tr>
                @foreach ($heading->subHeadings as $sub)
                    @if ($sub->nama)
                        <tr>
                            <td colspan="7" class="bg-info text-white">{{ $sub->nama }}</td>
                        </tr>
                    @endif
                    @foreach ($sub->pertanyaan as $pertanyaan)
                        <tr>
                            <td>{{ $pertanyaan->nomor_urutan }}. {{ $pertanyaan->teks }}</td>
                            <td>
                                <input type="checkbox" wire:model.live="hasilChecklist.{{ $pertanyaan->id }}.min"
                                    value="1">
                            </td>
                            <td>
                                <input type="checkbox" wire:model.live="hasilChecklist.{{ $pertanyaan->id }}.maj"
                                    value="1">
                            </td>
                            <td>
                                <input type="checkbox" wire:model.live="hasilChecklist.{{ $pertanyaan->id }}.sr"
                                    value="1">
                            </td>
                            <td>
                                <input type="checkbox" wire:model.live="hasilChecklist.{{ $pertanyaan->id }}.kt"
                                    value="1">
                            </td>
                            <td>
                                <input type="checkbox" wire:model.live="hasilChecklist.{{ $pertanyaan->id }}.ok"
                                    value="1">
                            </td>
                            <td>
                                <input type="text" class="form-control"
                                    wire:model.live="hasilChecklist.{{ $pertanyaan->id }}.keterangan">
                            </td>
                        </tr>
                    @endforeach
                    @if ($sub->total)
                        <tr>
                            <td colspan="7" class="bg-light">Total: {{ $sub->total->total }}</td>
                        </tr>
                    @endif
                @endforeach
            @endforeach
        </tbody>
    </table>

    <button wire:click="finish" type="button" class="btn btn-md btn-block btn-outline-primary">Selesai <i
            class="fas fa-check"></i></button>

</div>
