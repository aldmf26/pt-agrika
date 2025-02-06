<div x-data="{
    add: false,
    init() {
        window.addEventListener('hideAdd', () => {
            this.add = false
        });
    }
}">
    <style>
        .td-hover:hover {
            background-color: black !important;
            cursor: pointer;

        }
    </style>

    <div class="d-flex justify-content-between">
        <div class="row">
            <div class="col-6">
                <label for="tahunTahun">Tahun : </label>
                <select wire:model.live="tahun" class="form-select float-end" aria-label="Default select example">
                    <option value="">Pilih Tahun</option>
                    @for ($i = date('Y'); $i >= date('Y') - 1; $i--)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="col-6">
                <label for="">Aksi</label> <br>
                <button @click="add = !add" type="button" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i>
                    Data</button>
            </div>

        </div>
        <div>
            <a href="{{ route('ia.1.print', ['tahun' => $tahun]) }}" target="_blank" class="btn btn-sm btn-primary"><i
                    class="fas fa-print"></i>
                Print</a>
        </div>
    </div>
    <form wire:submit.prevent="add">
        <div class="row" x-show="add" x-transition>
            <div class="col-2">
                <label for="">Departemen :</label>
                <input type="text" wire:model="form.departemen" class="form-control">
            </div>
            <div class="col-2">
                <label for="">Auditee :</label>
                <input type="text" wire:model="form.audite" class="form-control">
            </div>
            <div class="col-2">
                <label for="">Auditor :</label>
                <input type="text" wire:model="form.auditor" class="form-control">
            </div>
            <div class="col-2">
                <label for="">&nbsp;</label><br>
                <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
            </div>
        </div>
    </form>

    <button wire:loading class="btn btn-secondary btn-sm" type="button" disabled="">
        <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
        Processing...
    </button>


    <table class="mt-4 table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Departemen</th>
                <th>Auditee</th>
                <th>Auditor</th>
                <th colspan="13" class="text-center">Bulan</th>
            </tr>
            <tr>
                <th colspan="4"></th>
                @for ($i = 1; $i <= 12; $i++)
                    <th class="text-center">{{ $i }}</th>
                @endfor
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $key => $audit)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $audit->departemen }}</td>
                    <td>{{ $audit->audite }}</td>
                    <td>{{ $audit->auditor }}</td>
                    @for ($i = 1; $i <= 12; $i++)
                        <td wire:click="toggleBulan({{ $audit->id }}, {{ $i }}, '{{ $audit->departemen }}', '{{ $audit->audite }}', '{{ $audit->auditor }}')"
                            class="text-center td-hover {{ $this->getField($i, $audit->id) ? 'bg-success' : '' }}">
                        </td>
                    @endfor
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
