<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no"
        name="viewport">
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <title>SIRAPAT - Sistem Informasi Rapat</title>

    <!-- General CSS Files -->
    <link rel="stylesheet"
        href="{{ asset('library/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer" />

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css" integrity="sha512-34s5cpvaNG3BknEWSuOncX28vz97bRI59UnVtEEpFX536A7BtZSJHsDyFoCl8S7Dt2TPzcrCEoHBGeM4SUBDBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Template CSS -->
    <link rel="stylesheet"
        href="{{ asset('css/style.css') }}">
    <link rel="stylesheet"
        href="{{ asset('css/components.css') }}">

    <!-- Custom CSS -->
    <style>
        .fc .fc-col-header-cell-cushion {
            color: black !important; /* Mengubah warna teks menjadi merah */
            font-weight: bold !important; /* Mengubah gaya teks */
        }
        .profile-picture {
            max-width: 100px;
            max-height: 100px; /* Sesuaikan dengan kebutuhan Anda */
            width: auto;
            height: auto;
        }
    </style>

    <style>
        body {
            background-color: #48b4c95c;
        }
    </style>

    <!-- Start GA -->
    <script async
        src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- END GA -->
    <!-- Logo -->
    <link rel="icon" href="{{ asset('/img/FIX.png') }}" type="Logo-Sirapat">
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <!-- Header -->
            @include('components.header')

            <!-- Sidebar -->
            @include('components.sidebar')

            <!-- Content -->
            @yield('main')

            @include('components.modal')

            <!-- Footer -->
            @include('components.footer')
        </div>
    </div>
    
    <!-- General JS Scripts -->
    <script src="{{ asset('library/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('library/popper.js/dist/umd/popper.js') }}"></script>
    <script src="{{ asset('library/tooltip.js/dist/umd/tooltip.js') }}"></script>
    <script src="{{ asset('library/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    
    <!-- JS Libraies -->
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/bootstrap5@6.1.11/index.global.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js" integrity="sha512-LsnSViqQyaXpD4mBBdRYeP6sRwJiJveh2ZIbW41EBrNmKxgr/LFZIiWT6yr+nycvhvauz8c2nYMhrP80YhG7Cw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <!-- General JS Scripts -->
    <script src="{{ asset('library/jquery.nicescroll/dist/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('library/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('js/stisla.js') }}"></script>
    
    
    @stack('scripts')

    <!-- JS Hari & Tanggal -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const dateElement = document.getElementById('date');
            
            const now = new Date();
            const date = now.toLocaleDateString('id-ID', {
                day: 'numeric',
                month: 'numeric',
                year: 'numeric'
            });

            dateElement.textContent = date;
        });
    </script>

    <!-- JS Modal Buat Presensi -->
    <script>
        // Ambil semua tombol "Buat Presensi"
        var buttons = document.querySelectorAll('.btn-create-presensi');

        // Tambahkan event click pada setiap tombol
        buttons.forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Mencegah pengiriman form
                var scheduleTitle = this.getAttribute('data-schedule-title');
                var confirmation = confirm('Yakin ingin membuka presensi untuk rapat ' + scheduleTitle + '?');
                if (confirmation) {
                    // Lanjutkan pengiriman form jika dikonfirmasi
                    this.closest('form').submit();
                } else {
                    // Tindakan lain jika tidak dikonfirmasi
                    // Misalnya, tidak melakukan apa pun
                }
            });
        });
    </script>

    <!-- JS Confirmation Profile -->
    <script>
        var buttons = document.querySelectorAll('.btn-update-profile');

        // Tambahkan event click pada setiap tombol
        buttons.forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Mencegah pengiriman form
                var confirmation = confirm('Yakin data yang anda masukan sudah benar?');
                if (confirmation) {
                    // Lanjutkan pengiriman form jika dikonfirmasi
                    this.closest('form').submit();
                } else {
                    // Tindakan lain jika tidak dikonfirmasi
                    // Misalnya, tidak melakukan apa pun
                }
            });
        });
    </script>

    <!-- JS Confirmation Delete -->
    <script>
        var buttons = document.querySelectorAll('.confirm-delete');

        // Tambahkan event click pada setiap tombol
        buttons.forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Mencegah pengiriman form
                var confirmation = confirm('Yakin ingin hapus data?');
                if (confirmation) {
                    // Lanjutkan pengiriman form jika dikonfirmasi
                    this.closest('form').submit();
                } else {
                    // Tindakan lain jika tidak dikonfirmasi
                    // Misalnya, tidak melakukan apa pun
                }
            });
        });
    </script>

    <!-- JS Modal Presensi -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const buttons = document.querySelectorAll('.update-status-btn');

            buttons.forEach(button => {
                button.addEventListener('click', function () {
                    const status = this.getAttribute('data-status');
                    const url = this.getAttribute('data-url');
                    const scheduleTitle = this.getAttribute('data-schedule-title'); // Ambil schedule title
                    
                    if (confirm(`${status} di Rapat ${scheduleTitle}?`)) {
                        $.ajax({
                            url: url,
                            method: 'PUT',
                            data: {
                                status: status,
                            },
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'accept': 'application/json'
                            },
                            success: function (res) {
                                location.reload();
                            },
                            error: function (xhr, status, error) {
                                alert('Terjadi kesalahan saat memperbarui status: ' + xhr.responseText);
                            }
                        });
                    }
                });
            });
        });
    </script>


    <!-- JS Modal Edit Presensi -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var editButtons = document.querySelectorAll('.edit-button');
            editButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    var id = this.dataset.id;
                    var attendanceId = this.dataset.attendance;
                    var form = document.getElementById('presenceForm');
                    
                    // Set the form action URL
                    form.action = '/presence/' + id;
                    
                    // Set the radio buttons based on the attendance ID
                    var radios = form.querySelectorAll('input[name="attendance_id"]');
                    radios.forEach(function (radio) {
                        radio.checked = radio.value == attendanceId;
                    });
                    
                    // Show the modal
                    var presenceModal = new bootstrap.Modal(document.getElementById('presenceModal'));
                    presenceModal.show();
                });
            });
        });
    </script>

    <!-- JS FullCalendar -->
    <script>
    const modal = $('#modal-action')
    const csrfToken = $('meta[name=csrf_token]').attr('content')

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                themeSystem: 'bootstrap5',
                events: `{{ route('schedule.list') }}`,
                @can('admin')
                editable: true,
                dateClick: function (info) {
                    $.ajax({
                        url: `{{ route('schedule.create') }}`,
                        data: {
                            start_date: info.dateStr,
                            end_date: info.dateStr
                        },
                        success: function (res) {
                            modal.html(res).modal('show');
                            $('.datepicker').datepicker({
                                todayHighlight: true,
                                format: 'yyyy-mm-dd'
                            });

                            $('#form-action').on('submit', function(e) {
                                e.preventDefault();
                                const form = this;
                                const formData = new FormData(form);
                                $.ajax({
                                    url: form.action,
                                    method: form.method,
                                    data: formData,
                                    processData: false,
                                    contentType: false,
                                    success: function (res) {
                                        modal.modal('hide');
                                        calendar.refetchEvents();
                                    },
                                    error: function (xhr) {
                                        const errors = xhr.responseJSON.errors;
                                        for (const field in errors) {
                                            const input = $(`[name="${field}"]`);
                                            input.addClass('is-invalid');
                                            input.next('.invalid-feedback').remove();
                                            input.after(`<div class="invalid-feedback">${errors[field][0]}</div>`);
                                        }
                                    }
                                });
                            });
                        }
                    });
                },
                @endcan
                eventClick: function ({event}) {
                    $.ajax({
                        url: `{{ url('schedule') }}/${event.id}/edit`,
                        success: function (res) {
                            modal.html(res).modal('show');
                            $('.datepicker').datepicker({
                                todayHighlight: true,
                                format: 'yyyy-mm-dd'
                            });

                            $('#form-action').on('submit', function(e) {
                                e.preventDefault();
                                const form = this;
                                const formData = new FormData(form);
                                $.ajax({
                                    url: form.action,
                                    method: form.method,
                                    data: formData,
                                    processData: false,
                                    contentType: false,
                                    success: function (res) {
                                        modal.modal('hide');
                                        calendar.refetchEvents();
                                    },
                                    error: function (xhr) {
                                        const errors = xhr.responseJSON.errors;
                                        for (const field in errors) {
                                            const input = $(`[name="${field}"]`);
                                            input.addClass('is-invalid');
                                            input.next('.invalid-feedback').remove();
                                            input.after(`<div class="invalid-feedback">${errors[field][0]}</div>`);
                                        }
                                    }
                                });
                            });
                        }
                    });
                },
                @can('admin')
                eventDrop: function (info) {
                    const event = info.event;
                    $.ajax({
                        url: `{{ url('schedule') }}/${event.id}`,
                        method: 'put',
                        data: {
                            id: event.id,
                            start_date: event.startStr,
                            end_date: event.end ? event.end.toISOString().substring(0, 10) : null,
                            title: event.title,
                            agenda: event.extendedProps.agenda,
                            category: event.extendedProps.category,
                            location: event.extendedProps.location
                        },
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            accept: 'application/json'
                        },
                        success: function (res) {
                            calendar.refetchEvents();
                        },
                        error: function (res) {
                            const message = res.responseJSON.message;
                            calendar.refetchEvents();
                            info.revert();
                        }
                    });
                },
                eventResize: function (info) {
                    const {event} = info;
                    $.ajax({
                        url: `{{ url('schedule') }}/${event.id}`,
                        method: 'put',
                        data: {
                            id: event.id,
                            start_date: event.startStr,
                            end_date: event.end.toISOString().substring(0, 10),
                            title: event.title,
                            agenda: event.extendedProps.agenda,
                            category: event.extendedProps.category,
                            location: event.extendedProps.location
                        },
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            accept: 'application/json'
                        },
                        success: function (res) {
                            calendar.refetchEvents();
                        },
                        error: function (res) {
                            const message = res.responseJSON.message;
                            calendar.refetchEvents();
                            info.revert();
                        }
                    });
                }
                @endcan
            });
            calendar.render();
        });
    </script>

    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
    
    <!-- Template JS File -->
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
</body>

</html>
