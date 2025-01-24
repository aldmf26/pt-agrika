@foreach ($datas as $d)
    <div class="employee-record" style="page-break-after: always;">
        <x-guest-layout>
            <section class="mt-5 bg-primary">
                <h6 class="font-bold text-center sm:text-2xl text-sm">A. GENERAL INFORMATION/ <span class="text-gray-600">
                        INFORMASI UMUM</span></h6>
            </section>

            <div class="mt-5 grid grid-cols-3">
                <div class="grid grid-cols-2">
                    <div>Date / <x-label_ind text="Tanggal" />:</div>
                    <div class="borderan-jam">{{ $d->date }}</div>

                    <div>Name / <x-label_ind text="Nama" />:</div>
                    <div class="borderan">{{ $d->name }}</div>
                </div>
                <div class="grid grid-cols-2">
                    <div>In / <x-label_ind text="Masuk" />:</div>
                    <div class="borderan-jam">{{ jam($d->time_in) }}</div>

                    <div>Out / <x-label_ind text="Keluar" />:</div>
                    <div class="borderan-jam">{{ jam($d->time_out) }}</div>
                </div>
                <div class="grid grid-cols-1">
                    <div>Purpose / <x-label_ind text="Keperluan" />:</div>
                    <div class="borderan-jam">{{ $d->purpose }}</div>
                </div>
            </div>

            <section class=" bg-primary">
                <h6 class="font-bold text-center sm:text-2xl text-sm">B. HEALTH CONDITION/ <x-label_ind
                        text="KONDISI KESEHATAN" /></h6>
            </section>

            <div class="mt-4">
                <span>B.1 Current Health/<x-label_ind text="Kesehatan Saat ini" /></span>
                <div class="mt-3 mb-6 text-sm grid gap-4 grid-rows-6 grid-cols-2 items-center">
                    @php
                        $data = [
                            [
                                'question' => 'Do you have flu?',
                                'translation' => 'Apakah anda sedang flu?',
                                'name' => 'flu',
                                'value' => $d->flu,
                            ],
                            [
                                'question' => 'Do you have cough?',
                                'translation' => 'Apakah anda sedang batuk?',
                                'name' => 'cough',
                                'value' => $d->cough,
                            ],
                            [
                                'question' => 'Do you have diarhea?',
                                'translation' => 'Apakah anda sedang diare?',
                                'name' => 'diare',
                                'value' => $d->diare,
                            ],
                            [
                                'question' => 'Do you have fever?',
                                'translation' => 'Apakah anda sedang demam?',
                                'name' => 'fever',
                                'value' => $d->fever,
                            ],
                            [
                                'question' => 'Do you have sore throat?',
                                'translation' => 'Apakah anda sedang radang tenggorokan?',
                                'name' => 'sore_throat',
                                'value' => $d->sore_throat,
                            ],
                            [
                                'question' => 'Do you have difficulty breathing? (if any)',
                                'translation' => 'Apakah anda kesulitan bernafas?',
                                'name' => 'difficulty_breathing',
                                'value' => $d->difficulty_breathing,
                            ],
                        ];

                        $data2 = [
                            [
                                'question' =>
                                    'Have you traveled within the last 14 days to a high-risk area (widespread community transmission)?',
                                'translation' =>
                                    'Apakah anda berpergian dalam 14  hari terakhir ke wilayah merah  penyebaran COVID-19?',
                                'name' => 'area_covid',
                                'value' => $d->area_covid,
                            ],
                            [
                                'question' =>
                                    'In the last 14 days, have you been in contact with someone who has been diagnosed with COVID-19?',
                                'translation' =>
                                    'Dalam 14 hari terakhir, apakah anda kontak dengan penderita COVID-19?',
                                'name' => 'penderita_covid',
                                'value' => $d->penderita_covid,
                            ],
                        ];
                    @endphp

                    @foreach ($data as $item)
                        <x-hrga10-checkbox :question="$item['question']" :translation="$item['translation']" :name="$item['name']" :value="$item['value']" />
                    @endforeach

                </div>

                <span>B.2 Tracing/ <x-label_ind text="Penelusuran" /></span>
                <div class="mt-3 text-sm grid gap-4 grid-rows-2 grid-cols-2 items-center">

                    @foreach ($data2 as $item)
                        <x-hrga10-checkbox :question="$item['question']" :translation="$item['translation']" :name="$item['name']" :value="$item['value']" />
                    @endforeach

                </div>
                <style>
                    .kbw-signature {
                        width: 100%;
                        height: 100px;
                    }

                    #sig canvas {

                        width: 100% !important;
                        height: auto;
                    }

                    #sig2 canvas {
                        width: 100% !important;
                        height: auto;
                    }
                </style>

                <div class="mt-3 text-sm grid gap-4 grid-cols-2 items-end float-end">
                    <div class="">
                        <label for="">Visitor/ <x-label_ind text="Pengunjung" /></label>
                        <img class="border border-black" src="{{ Storage::url($d->visitor_signature) }}" alt="">
                        <div for="">Nama/ <x-label_ind text="Name" />: {{ $d->name }}</div>
                        <div for="">Date/ <x-label_ind text="Tanggal" />: {{ $d->date }}</div>
                    </div>

                    <div>
                        <label for="">Recipient/ <x-label_ind text="Penerima" /></label>
                        <img class="border border-black" src="{{ Storage::url($d->recipient_signature) }}"
                            alt="">
                        <div for="">Nama/ <x-label_ind text="Name" />: Widani</div>
                        <div for="">Date/ <x-label_ind text="Tanggal" />: {{ $d->date }}</div>
                    </div>
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
