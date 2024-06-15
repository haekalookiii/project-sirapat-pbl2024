<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no"
        name="viewport">
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <title>@yield('title') &mdash; SIRAPAT-Sistem Informasi Rapat</title>

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
    
    <!-- General JS Scripts -->
    <script src="{{ asset('library/jquery.nicescroll/dist/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('library/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('js/stisla.js') }}"></script>
    
    
    @stack('scripts')

    <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>// message with sweetalert
        @if(session('success'))
            Swal.fire({
                icon: "success",
                title: "BERHASIL",
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
            @elseif(session('error'))
            Swal.fire({
                icon: "error",
                title: "GAGAL!",
                text: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @endif
    </script> -->

    <!-- JS Hari & Tanggal -->
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const dayElement = document.getElementById('day');
        const dateElement = document.getElementById('date');
        
        const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        const now = new Date();
        const day = days[now.getDay()];
        const date = now.toLocaleDateString('id-ID', {
            day: 'numeric',
            month: 'long',
            year: 'numeric'
        });

        dayElement.textContent = day;
        dateElement.textContent = date;
    });
    </script>

    <!-- JS Modal Presensi -->
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const confirmationModal = document.getElementById('confirmationModalPresence');
        const statusText = document.getElementById('presenceStatusText');
        const confirmButton = document.getElementById('confirmPresenceButton');

        document.querySelectorAll('.show-confirmation-modal').forEach(button => {
            button.addEventListener('click', function () {
                const status = this.getAttribute('data-status');
                const url = this.getAttribute('data-url');
                const attendanceId = this.getAttribute('data-attendance-id');

                statusText.textContent = status;

                // Mengatur action pada tombol konfirmasi modal
                confirmButton.onclick = function () {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = url;

                    const hiddenMethod = document.createElement('input');
                    hiddenMethod.type = 'hidden';
                    hiddenMethod.name = '_method';
                    hiddenMethod.value = 'PUT';

                    const hiddenToken = document.createElement('input');
                    hiddenToken.type = 'hidden';
                    hiddenToken.name = '_token';
                    hiddenToken.value = '{{ csrf_token() }}';

                    const hiddenAttendanceId = document.createElement('input');
                    hiddenAttendanceId.type = 'hidden';
                    hiddenAttendanceId.name = 'attendance_id';
                    hiddenAttendanceId.value = attendanceId;

                    form.appendChild(hiddenMethod);
                    form.appendChild(hiddenToken);
                    form.appendChild(hiddenAttendanceId);

                    document.body.appendChild(form);
                    form.submit();
                };

                $(confirmationModal).modal('show');
            });
        });
    });
</script>

    <!-- JS Confirmation Profile -->
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const confirmationModalProfile = document.getElementById('confirmationModalProfile');
        const confirmUpdateButton = document.getElementById('confirmUpdateButton');
        const openConfirmationModalProfile = document.getElementById('openConfirmationModalProfile');

        openConfirmationModalProfile.addEventListener('click', function () {
            $('#confirmationModalProfile').modal('show');
        });

        confirmUpdateButton.addEventListener('click', function () {
            document.getElementById('updateProfileForm').submit();
        });
    });
</script>


    <!-- JS FullCalendar -->
    <script>
    const modal = $('#modal-action');
    const csrfToken = $('meta[name=csrf_token]').attr('content')

    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            themeSystem: 'bootstrap5',
            events: '{{ route('schedule.list') }}',
            @can('admin')
            editable: true,
            dateClick: function(info) {
                console.log(info);
                $.ajax({
                    url: '{{ route('schedule.create') }}',
                    data: {
                        start_date: info.dateStr,
                        end_date: info.dateStr
                    },
                    success: function(res) {
                        modal.html(res).modal('show');

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
                                success: function(res) {
                                    modal.modal('hide');
                                    calendar.refetchEvents();
                                }
                            });
                        });
                    }
                });
            },
            eventClick: function({ event }) {
                console.log(event.id);  // Debugging
                $.ajax({
                    url: `{{ url('schedule') }}/${event.id}/edit`,
                    success: function(res) {
                        modal.html(res).modal('show');

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
                                success: function(res) {
                                    modal.modal('hide');
                                    calendar.refetchEvents();
                                }
                            });
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                    }
                });
            },
            eventDrop:function ({event}) {
                $.ajax({
                    url: `{{ url('schedule') }}/${event.id}`,
                    method: 'put',
                    data: {
                        id: event.id,
                        start_date: event.startStr,
                        end_date: event.end.toISOString().substring(0, 10),
                        title: event.title,
                        category: event.extendedProps.category
                    },
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        accept: 'application/json'
                    },
                    success: function (res) {
                        modal.modal('hide')
                    }
                })
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
