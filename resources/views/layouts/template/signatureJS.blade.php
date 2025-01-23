{{-- ttd scripts --}}
<script>
    $(document).ready(function () {
        // Fungsi untuk inisialisasi signature pad
        function initializeSignature(selector, clearButton, syncField) {
            // Inisialisasi signature pad
            var signaturePad = $(selector).signature({
                syncField: syncField,
                syncFormat: 'PNG',
            });

            // Event untuk tombol clear
            $(clearButton).click(function (e) {
                e.preventDefault();
                signaturePad.signature('clear'); // Clear canvas
                $(syncField).val(''); // Clear hidden textarea
            });

            return signaturePad;
        }

        // Cari semua elemen signature yang memiliki atribut data-signature
        $('[data-signature]').each(function () {
            var signatureId = $(this).data('signature'); // ID untuk elemen tanda tangan
            var clearButton = $(this).data('clear'); // ID untuk tombol clear
            var syncField = $(this).data('sync'); // ID untuk hidden textarea

            // Inisialisasi signature pad
            initializeSignature(signatureId, clearButton, syncField);
        });
    });
</script>