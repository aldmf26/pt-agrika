<x-app-layout :title="$title">
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
                    <select name="nama" id="" class="form-control select2nama">
                        <option value="">Pilih</option>
                        @foreach ($namas as $nama)
                            <option value="{{ $nama->nama }}">{{ $nama->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-5">
                    <label for="">Tugas & Tanggung Jawab</label>
                    <input type="text" class="form-control" name="tugas">
                </div>
            </x-multiple-input>
        </div>
    </div>

    @section('scripts')
        <script>
            $(document).ready(function() {
                setTimeout(function() {
                    $('.select2nama').select2();
                }, 100);
            });
        </script>
    @endsection
</x-app-layout>
