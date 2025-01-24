<x-app-layout :title="$title">
    <div class="row" x-data="{ checked: [] }">
        <div class="col-lg-12">
            <a href="#" class="float-end btn btn-sm btn-primary"
                @click.prevent="window.location.href = `/hrga/10/1-visitor-health-monitoring-form/print?checked=${$data.checked.join(',')}`"><i
                    class="fas fa-print"></i> Print
                <span x-transition x-text="checked.length ? `(${checked.length})` : 'Semua'"></span>
            </a>
        </div>
        <div class="col-12">
            <table class="table" id="example">
                <thead>
                    <tr>
                        <th class="dhead">No</th>
                        <th class="dhead">Tgl</th>
                        <th class="dhead">Nama</th>
                        <th class="dhead">Time In</th>
                        <th class="dhead">Keperluan</th>
                        <th class="dhead">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $d)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ tanggal($d->date) }}</td>
                            <td>{{ $d->name }}</td>
                            <td>{{ jam($d->time_in) }}</td>
                            <td>{{ $d->purpose }}</td>
                            <td>
                                <input type="checkbox" class="form-check-input" :value="{{ $d->id }}"
                                    x-model="checked">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
