<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Upperclass Birdnest</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        @media (max-width: 768px) {
            .logo {
                width: 50%;
            }

            .priceList {
                display: none;
            }

            .bg-image {
                background-image: url('{{ asset('assets/images/cover.png') }}');
            }
        }

        @media (min-width: 769px) {
            .logo {
                width: 20%;
            }

            .bg-image {
                background-image: url('{{ asset('assets/images/cover3.jpg') }}');
            }

        }

        .bg-image {
            height: 100vh;
            background-size: cover;
            background-position: center;
            object-fit: none;
        }

        .gambar {
            width: 9cm;
            height: 9cm;
        }

        .gambar2 {
            width: 10cm;
            height: 9cm;
        }

        .gambar2-hp {
            width: 8cm;
            height: 7cm;
        }


        .contact-info span {
            font-size: 18px;
        }

        .contact-info p {
            font-size: 18px;
        }
    </style>

</head>

<body>
    <div class="bg-image align-items-center">
        <div class="d-none d-md-flex gap-5 px-5 d-flex justify-content-between align-items-center">
            <div>
                <img class="logo" src="{{ asset('assets/images/logoupper.png') }}" alt="">
            </div>
            <div style="width: 15%">
                <h3 class="text-white">PRICE LIST</h3>
            </div>
        </div>
        
        <div class="d-none d-md-flex px-5 mx-3">
            <div class="text-white ">
                <h5 style="margin-bottom: 10px">UPPERCLASS BIRDNEST</h5>
                <h2>A Healty Outside <br> Starts From The Inside</h2>
            </div>
        </div>

        <div class="d-md-none text-center">
            <div>
                <img class="logo" src="{{ asset('assets/images/logoupper.png') }}" alt="">
                <h5 class="text-white">PRICE LIST</h5>
            </div>
            <div class="px-5 mx-3">
                <div class="text-white text-center">
                    <h5 style="margin-bottom: 10px">UPPERCLASS BIRDNEST</h5>
                    <h2>A Healty Outside <br> Starts From The Inside</h2>
                </div>
            </div>
        </div>

    </div>

    <div id="hal2" style="background-color: #cae8ff">
        <h6>&nbsp;</h6>
        @php
            $data = [
                [
                    'nama' => 'Upperclass Birdnest - 150ml',
                    'harga' => 'Rp 195.000 / Botol',
                    'bonus' => 'Pembelian Minimal 2 botol Bonus : <br> Box, Paperbag, dan Greeting card',
                    'gambar' => [asset('assets/images/1.jpeg'), asset('assets/images/2.jpeg')],
                ],
                [
                    'nama' => 'Upperclass Birdnest - 80ml',
                    'harga' => 'Rp 108.000 / Botol',
                    'bonus' => 'Pembelian Minimal 3 botol Bonus : <br> Box, Paperbag, dan Greeting card',
                    'gambar' => [asset('assets/images/3.jpeg'), asset('assets/images/4.jpeg')],
                ],
            ];
        @endphp

        @foreach ($data as $value)
            <div class="mt-4 d-flex flex-column flex-md-row gap-4 justify-content-center align-items-center">
                <div class="text-center text-md-left">
                    <h3>{{ $value['nama'] }}</h3>
                    <h4>{{ $value['harga'] }}</h4>
                    <h6>{!! $value['bonus'] !!}</h6>
                </div>
                @foreach ($value['gambar'] as $gambar)
                    <div>
                        <img class="gambar rounded-3" src="{{ $gambar }}" alt="">
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>

    <div id="hal3" style="background-clip: #ffffff">
        <div class="d-flex flex-column flex-md-row gap-5 p-5 justify-content-center align-items center">
            <div class="crop d-none d-md-block">
                <img class="gambar2 rounded-3" src="{{ asset('assets/images/6.jpeg') }}" alt="">
            </div>
            <div>
                <h3 class="fw-bold">Contact Us & Order Now</h3>
                <br>
                <div class="contact-info" style="line-height: 20px">
                    <span style="color:#878681">EMAIL :</span>
                    <p class="fw-bold">upperclassbirdnest@gmail.com</p>
                    <span style="color:#878681">INSTAGRAM :</span>
                    <p class="fw-bold">@upperclassbirdnest</p>
                    <span style="color:#878681">SHOPEE :</span>
                    <p class="fw-bold">Upperclass Birdnest</p>
                    <span style="color:#878681">WEBSITE :</span>
                    <p class="fw-bold">www.upperclassindonesia.com</p>
                </div>

                <span style="color:#878681">PHONE :</span>
                <p class="fw-bold">0811-5088-883</p>
            </div>
            <div class="crop d-block d-md-none">
                <img class="gambar2-hp rounded-3" src="{{ asset('assets/images/6.jpeg') }}" alt="">
            </div>
        </div>
    </div>

</body>

</html>
