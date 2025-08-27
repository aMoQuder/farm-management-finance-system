<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <title>NewLand</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Styles -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

</head>

<body>

    <!-- welcome devolper -->
    <!-- ======================  -->
    <!-- ------------------------------------------------------------------------------------------------------------  -->
    <!-- start project -->


    <!-- Fullscreen Loading Spinner -->
    <div id="global-loader">
        <div class="spinner-border text-primary" style="width: 60px; height: 60px;" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <!-- End Sized spinners -->
    @include('temp.Navbar')

    <div id="app">
        <main id="main" class="main">
            @yield('content')
        </main>
    </div>

    @include('temp.footer')


    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>


    <!-- end project -->
    <!-- ------------------------------------------------------------------------------------------------------------- -->


    <!-- Vendor JS Files -->



    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>


    <script>
        // ---------------------------------------------------
        // form of attends
        // ---------------------------------------------------

        document.addEventListener('DOMContentLoaded', function() {

            // عرض التاريخ
            const today = new Date();
            const formattedDate = today.getFullYear() + '-' + (today.getMonth() + 1).toString().padStart(2, '0') +
                '-' + today.getDate().toString().padStart(2, '0');
            document.getElementById('currentDate').textContent = formattedDate;

            // تحديد الكل بناءً على الهيدر
            document.querySelectorAll('.check-all').forEach(radio => {
                radio.addEventListener('change', function() {
                    if (this.checked) {
                        let value = this.value;
                        document.querySelectorAll('.worker-radio').forEach(workerRadio => {
                            if (workerRadio.value === value) {
                                workerRadio.checked = true;
                            }
                        });
                    }
                });
            });

            // لو المستخدم غير اختيار موظف واحد، نعطل الاختيار الجماعي
            document.querySelectorAll('.worker-radio').forEach(workerRadio => {
                workerRadio.addEventListener('change', function() {
                    document.querySelectorAll('.check-all').forEach(mainRadio => {
                        mainRadio.checked = false;
                    });
                });
            });

            // زر الإلغاء: إلغاء كل التحديدات
            document.getElementById('resetSelection').addEventListener('click', function() {
                document.querySelectorAll('input[type=radio]').forEach(radio => {
                    radio.checked = false;
                });
            });

        });

        // ---------------------------------------------------
        // form of attends
        // ---------------------------------------------------
    </script>
    <script>
        // -----------------------------------------
        // spinner
        // -----------------------------------------
        document.addEventListener("DOMContentLoaded", function() {
            setTimeout(() => {
                const loader = document.getElementById("global-loader");
                loader.classList.add("hidden");
            }, 800);
        });
        // -----------------------------------------
        // spinner
        // -----------------------------------------
    </script>

</body>

</html>
