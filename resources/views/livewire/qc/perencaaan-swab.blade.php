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
            <a href="{{ route('qc.perencanaan_swab.print', ['tahun' => $tahun]) }}" target="_blank"
                class="btn btn-sm btn-primary"><i class="fas fa-print"></i>
                print</a>
        </div>
    </div>
    <form wire:submit.prevent="add">
        <div class="row" x-show="add" x-transition>
            <div class="col-2">
                <label for="">Jenis kegiatan :</label>
                <input type="text" wire:model="form.jenis_kegiatan" class="form-control">
            </div>
            <div class="col-4">
                <label for="">Lokasi :</label>
                {{-- <input type="text" wire:model="form.lokasi" class="form-control"> --}}
                <textarea wire:model="form.lokasi" class="form-control" rows="3"></textarea>

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
                <th>Jenis kegiatan</th>
                <th>Lokasi</th>
                <th colspan="12" class="text-center">Bulan</th>
            </tr>
            <tr>
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
                        {{ $audit->jenis_kegiatan }}
                    </td>
                    <td style="white-space: pre-wrap;">{{ $audit->lokasi }}</td>
                    @for ($i = 1; $i <= 12; $i++)
                        <td onclick="{{ $this->getField($i, $audit->id) ? 'showContextMenu(event, ' . $audit->id . ', ' . $i . ')' : '' }}"
                            @dblclick="$wire.toggleBulan({{ $audit->id }}, {{ $i }}, '{{ $audit->jenis_kegiatan }}')"
                            class="text-center td-hover {{ $this->cekSelesai($audit->jenis_kegiatan, $i) ? 'bg-success' : ($this->getField($i, $audit->id) ? 'bg-warning' : '') }}">

                            <div class="position-absolute mt-2 d-none context-menu"
                                id="contextMenu-{{ $audit->id }}-{{ $i }}">
                                <div class="dropdown-menu show">
                                    @if ($this->cekSelesai($audit->jenis_kegiatan, $i))
                                        <a class="dropdown-item"
                                            x-on:click="$wire.cancel('{{ $audit->jenis_kegiatan }}', {{ $i }})"
                                            href="#">cancel</a>
                                    @else
                                        <a class="dropdown-item"
                                            x-on:click="$wire.selesai('{{ $audit->jenis_kegiatan }}', {{ $i }})"
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
