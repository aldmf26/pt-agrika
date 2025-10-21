{{-- <script src="{{asset('assets')}}/static/js/components/dark.js"></script> --}}
<script src="{{ asset('assets') }}/static/js/pages/horizontal-layout.js"></script>
<script src="{{ asset('assets') }}/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="{{ asset('assets') }}/extensions/toastify-js/src/toastify.js"></script>
<script src="{{ asset('assets') }}/compiled/js/app.js"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-2.1.8/datatables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('assets') }}/extensions/choices.js/public/assets/scripts/choices.js"></script>
<script src="{{ asset('assets') }}/static/js/pages/form-element-select.js"></script>

<script>
    function pencarian(inputId, tblId) {

        $(document).on('keyup', "#" + inputId, function() {
            var value = $(this).val().toLowerCase();
            $(`#${tblId} tbody tr`).filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        })

    }
    $('#tableScroll').DataTable({
        "searching": true,
        scrollY: '400px',
        scrollX: true,
        scrollCollapse: true,
        "autoWidth": true,
        "paging": false,
    });
    $('#tableSave').DataTable({
        "searching": true,

        scrollCollapse: true,
        "autoWidth": true,
        "paging": true,
        "stateSave": true
    });
    $("#example").dataTable({
        columnDefs: [{
            "defaultContent": "-",
            "targets": "_all"
        }],

    });
    $(document).ready(function() {
        $('.select2').select2({
            dropdownParent: $('#tambah'), // Ganti dengan ID modal kamu
            width: '100%'
        });

    });

    function initSelect2() {
        $('.select2-alpine').select2();
    }

    // Tunggu sampai Alpine.js diinisialisasi
    window.addEventListener('alpine:init', () => {
        Alpine.directive('select2', (el, {
            expression
        }, {
            effect
        }) => {
            effect(() => {
                // Gunakan jQuery untuk menginisialisasi Select2
                $(el).select2();

                // Event untuk menangani perubahan nilai dari Select2 ke Alpine.js
                $(el).on('change', function() {
                    Alpine.store('select2Value', $(this).val());
                });
            });
        });
    });
</script>
<script>
    function initSelect2() {
        setTimeout(() => {
            $('.select2').select2({
                dropdownParent: $('#tambah') // Ganti dengan ID modal yang sesuai
            });
        }, 100);
    }

    document.addEventListener("DOMContentLoaded", function() {
        initSelect2();
    });
</script>

<script>
    function alertToast(jenis = 'sukses', pesan) {
        var ava = jenis == 'sukses' ? "https://cdn-icons-png.flaticon.com/512/190/190411.png" :
            "https://cdn-icons-png.flaticon.com/512/564/564619.png"
        var bg = jenis == 'sukses' ? "#EAF7EE" : "#FCEDE9"
        $(document).ready(function() {
            Toastify({
                text: pesan,
                duration: 3000,
                position: "right",
                style: {
                    background: bg,
                    color: "#7F8B8B",
                    fontSize: "12px", // Menyesuaikan ukuran teks
                    padding: "12px", // Menyesuaikan jarak padding
                    borderRadius: "10px" // Menambahkan sudut elemen
                },
                close: true,
                avatar: ava
            }).showToast();
        });
    }

    document.addEventListener('livewire:initialized', () => {
        Livewire.on('showAlert', ([{
            type,
            message
        }]) => {
            alertToast(type, message);
        });
    });
</script>

@yield('scripts')
@livewireScripts
