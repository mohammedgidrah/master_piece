<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Kaiadmin - Bootstrap 5 Admin Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="{{ asset('assets/img/masterpeace_logo__1_-removebg-preview.png') }}" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="{{ asset('assets/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["{{ asset('assets/css/fonts.min.css') }}"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/kaiadmin.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />
</head>

<body>
    <div class="wrapper">
        @include('dashboard.navbar')

        <div class="main-panel">
            @yield('content') <!-- Main content area -->
            @include('dashboard.sidebar') <!-- Sidebar -->
        </div>
    </div>

    <!-- Custom Settings Template -->
    <div class="custom-template">
        <div class="title">Settings</div>
        <div class="custom-content">
            <div class="switcher">
                <!-- Logo Header Section -->
                <div class="switch-block">
                    <h4>Logo Header</h4>
                    <div class="btnSwitch">
                        <!-- Color buttons for Logo Header -->
                        @foreach (['dark', 'blue', 'purple', 'light-blue', 'green', 'orange', 'red', 'white', 'dark2', 'blue2', 'purple2', 'light-blue2', 'green2', 'orange2', 'red2'] as $color)
                        <button type="button" class="changeLogoHeaderColor" data-color="{{ $color }}"></button>
                        @endforeach
                    </div>
                    <button class="saveLogoHeaderColor">Save Logo Header Color</button>
                </div>

                <!-- Navbar Header Section -->
                <div class="switch-block">
                    <h4>Navbar Header</h4>
                    <div class="btnSwitch">
                        <!-- Color buttons for Navbar Header -->
                        @foreach (['dark', 'blue', 'purple', 'light-blue', 'green', 'orange', 'red', 'white', 'dark2', 'blue2', 'purple2', 'light-blue2', 'green2', 'orange2', 'red2'] as $color)
                        <button type="button" class="changeTopBarColor" data-color="{{ $color }}"></button>
                        @endforeach
                    </div>
                    <button class="saveTopBarColor">Save Navbar Header Color</button>
                </div>

                <!-- Sidebar Section -->
                <div class="switch-block">
                    <h4>Sidebar</h4>
                    <div class="btnSwitch">
                        <button type="button" class="changeSideBarColor" data-color="white"></button>
                        <button type="button" class="changeSideBarColor selected" data-color="dark"></button>
                        <button type="button" class="changeSideBarColor" data-color="dark2"></button>
                    </div>
                    <button class="saveSideBarColor">Save Sidebar Color</button>
                </div>
            </div>
        </div>
        <div class="custom-toggle">
            <i class="icon-settings"></i>
        </div>
    </div>

    <script>
        // Function to apply the saved colors from localStorage on page load
        function applySavedColors() {
            const savedLogoHeaderColor = localStorage.getItem('logoHeaderColor');
            const savedTopBarColor = localStorage.getItem('topBarColor');
            const savedSideBarColor = localStorage.getItem('sideBarColor');

            if (savedLogoHeaderColor) {
                document.querySelector('.logo-header').style.backgroundColor = savedLogoHeaderColor;
            }

            if (savedTopBarColor) {
                document.querySelector('.navbar-header').style.backgroundColor = savedTopBarColor;
            }

            if (savedSideBarColor) {
                document.querySelector('.sidebar').style.backgroundColor = savedSideBarColor;
            }
        }

        // Apply colors on page load
        window.addEventListener('DOMContentLoaded', applySavedColors);

        // Event listener for changing colors
        document.querySelector('.custom-content').addEventListener('click', function(e) {
            if (e.target.matches('.changeLogoHeaderColor, .changeTopBarColor, .changeSideBarColor')) {
                const groupClass = e.target.classList[0];
                document.querySelectorAll(`.${groupClass}`).forEach(button => button.classList.remove('selected'));
                e.target.classList.add('selected');
            }
        });

        // Save color functions
        function saveColor(selector, storageKey, elementClass) {
            const selectedColor = document.querySelector(`${selector}.selected`)?.getAttribute('data-color');
            if (selectedColor) {
                localStorage.setItem(storageKey, selectedColor);
                document.querySelector(elementClass).style.backgroundColor = selectedColor;
                alert(`${storageKey.replace(/([A-Z])/g, ' $1')} saved!`);
            }
        }

        document.querySelector('.saveLogoHeaderColor').addEventListener('click', function() {
            saveColor('.changeLogoHeaderColor', 'logoHeaderColor', '.logo-header');
        });

        document.querySelector('.saveTopBarColor').addEventListener('click', function() {
            saveColor('.changeTopBarColor', 'topBarColor', '.navbar-header');
        });

        document.querySelector('.saveSideBarColor').addEventListener('click', function() {
            saveColor('.changeSideBarColor', 'sideBarColor', '.sidebar');
        });
    </script>

    <!-- Core JS Files -->
    <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>

    <!-- Additional JS Files -->
    <script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/chart.js/chart.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/chart-circle/circles.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/jsvectormap/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/jsvectormap/world.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/js/kaiadmin.min.js') }}"></script>
    <script src="{{ asset('assets/js/setting-demo.js') }}"></script>
    <script src="{{ asset('assets/js/demo.js') }}"></script>

    <script>
        // Sparkline Chart example
        $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#177dff",
            fillColor: "rgba(23, 125, 255, 0.14)",
        });
        // Additional sparklines can be set up similarly
    </script>
</body>
</html>
