<x-app-layout :title="$title">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="float-start">{{ $title }} : Tahun {{ $tahun }}</h5>
                    <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#tambah"><i
                            class="fas fa-plus"></i> Data</button>
                    <button data-bs-toggle="modal" data-bs-target="#view" class="btn btn-primary float-end me-2"><i
                            class="fas fa-calendar"></i> View</button>
                    <a href="{{ route('hrga2.5.print', ['tahun' => $tahun]) }}" target="_blank"
                        class="btn btn-primary float-end me-2"><i class="fas fa-print"></i> Print</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="example">
                        <thead>
                            <th class="dhead">#</th>
                            <th class="dhead">Divisi</th>
                            <th class="dhead">Bulan</th>
                            <th class="dhead">Tahun</th>
                            <th class="dhead">Tanggal</th>
                            <th class="dhead">Aksi</th>
                        </thead>
                        <tbody>
                            @foreach ($jadwal as $j)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $j->divisi->divisi }}</td>
                                    <td>{{ $j->bulan_rencana }}</td>
                                    <td>{{ $j->tahun_rencana }}</td>
                                    <td>{{ $j->tgl_dari }} - {{ $j->tgl_sampai }}</td>
                                    <td></td>
                                </tr>
                            @endforeach


                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>


    <form action="{{ route('hrga2.5.store') }}" method="POST">
        @csrf
        <x-modal_plus size="modal-lg">
            <div class="row">
                <div class="col-lg-4">
                    <label for="">Divisi</label>
                    <select name="divisi_id" id="" class="select2">
                        <option value="">Pilih Divisi</option>
                        @foreach ($divisi as $d)
                            <option value="{{ $d->id }}">{{ $d->divisi }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-4">
                    <label for="">Bulan</label>
                    <select name="bulan" id="" class="select2">
                        <option value="">Pilih Bulan</option>
                        @foreach ($bulan as $b)
                            <option value="{{ $b->id_bulan }}">{{ $b->nm_bulan }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-4">
                    <label for="">Tahun</label>
                    <select name="tahun" id="" class="select2">
                        <option value="">Pilih Tahun</option>
                        <option value="{{ date('Y') }}">{{ date('Y') }}</option>
                        <option value="{{ date('Y', strtotime('+1 year')) }}">{{ date('Y', strtotime('+1 year')) }}
                        </option>
                    </select>
                </div>

                <div class="col-lg-3 mt-2">
                    <center>

                        <label for="" class="text-center">Realisasi</label>
                    </center>
                    <div class="row">
                        <div class="col-lg-6">
                            <label for=""> Dari</label>
                            <select name="tgl_mulai" id="" class="form-control">
                                @foreach ($tgl as $t)
                                    <option value="{{ $t }}">{{ $t }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <label for=""> Sampai</label>
                            <select name="tgl_selesai" id="" class="form-control">
                                @foreach ($tgl as $t)
                                    <option value="{{ $t }}">{{ $t }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>

            </div>
        </x-modal_plus>
    </form>

    <x-modal_plus size="modal-sm" id="view">
        <div class="row">

            <div class="col-lg-12">
                <label for="">Tahun</label>
                <select name="tahun" id="" class="form-control">
                    <option value="">Pilih Tahun</option>
                    @foreach ($tahuns as $tahun)
                        <option value="{{ $tahun }}">{{ $tahun }}</option>
                    @endforeach
                </select>
            </div>


        </div>
    </x-modal_plus>



</x-app-layout>
