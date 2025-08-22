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
                    add</button>
            </div>
        </div>
        <div>
            <a href="{{ route('qa.jadwal_verifikasi.print', ['tahun' => $tahun]) }}" target="_blank"
                class="btn btn-sm btn-primary"><i class="fas fa-print"></i>
                print</a>
        </div>
    </div>
    <form wire:submit.prevent="add">
        <div class="row" x-show="add" x-transition>
            <div class="col-2">
                <label for="">Item :</label>
                <input type="text" wire:model="form.item" class="form-control">
            </div>
            <div class="col-2">
                <label for="">Aktivitas :</label>
                <input type="text" wire:model="form.aktivitas" class="form-control">
            </div>
            <div class="col-2">
                <label for="">Frekuensi :</label>
                <input type="text" wire:model="form.frek" class="form-control">
            </div>
            <div class="col-2">
                <label for="">Departemen :</label>
                <input type="text" wire:model="form.departemen" class="form-control">
            </div>
            <div class="col-2">
                <label for="">&nbsp;</label><br>
                <button type="submit" class="btn btn-sm btn-primary">Save</button>
            </div>
        </div>
    </form>

    <button wire:loading class="btn btn-secondary btn-sm" type="button" disabled="">
        <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
        Processing...
    </button>

    <span class="text-sm text-warning float-end"><em>*double click untuk mengisi bulan</em></span>
    <br>
    <div class="float-end">
        <span class="text-warning"> Keterangan :</span>
        <span class="fst-italic text-muted text-sm">Nihil</span>
        <button class="btn btn-md btn-outline-dark">&nbsp;</button>

        <span class="fst-italic text-muted text-sm">Process</span>
        <button class="btn btn-md btn-warning">&nbsp;</button>

        <span class="fst-italic text-muted text-sm">Selesai</span>
        <button class="btn btn-md btn-success">&nbsp;</button>
    </div>
    <br>
    {{-- <span class="text-sm  text-success float-end"><em>*clicik kanan untuk audit</em></span> --}}
    <table class="mt-4 table table-bordered border-dark table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Item</th>
                <th>Aktivitas</th>
                <th>Frekuensi</th>
                <th>Departemen</th>
                <th colspan="13" class="text-center">Bulan</th>
            </tr>
            <tr>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                @for ($i = 1; $i <= 12; $i++)
                    <th class="text-center">{{ $i }}</th>
                @endfor
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $key => $audit)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>
                        {{ $audit->item }}
                    </td>
                    <td>{{ $audit->aktivitas }}</td>
                    <td class="text-nowrap">{{ $audit->frek }}</td>
                    <td class="text-nowrap">{{ $audit->departemen }}</td>
                    @for ($i = 1; $i <= 12; $i++)
                        <td onclick="{{ $this->getField($i, $audit->id) ? 'showContextMenu(event, ' . $audit->id . ', ' . $i . ')' : '' }}"
                            @dblclick="$wire.toggleBulan({{ $audit->id }}, {{ $i }}, '{{ $audit->item }}', '{{ $audit->aktivitas }}', '{{ $audit->frek }}', '{{ $audit->departemen }}')"
                            class="text-center td-hover {{ $this->cekSelesai($audit->item, $i) ? 'bg-success' : ($this->getField($i, $audit->id) ? 'bg-warning' : '') }}">

                            <div class="position-absolute mt-2 d-none context-menu"
                                id="contextMenu-{{ $audit->id }}-{{ $i }}">
                                <div class="dropdown-menu show">
                                    @if ($this->cekSelesai($audit->item, $i))
                                        <a class="dropdown-item"
                                            x-on:click="$wire.cancel('{{ $audit->item }}', {{ $i }})"
                                            href="#">cancel</a>
                                    @else
                                        <a class="dropdown-item"
                                            x-on:click="$wire.selesai('{{ $audit->item }}', {{ $i }})"
                                            href="#">done</a>
                                    @endif


                                </div>
                            </div>
                        </td>
                    @endfor
                </tr>
            @endforeach
        </tbody>
    </table>


    <script>
        document.addEventListener('click', (event) => {
            // Periksa apakah kita mengklik di luar context menu
            const clickedOnMenu = event.target.closest('.context-menu') !== null;
            const clickedOnCell = event.target.tagName === 'TD';

            // Sembunyikan semua menu jika kita tidak mengklik pada menu atau sel yang terkait
            if (!clickedOnMenu && !clickedOnCell) {
                document.querySelectorAll('.context-menu').forEach(menu => menu.classList.add('d-none'));
            }
        });

        function showContextMenu(event, auditId, bulan) {
            // Hentikan event bubbling
            event.stopPropagation();

            // Sembunyikan semua menu terlebih dahulu
            document.querySelectorAll('.context-menu').forEach(menu => menu.classList.add('d-none'));

            // Tampilkan menu yang sesuai
            const contextMenu = document.getElementById(`contextMenu-${auditId}-${bulan}`);
            if (contextMenu) {
                contextMenu.classList.remove('d-none');
            }
        }
    </script>
</div>
