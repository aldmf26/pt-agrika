<x-app-layout :title="$title">
    <div class="row">
        <div class="col-12">

            @can('presiden')
                <a href="#tambah" data-bs-toggle="modal" class="float-end btn btn-primary btn-sm"><i class="fas fa-plus"></i>
                    Dokumen</a>
            @endcan

            <form action="{{ route('dashboard.store') }}" method="POST">
                <x-modal id="tambah" title="Tambah Dokumen Internal">
                    @csrf
                    <div class="row">
                        <div class="mb-3">
                            <label for="no_dokumen" class="form-label">No Dokumen</label>
                            <input type="text" class="form-control" id="no_dokumen" name="no_dokumen">
                        </div>
                        <div class="mb-3">
                            <label for="divisi" class="form-label">Divisi</label>
                            <input type="text" class="form-control" id="divisi" name="divisi">
                        </div>
                        <div class="mb-3">
                            <label for="pic" class="form-label">PIC</label>
                            <select name="pic" class="select2">
                                <option value="">Pilih PIC</option>
                                @foreach ($pic as $p)
                                    <option value="{{ $p->name }}">{{ $p->name }} - </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul</label>
                            <input type="text" class="form-control" id="judul" name="judul">
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Jenis</label>
                            <select name="jenis" id="" class="form-select">
                                <option value="internal">Pilih</option>
                                <option value="sop">SOP</option>
                                <option value="ik">IK</option>
                                <option value="frm">FRM</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="tags">Tags</label>
                            <div x-data @tags-update="console.log('tags updated', $event.detail.tags)" data-tags=''
                                class="max-w-lg m-6">
                                <div x-data="tagSelect()" @click.away="clearSearch()"
                                    @keydown.escape="clearSearch()">
                                    <div class="relative" @keydown.enter.prevent="addTag(textInput)">
                                        <input x-model="textInput" x-ref="textInput"
                                            @input="search($event.target.value)" class="form-control"
                                            placeholder="Tambahkan tag baru dengan koma">
                                        <input type="hidden" name="tags" id="tags" value="">
                                        <!-- selections -->
                                        <div class="d-flex gap-1 mt-2 mb-2">
                                            <template x-for="(tag, index) in tags">
                                                <span class="badge bg-info">
                                                    <span x-text="tag"></span>
                                                    <button type="button" @click.prevent="removeTag(index)"
                                                        class="btn-close btn-close-white"></button>
                                                </span>
                                            </template>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                </x-modal>
            </form>
        </div>

        <div class="col-12 mt-3">
            <br>
            @livewire('dashboard.search')
        </div>
    </div>


    @section('scripts')
        <script>
            function tagSelect() {
                return {
                    open: false,
                    textInput: '',
                    tags: [],
                    addTag(tag) {
                        tag = tag.trim();
                        if (tag != "" && !this.hasTag(tag)) {
                            this.tags.push(tag);
                        }
                        this.clearSearch();
                        this.$refs.textInput.focus();
                        this.fireTagsUpdateEvent();
                    },
                    fireTagsUpdateEvent() {
                        this.$el.dispatchEvent(new CustomEvent('tags-update', {
                            detail: {
                                tags: this.tags
                            },
                            bubbles: true,
                        }));
                        this.updateHiddenInput(); // Perbarui input tersembunyi saat tags berubah
                    },
                    updateHiddenInput() {
                        document.getElementById('tags').value = JSON.stringify(this.tags);
                    },
                    hasTag(tag) {
                        var tag = this.tags.find(e => {
                            return e.toLowerCase() === tag.toLowerCase();
                        });
                        return tag != undefined;
                    },
                    removeTag(index) {
                        this.tags.splice(index, 1);
                        this.fireTagsUpdateEvent();
                    },
                    search(q) {
                        if (q.includes(",")) {
                            q.split(",").forEach(function(val) {
                                this.addTag(val);
                            }, this);
                        }
                        this.toggleSearch();
                    },
                    clearSearch() {
                        this.textInput = '';
                        this.toggleSearch();
                    },
                    toggleSearch() {
                        this.open = this.textInput != '';
                    }
                };
            }
        </script>
    @endsection

    <div class="row d-none">
        @foreach ($menus as $menu)
            <div class="col-lg-3">
                @php
                    $linkRoute = $route;

                    if (
                        !empty($isSubLevel) ||
                        (!empty($menu->parent_id) &&
                            ($menu->parent_id == 113 || $menu->parent_id == 154 || $menu->parent_id == 169))
                    ) {
                        $linkRoute = $menu->link;
                    }

                    $linkParam = $menu->title;
                @endphp

                <a wire:navigate href="{{ route($linkRoute, $linkParam) }}">
                    <div style="cursor:pointer;" class="bg-info card border card-hover text-white">
                        <div class="card-front">
                            <div class="card-body">
                                <h5 class="card-title text-white text-center">
                                    <img src="{{ asset('img/folder.png') }}" width="80" alt=""><br><br>
                                    {{ ucfirst($menu->title) }}
                                </h5>
                                <h5 class="card-title text-white text-center">
                                    {{ ucfirst($menu->subtitle) }}
                                </h5>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</x-app-layout>
