<div class="row">
    <div class="col-3">
        <div class="form-group">
            <label for="">No Pr</label>
            <div wire:ignore>
                <select class="select2pr" id="selectedPr" name="id_pr">
                    <option value="">Pilih Pr</option>
                    @foreach ($no_pr as $p)
                        <option @selected($p->id == $selectedPr) value="{{ $p->id }}">{{ $p->no_pr }}</option>
                    @endforeach
                </select>
            </div>
            <span wire:loading>loading...</span>

        </div>
    </div>
    <div class="col-6" x-data="{ rows: ['1'] }">
        <table class="table table-bordered">
            <thead class="bg-info">
                <tr>
                    <th class="text-white text-center" width="80">Jumlah</th>
                    <th class="text-white text-center">Item dan Spesifikasi</th>
                    <th class="text-white text-center" width="180">Harga</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($getPr))
                    @foreach ($getPr as $d)
                        <tr>
                            <td align="center">
                                <input type="hidden" name="id[]" value="{{ $d->id }}">
                                {{ $d->jumlah }}
                            </td>
                            <td align="center">
                                {{ $d->item_spesifikasi }}
                            </td>
                            <td>
                                <input required autocomplete="off" value="{{ $d->barang->harga_satuan ?? 0 }}"
                                    type="text" inputmode="numeric" name="harga[]"
                                    class="text-end form-control form-control-sm" />
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="3">
                            belum dipilih no pr
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@section('scripts')
    <script>
        setTimeout(function() {
            $('.select2pr, .select2pic, .select2suplier').select2({});

            $('.select2suplier').change(function(e) {
                e.preventDefault();
                $('input[name=alamat]').val($(this).find(':selected').data('alamat'));
            });
        }, 500);

        $('.select2pr').on('change', function(e) {
            let elementName = $(this).attr('id');
            var data = $(this).select2("val");
            @this.set(elementName, data);
        });
        $(document).on('livewire:dispatch', 'refreshSelect2', function(e) {
            $('.select2pr').val(null).trigger('change');
        });
    </script>
@endsection
