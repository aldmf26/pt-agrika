<x-hccp-print :title="$title" :dok="$dok">
    <table class="mt-5">
        <tbody>
            <tr>
                <th>Departemen</th>
                <th>:</th>
                <th>{{ ucwords(strtolower($departemen)) }}</th>
            </tr>
            <tr>
                <th>Waktu Audit Internal</th>
                <th>:</th>
                <th>-</th>
            </tr>
            <tr>
                <th>Nama Auditor</th>
                <th>:</th>
                <th>-</th>
            </tr>
            <tr>
                <th>Nama Auditee</th>
                <th>:</th>
                <th>-</th>
            </tr>
        </tbody>
    </table>
</x-hccp-print>
