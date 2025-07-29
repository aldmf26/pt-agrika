<x-app-layout :title="$title">
    <form action="" method="post">
        @csrf
        <div class="row">
            <div class="col-3">
                <div class="form-group">
                    <label for="">No Po</label>
                    <input type="text" readonly value="{{ $no_po }}" name="no_po" class="form-control">
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="">Tanggal</label>
                    <input type="date" name="tgl" value="{{ date('Y-m-d') }}" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-group">
                    <label for="">To Supplier</label>
                    <select class="select2suplier" name="supplier">
                        <option value="">-- Pilih Item --</option>
                        @foreach ($supplier as $p)
                            <option data-alamat="{{ $p->alamat }}" data-no="{{ $p->telepon }}"
                                value="{{ $p->nama_supplier }}">{{ $p->nama_supplier }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">Alamat</label>
                    <input type="text" readonly name="alamat" placeholder="alamat" class="form-control">
                </div>
            </div>
            <div class="col-3"></div>
            <div class="col-3">
                <div class="form-group">
                    <label for="">Pic</label>
                    <input type="text" name="pic" placeholder="pic" class="form-control">
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="">Telepon</label>
                    <input type="text" name="telepon" placeholder="telepon" class="form-control">
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="">Estimasi Kedatangan Barang</label>
                    <input type="date" required name="estimasi" placeholder="estimasi" class="form-control">
                </div>
            </div>

        </div>
        @livewire('pur.create_po')
        <div class="row">
            <div class="col-9">
                <button type="submit" class="btn btn-sm btn-primary float-end">Save</button>
            </div>
        </div>
    </form>

</x-app-layout>
