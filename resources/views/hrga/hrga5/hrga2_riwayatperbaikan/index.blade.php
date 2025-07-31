<x-app-layout title="{{ $title }}">
    <div class="card">
        <div class="card-header">
            @include('hrga.hrga5.hrga1_programperawatansarana.nav', [
                'url' => 'hrga5.2.index',
            ])
            <button class="btn btn-primary float-end me-2" data-bs-toggle="modal" data-bs-target="#view"><i
                    class="fas fa-calendar"></i> view</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="example">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Sarana & Prasana</th>
                            <th>Lokasi</th>
                            <th>No identifikasi</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($grouped as $key => $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item['nama_item'] }}</td>
                                <td>{{ $item['lokasi'] }}</td>
                                <td>{{ $item['no_identifikasi'] }}</td>
                                {{-- <td>{{ $item['id'] . $item['jenis'] }}</td> --}}
                                <td class="text-center">
                                    @php
                                        $id = $item['id'];
                                        $jenis = $item['jenis'];
                                    @endphp
                                    <a target="_blank"
                                        href="{{ route('hrga5.2.print', ['id' => $id, 'jenis' => $jenis, 'tahun' => $tahun]) }}"
                                        class="btn btn-sm btn-warning"><i class="fas fa-print"></i> print</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <form action="" method="get">
        <div class="modal fade" id="view" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahModalLabel">View</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <select name="tahun" id="" class=" form-control">
                            @foreach ($tahuns as $t)
                                <option value="{{ $t }}" @selected($tahun == $t)>{{ $t }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

</x-app-layout>
