<x-app-layout :title="$title">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <div class="row">
        <div class="col-lg-4">
            <label for="">Bulan</label>
            <select name="bulan" id="bulan" class="form-control select4">
                <option value="">--Pilih Bulan--</option>
                @foreach ($bulan as $b)
                    <option value="{{ $b->bulan }}">{{ $b->nm_bulan }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Tambahkan jQuery dulu -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Baru load select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.select4').select2({
                width: '100%'
            });
        });
    </script>
</x-app-layout>
