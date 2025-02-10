<x-app-layout :title="$title">
    <div class="d-flex justify-content-end gap-2">
        <div>
            <button data-bs-toggle="modal" data-bs-target="#tambah" type="button" class="btn btn-sm btn-primary"><i
                    class="fas fa-plus"></i> Produk</button>
                    <div x-data="{ showProduk: false }">
                        <x-modal btnSave="T" idModal="tambah" title="Tambah Produk" size="modal-lg">
                            <img src="{{ asset('img/format_bahan_jadi.jpeg') }}">
                
                            @livewire('ppc.tbh-produk')
                        </x-modal>
                    </div>
        </div>
        <div>
            <a href="{{route('ppc.gudang-fg.1.create')}}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Delivery</a>
        </div>
    </div>
    <script>
        function creditCardMask(input) {
            return input.startsWith('34') || input.startsWith('37') ?
                '9999 999999 99999' :
                '99 999999 99 99 99'
        }
    </script>
</x-app-layout>
