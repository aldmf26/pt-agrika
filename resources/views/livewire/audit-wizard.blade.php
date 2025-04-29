<div>
    <table class="table table-bordered table-sm table-hover">
        <thead style="position: sticky; top: 0; z-index: 1; background-color: white;">
            <tr>
                <th>Aspek yang Dinilai</th>
                <th>MIN</th>
                <th>MAJ</th>
                <th>SR</th>
                <th>KT</th>
                <th>OK</th>
                <th>Keterangan / Tindakan Koreksi</th>
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

    <button wire:click="finish" type="button" class="btn btn-md btn-block btn-outline-primary">Selesai <i class="fas fa-check"></i></button>

</div>



