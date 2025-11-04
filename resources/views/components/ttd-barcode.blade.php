@props([
    'size' => '80',
    'id_pegawai' => null,
])
<span>{!! QrCode::size($size)->generate(route('verify-ttd', $id_pegawai)) !!}</span>
