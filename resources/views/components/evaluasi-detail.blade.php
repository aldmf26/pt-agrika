@props(['datas'])

<b><u>{{ $datas->count() }} kali pengiriman</u>, yaitu: <br></b>

@foreach ($datas as $d)
    {{ $loop->iteration }}. Terjadi pada
    {{ \Carbon\Carbon::parse($d->tanggal_ketidaksesuaian)->format('d/m/y') }} - karena :
    {{ $d->alasan }} <br>
@endforeach
