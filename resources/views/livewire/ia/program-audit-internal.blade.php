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
                {{-- <input type="text" wire:model="form.departemen" class="form-control" placeholder="Departemen"> --}}

                <select data-field="departemen" wire:model="form.departemen" id="select-departemen"
                    class="form-control">
                    <option value="">Pilih Departemen</option>
                    @foreach ($departemenBk as $item)
                        <option value="{{ $item }}">{{ $item }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-2">
                <label for="">Auditee :</label>
                <select data-field="auditee" wire:model="form.audite" id="select-auditee" class="form-control">
                    <option value="">Pilih Auditee</option>
                    @foreach ($user as $u)
                        <option value="{{ $u->nama }}">{{ $u->nama }}</option>
                    @endforeach
                </select>
                {{-- <input type="text" wire:model="form.audite" class="form-control"> --}}
            </div>
            <div class="col-2">
                <label for="">Auditor :</label>
                <select data-field="auditor" wire:model="form.auditor" id="select-auditor" class="form-control">
                    <option value="">Pilih Auditee</option>
                    @foreach ($user as $u)
                        <option value="{{ $u->nama }}">{{ $u->nama }}</option>
                    @endforeach
                </select>
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

        <span class="fst-italic text-muted text-sm">Siap Audit</span>
        <button class="btn btn-md btn-warning">&nbsp;</button>

        <span class="fst-italic text-muted text-sm">Selesai</span>
        <button class="btn btn-md btn-success">&nbsp;</button>
    </div>
    <br>
    {{-- <span class="text-sm  text-success float-end"><em>*clicik kanan untuk audit</em></span> --}}
    {{-- Blade View --}}
    <table class="mt-4 table table-bordered border-dark table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Departemen</th>
                <th>Auditee</th>
                <th>Auditor</th>
                <th>Aksi</th>
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

                        {{ $audit->departemen }}
                    </td>
                    <td>
                        @if ($editingId == $audit->id)
                            <input type="text" wire:model="editForm.audite" class="form-control form-control-sm">
                        @else
                            {{ $audit->audite }}
                        @endif
                    </td>
                    <td>
                        @if ($editingId == $audit->id)
                            <input type="text" wire:model="editForm.auditor" class="form-control form-control-sm">
                        @else
                            {{ $audit->auditor }}
                        @endif
                    </td>
                    <td>
                        @can('presiden')
                            @if ($editingId == $audit->id)
                                <button class="btn btn-xs btn-success me-1" wire:click="saveEdit"><i
                                        class="fas fa-check"></i></button>
                                <button class="btn btn-xs btn-secondary" wire:click="cancelEdit"><i
                                        class="fas fa-times"></i></button>
                            @else
                                <button class="btn btn-xs btn-primary me-1" wire:click="edit({{ $audit->id }})"><i
                                        class="fas fa-edit"></i></button>
                                <button class="btn btn-xs btn-danger" wire:click="delete({{ $audit->id }})"
                                    wire:confirm="Yakin ingin menghapus data ini?"><i class="fas fa-trash"></i></button>
                            @endif
                        @endcan
                    </td>
                    @for ($i = 1; $i <= 12; $i++)
                        <td onclick="{{ $this->getField($i, $audit->id) ? 'showContextMenu(event, ' . $audit->id . ', ' . $i . ')' : '' }}"
                            @dblclick="$wire.toggleBulan({{ $audit->id }}, {{ $i }}, '{{ $audit->departemen }}', '{{ $audit->audite }}', '{{ $audit->auditor }}')"
                            class="text-center td-hover {{ $this->cekSelesai($audit->departemen, $i) ? 'bg-success' : ($this->getField($i, $audit->id) ? 'bg-warning' : '') }}">

                            <div class="position-absolute mt-2 d-none context-menu"
                                id="contextMenu-{{ $audit->id }}-{{ $i }}">
                                <div class="dropdown-menu show">
                                    @php
                                        $link =
                                            'https://docs.google.com/spreadsheets/d/17f9GVnbjbtAeSUHw7kPHQgNbiwZlif4pmQh1ChG2Dxc/edit?usp=sharing';
                                    @endphp

                                    <a class="dropdown-item"
                                        href="{{ route('ia.1.audit', ['id' => $audit->id, 'departemen' => strtolower($audit->departemen), 'bulan' => $i, 'tahun' => $tahun]) }}">{{ $this->cekSelesai($audit->departemen, $i) ? 'Edit' : 'Audit' }}</a>
                                </div>
                            </div>
                        </td>
                    @endfor
                </tr>
            @endforeach
        </tbody>
    </table>

    @section('scripts')
        <script>
            $(document).ready(function() {
                setTimeout(function() {
                    $('.selectAudtor').select2();
                }, 500);


            });
        </script>
    @endsection
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
