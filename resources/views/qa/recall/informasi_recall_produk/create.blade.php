<x-app-layout :title="$title">
    <form action="{{ route('qa.5.1.store') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-6">
                <label for="">Skenario Recall</label>
                <textarea name="skenario" id="" cols="5" rows="5" class="form-control"></textarea>
            </div>
            <div class="col-6">
                <label for="">Tim Recall</label>
                <x-multiple-input>
                    <div class="col-4">
                        <label for="">Nama</label>
                        <select name="nama[]" id="" class="form-control select2nama">
                            <option value="">Pilih</option>
                            @foreach ($namas as $nama)
                                <option value="{{ $nama->nama }}">{{ $nama->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-5">
                        <label for="">Tugas & Tanggung Jawab</label>
                        <input type="text" class="form-control" name="tugas[]">
                    </div>
                </x-multiple-input>
            </div>
        </div>

        <div class="row mt-5">
            <h6>Informasi Produk</h6>

            <x-multiple-input>
                <div class="col-3">
                    <label for="">Nama Produk</label>
                    <select name="nama_produk[]" id="" class="form-control select2nama select2sbw">
                        <option value="">Pilih</option>
                        @foreach ($sbw as $sb)
                            <option data-no_lot="{{ $sb->no_lot }}" value="{{ $sb->nama }}">{{ $sb->nama }} -
                                {{ $sb->no_lot }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-3">
                    <label for="">Kode Batch</label>
                    <input readonly type="text" class="form-control" name="no_lot[]">
                </div>
                <div class="col-2">
                    <label for="" class="text-sm float-end">Jumlah Recall (Gr)</label>
                    <input type="text" class="form-control text-end" name="jumlah_recall[]">
                </div>
                <div class="col-2">
                    <label for="" class="text-sm float-end">Jumlah Distribusi (Gr)</label>
                    <input type="text" class="form-control text-end" name="jumlah_distribusi[]">
                </div>
                <div class="col-2"></div>
                <div class="col-3">
                    <label for="">Nama Pelanggan</label>
                    <input type="text" class="form-control" name="nama_pelanggan[]">
                </div>
                <div class="col-3">
                    <label for="">Alamat Pelanggan</label>
                    <input type="text" class="form-control" name="alamat_pelanggan[]">
                </div>

            </x-multiple-input>

        </div>
        <div class="row mt-5">
            <div class="col-12">
                <button type="submit" class="btn btn-sm btn-primary float-end">Save</button>
            </div>
        </div>
    </form>
    @section('scripts')
        <script>
            $(document).ready(function() {
                setTimeout(function() {
                    $('.select2nama').select2();
                }, 100);

            });
            $(document).on('change', '.select2sbw', function() {
                var no_lot = $(this).find(':selected').data('no_lot');
                $(this).closest('.row').find('input[name="no_lot[]"]').val(no_lot);
            });
        </script>
    @endsection
</x-app-layout>
