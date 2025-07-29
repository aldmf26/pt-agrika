<x-app-layout :title="$title">
    <form action="" method="post">
        @csrf
        <div class="row">
            <div class="col-3">
                <div class="form-group">
                    <label for="">Tanggal Pemusnahan</label>
                    <input value="{{ date('Y-m-d') }}" required type="date" name="tgl" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-group">
                    <label for="">Nama Produk</label>
                    <input required type="text" name="nama_produk" placeholder="Nama Produk" class="form-control">
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label for="">Jumlah</label>
                    <input required type="text" name="jumlah" placeholder="Jumlah" class="form-control">
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="">Cakupan Pemusnahan</label>
                    <input required type="text" name="cakupan" placeholder="Cakupan Pemusnahan" class="form-control">
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="">Alasan Pemusnahan</label>
                    <input required type="text" name="alasan" placeholder="Alasan Pemusnahan" class="form-control">
                </div>
            </div>


        </div>
        <div class="row">
            <div class="col-12">
                <button type="submit" class="btn btn-sm btn-primary float-end">Save</button>
            </div>
        </div>
    </form>

</x-app-layout>
