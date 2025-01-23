@foreach ($datas as $d)
    <div class="employee-record" style="page-break-after: always;">
        <x-guest-layout>
            <section class="mt-5 bg-primary">
                <h6 class="font-bold text-center sm:text-2xl text-sm">A. GENERAL INFORMATION/ <span class="text-gray-600">
                        INFORMASI UMUM</span></h6>
            </section>

            <div class="mt-5 grid grid-cols-3">
                <div class="grid grid-cols-2">
                    <div>Date / <x-label_ind text="Tanggal" /></div>
                    <div class="borderan-jam">{{ $d->date }}</div>

                    <div>Name / <x-label_ind text="Nama" /></div>
                    <div class="borderan">{{ $d->name }}</div>
                </div>
                <div class="grid grid-cols-2">
                    <div>In / <x-label_ind text="Masuk" /></div>
                    <div class="borderan-jam">{{ \Carbon\Carbon::parse($d->time_in)->format('h:i A') }}</div>

                    <div>Out / <x-label_ind text="Keluar" /></div>
                    <div class="borderan-jam">{{ \Carbon\Carbon::parse($d->time_out)->format('h:i A') }}</div>
                </div>
                <div class="grid grid-cols-1">
                    <div>Purpose / <x-label_ind text="Keperluan" /></div>
                    <div class="borderan-jam">{{ $d->purpose }}</div>
                </div>
            </div>
        </x-guest-layout>
    </div>
@endforeach
<style>
    @media print {
        .employee-record {
            page-break-after: always;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        /* Pastikan halaman terakhir tidak memiliki page break */
        .employee-record:last-child {
            page-break-after: avoid;
        }

        /* Memastikan konten tidak terpotong */
        table {
            page-break-inside: avoid;
        }

        /* Mengatur margin halaman */
        @page {
            margin: 2cm;
        }
    }
</style>
