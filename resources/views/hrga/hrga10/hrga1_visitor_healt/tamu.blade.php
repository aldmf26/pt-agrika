<x-guest-layout>
    @if (session()->has('sukses'))
        <div role="alert">
            <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
                Sukses
            </div>
            <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
                <p>Data berhasil ditambahkan.</p>
            </div>
        </div>
    @endif

    <section class="mt-5 bg-primary">
        <h6 class="font-bold text-center sm:text-2xl text-sm">A. GENERAL INFORMATION/ <span class="text-gray-600">
                INFORMASI UMUM</span></h6>
    </section>

    {{-- @livewire('hrga10.form-tamu') --}}
    <form x-data="{ loading: false }" class="sm:hidden block" method="post" action="{{ route('tamu.store') }}">
        @csrf
        {{-- form mobile --}}
        <div class="">
            <div class="mb-2 grid gap-4 md:grid-cols-2">
                <div>
                    <div>Date / <x-label_ind text="Tanggal" /></div>

                    <input name='date' value="{{ date('Y-m-d') }}" type="date" class="form-control"
                        placeholder="John" required />
                </div>

                <div>
                    <div>Name / <x-label_ind text="Nama" /></div>
                    <input name='name' type="text" class="form-control" placeholder="Nama" required />
                </div>

                <div class="flex justify-between gap-2">
                    <div>In / <x-label_ind text="Masuk" /></div>
                    <div>Out / <x-label_ind text="Keluar" /></div>
                </div>

                <div class="flex justify-between gap-2">
                    <input name="time_in" type="time" class="form-control" required />
                    <input name="time_out" type="time" class="form-control" />
                </div>

                <div>
                    <div>Purpose / <x-label_ind text="Keperluan" /></div>
                    <textarea name="purpose" class="form-control" id="" cols="3" rows="3"></textarea>
                </div>
            </div>
        </div>

        <section class=" bg-primary">
            <h6 class="font-bold text-center sm:text-2xl text-sm">B. HEALTH CONDITION/ <x-label_ind
                    text="KONDISI KESEHATAN" /></h6>
        </section>

        {{-- form mobile --}}
        <div class="mt-4">
            <span>B.1 Current Health/<x-label_ind text="Kesehatan Saat ini" /></span>
            <div class="mt-3 mb-6 text-sm grid gap-4 grid-rows-6 grid-cols-2 items-center">
                @php
                    $data = [
                        ['question' => 'Do you have flu?', 'translation' => 'Apakah anda sedang flu?', 'name' => 'flu'],
                        [
                            'question' => 'Do you have cough?',
                            'translation' => 'Apakah anda sedang batuk?',
                            'name' => 'cough',
                        ],
                        [
                            'question' => 'Do you have diarhea?',
                            'translation' => 'Apakah anda sedang diare?',
                            'name' => 'diare',
                        ],
                        [
                            'question' => 'Do you have fever?',
                            'translation' => 'Apakah anda sedang demam?',
                            'name' => 'fever',
                        ],
                        [
                            'question' => 'Do you have sore throat?',
                            'translation' => 'Apakah anda sedang radang tenggorokan?',
                            'name' => 'sore_throat',
                        ],
                        [
                            'question' => 'Do you have difficulty breathing? (if any)',
                            'translation' => 'Apakah anda kesulitan bernafas?',
                            'name' => 'difficulty_breathing',
                        ],
                    ];

                    $data2 = [
                        [
                            'question' =>
                                'Have you traveled within the last 14 days to a high-risk area (widespread community transmission)?',
                            'translation' =>
                                'Apakah anda berpergian dalam 14  hari terakhir ke wilayah merah  penyebaran COVID-19?',
                            'name' => 'area_covid',
                        ],
                        [
                            'question' =>
                                'In the last 14 days, have you been in contact with someone who has been diagnosed with COVID-19?',
                            'translation' => 'Dalam 14 hari terakhir, apakah anda kontak dengan penderita COVID-19?',
                            'name' => 'penderita_covid',
                        ],
                    ];
                @endphp

                @foreach ($data as $item)
                    <x-hrga10-radio :question="$item['question']" :translation="$item['translation']" :name="$item['name']" />
                @endforeach

            </div>

            <span>B.2 Tracing/ <x-label_ind text="Penelusuran" /></span>
            <div class="mt-3 text-sm grid gap-4 grid-rows-2 grid-cols-2 items-center">
                @php
                    $data = [
                        [
                            'question' =>
                                'Have you traveled within the last 14 days to a high-risk area (widespread community transmission)?',
                            'translation' =>
                                'Apakah anda berpergian dalam 14  hari terakhir ke wilayah merah  penyebaran COVID-19?',
                            'name' => 'area_covid',
                        ],
                        [
                            'question' =>
                                'In the last 14 days, have you been in contact with someone who has been diagnosed with COVID-19?',
                            'translation' => 'Dalam 14 hari terakhir, apakah anda kontak dengan penderita COVID-19?',
                            'name' => 'penderita_covid',
                        ],
                    ];
                @endphp

                @foreach ($data as $item)
                    <x-hrga10-radio :question="$item['question']" :translation="$item['translation']" :name="$item['name']" />
                @endforeach

            </div>

            <div class="mt-3 text-sm grid gap-4 grid-cols-2 items-center">
                <div>
                    <label for="">Visitor/ <x-label_ind text="Pengunjung" /></label>
                    <div id="sig" data-signature="#sig" data-clear="#clear" data-sync="#signature64"></div>
                    <button type="button" id="clear" class="btn btn-danger">Clear</button>
                    <textarea id="signature64" name="visitor_signature" style="display: none"></textarea>
                </div>
                
                <div>
                    <label for="">Recipient/ <x-label_ind text="Penerima" /></label>
                    <div id="sig2" data-signature="#sig2" data-clear="#clear2" data-sync="#signature642"></div>
                    <button type="button" id="clear2" class="btn btn-danger">Clear</button>
                    <textarea id="signature642" name="recipient_signature" style="display: none"></textarea>
                </div>
            </div>
        </div>


        <div x-show="loading" class="flex justify-center mt-5">
            <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <style>
                    .spinner_P7sC {
                        transform-origin: center;
                        animation: spinner_svv2 .75s infinite linear
                    }

                    @keyframes spinner_svv2 {
                        100% {
                            transform: rotate(360deg)
                        }
                    }
                </style>
                <path
                    d="M10.14,1.16a11,11,0,0,0-9,8.92A1.59,1.59,0,0,0,2.46,12,1.52,1.52,0,0,0,4.11,10.7a8,8,0,0,1,6.66-6.61A1.42,1.42,0,0,0,12,2.69h0A1.57,1.57,0,0,0,10.14,1.16Z"
                    class="spinner_P7sC" />
            </svg>
        </div>

        <button class="btn-submit" type="submit" onclick="this.disabled=true; this.form.submit()">
            Simpan
        </button>
    </form>




</x-guest-layout>
