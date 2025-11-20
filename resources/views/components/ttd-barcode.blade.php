@props([
    'size' => '80',
    'id_pegawai' => null,
])
<span>
    <img src="data:image/png;base64,{!! base64_encode(QrCode::format('png')->size($size)->generate(route('verify-ttd', $id_pegawai))) !!}">
</span>
