  <x-hccp-print title="AGENDA & JADWAL TINJAUAN MANAJEMEN" dok="Dok.No.: FRM.QA.04.01, Rev.00">
      <style>
          table {
              font-family: 'arial'
          }
      </style>
      <div class="row">
          <div class="col-lg-12">
              <br>
              <table class="table table-bordered table-xs border-dark" style="font-size: 11px">
                  <thead>
                      <tr>
                          <th class="text-center">No</th>
                          <th class="text-center">Tanggal</th>
                          <th class="text-center">Waktu</th>
                          <th class="text-center">Agenda</th>
                          <th class="text-center" width="100">PIC</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($agenda as $a)
                          <tr>
                              <td class="text-end">{{ $loop->iteration }}</td>
                              <td class="text-end">
                                  {{ tanggal($a->tanggal) }}</td>
                              <td class="text-end">{{ date('h:i A', strtotime($a->dari_jam)) }} -
                                  {{ date('h:i A', strtotime($a->sampai_jam)) }}</td>
                              </td>
                              <td>
                                  @foreach (explode('||', $a->agendas) as $i => $agenda)
                                      {{ $i + 1 }}. {{ $agenda }} <br>
                                  @endforeach
                              </td>
                              <td>{!! ucwords(strtolower($a->pics)) !!}</td>
                          </tr>
                      @endforeach
                  </tbody>
              </table>
          </div>
      </div>
      <div class="row">
          <div class="col-8"></div>
          <div class="col-4">
              <table class="table table-bordered border-dark" style="font-size: 11px">
                  <thead>
                      <tr>
                          <th class="text-center" width="25%">Dibuat Oleh:</th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr>
                          <td style="height: 80px" class="text-center align-middle">
                              <x-ttd-barcode :id_pegawai="whereTtd('Kepala Lab & FSTL')" />
                          </td>
                      </tr>
                      <tr>

                          <td class="text-center align-middle">
                              (KEPALA LAB & FSTL)
                          </td>

                      </tr>
                  </tbody>
              </table>
          </div>
      </div>
  </x-hccp-print>
