<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Kaiadmin - Bootstrap 5 Admin Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="assets/img/masterpeace_logo__1_-removebg-preview.png" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="assets/js/plugin/webfont/webfont.min.js"></script>
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
                urls: ["assets/css/fonts.min.css"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/plugins.min.css" />
    <link rel="stylesheet" href="assets/css/kaiadmin.min.css" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="assets/css/demo.css" />
</head>

<body>

    <div class="wrapper">
        {{-- <div class="main-panel"> --}}
        {{-- <div class="main-header"> --}}
        {{-- navegation bar  --}}
        @include('dashboard.navbar')
        {{-- end navegation bar --}}

        {{-- all of the work --}}
        @yield('content')
        {{-- end all of the work --}}

        {{-- sidebar --}}
        @include('dashboard.sidebar')
    </div>
    {{-- </div> --}}
    {{-- </div> --}}

    {{-- end sidebar --}}
    <div class="custom-template">
        <div class="title">Settings</div>
        <div class="custom-content">
            <div class="switcher">
                <!-- Logo Header Section -->
                <div class="switch-block">
                    <h4>Logo Header</h4>
                    <div class="btnSwitch">
                        <button type="button" class="selected changeLogoHeaderColor" data-color="dark"></button>
                        <button type="button" class="changeLogoHeaderColor" data-color="blue"></button>
                        <button type="button" class="changeLogoHeaderColor" data-color="purple"></button>
                        <button type="button" class="changeLogoHeaderColor" data-color="light-blue"></button>
                        <button type="button" class="changeLogoHeaderColor" data-color="green"></button>
                        <button type="button" class="changeLogoHeaderColor" data-color="orange"></button>
                        <button type="button" class="changeLogoHeaderColor" data-color="red"></button>
                        <button type="button" class="changeLogoHeaderColor" data-color="white"></button>
                        <br />
                        <button type="button" class="changeLogoHeaderColor" data-color="dark2"></button>
                        <button type="button" class="changeLogoHeaderColor" data-color="blue2"></button>
                        <button type="button" class="changeLogoHeaderColor" data-color="purple2"></button>
                        <button type="button" class="changeLogoHeaderColor" data-color="light-blue2"></button>
                        <button type="button" class="changeLogoHeaderColor" data-color="green2"></button>
                        <button type="button" class="changeLogoHeaderColor" data-color="orange2"></button>
                        <button type="button" class="changeLogoHeaderColor" data-color="red2"></button>
                    </div>
                    <!-- Save button for Logo Header -->
                    <button class="saveLogoHeaderColor">Save Logo Header Color</button>
                </div>

                <!-- Navbar Header Section -->
                <div class="switch-block">
                    <h4>Navbar Header</h4>
                    <div class="btnSwitch">
                        <button type="button" class="changeTopBarColor" data-color="dark"></button>
                        <button type="button" class="changeTopBarColor" data-color="blue"></button>
                        <button type="button" class="changeTopBarColor" data-color="purple"></button>
                        <button type="button" class="changeTopBarColor" data-color="light-blue"></button>
                        <button type="button" class="changeTopBarColor" data-color="green"></button>
                        <button type="button" class="changeTopBarColor" data-color="orange"></button>
                        <button type="button" class="changeTopBarColor" data-color="red"></button>
                        <button type="button" class="selected changeTopBarColor" data-color="white"></button>
                        <br />
                        <button type="button" class="changeTopBarColor" data-color="dark2"></button>
                        <button type="button" class="changeTopBarColor" data-color="blue2"></button>
                        <button type="button" class="changeTopBarColor" data-color="purple2"></button>
                        <button type="button" class="changeTopBarColor" data-color="light-blue2"></button>
                        <button type="button" class="changeTopBarColor" data-color="green2"></button>
                        <button type="button" class="changeTopBarColor" data-color="orange2"></button>
                        <button type="button" class="changeTopBarColor" data-color="red2"></button>
                    </div>
                    <!-- Save button for Navbar Header -->
                    <button class="saveTopBarColor">Save Navbar Header Color</button>
                </div>

                <!-- Sidebar Section -->
                <div class="switch-block">
                    <h4>Sidebar</h4>
                    <div class="btnSwitch">
                        <button type="button" class="changeSideBarColor" data-color="white"></button>
                        <button type="button" class="selected changeSideBarColor" data-color="dark"></button>
                        <button type="button" class="changeSideBarColor" data-color="dark2"></button>
                    </div>
                    <!-- Save button for Sidebar -->
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
            // Check if the clicked element is one of the color buttons
            if (e.target.matches('.changeLogoHeaderColor, .changeTopBarColor, .changeSideBarColor')) {
                // Remove 'selected' class from all buttons in the same group
                const groupClass = e.target.classList.contains('changeLogoHeaderColor') ? 'changeLogoHeaderColor' :
                    e.target.classList.contains('changeTopBarColor') ? 'changeTopBarColor' :
                    'changeSideBarColor';

                document.querySelectorAll(`.${groupClass}`).forEach(button => {
                    button.classList.remove('selected');
                });

                // Add 'selected' class to the clicked button
                e.target.classList.add('selected');
            }
        });

        // Save logo header color
        document.querySelector('.saveLogoHeaderColor').addEventListener('click', function() {
            const selectedColor = document.querySelector('.changeLogoHeaderColor.selected')?.getAttribute(
                'data-color');
            if (selectedColor) {
                localStorage.setItem('logoHeaderColor', selectedColor);
                document.querySelector('.logo-header').style.backgroundColor = selectedColor;
                alert('Logo Header Color saved!');
            }
        });

        // Save navbar header color
        document.querySelector('.saveTopBarColor').addEventListener('click', function() {
            const selectedColor = document.querySelector('.changeTopBarColor.selected')?.getAttribute('data-color');
            if (selectedColor) {
                localStorage.setItem('topBarColor', selectedColor);
                document.querySelector('.navbar-header').style.backgroundColor = selectedColor;
                alert('Navbar Header Color saved!');
            }
        });

        // Save sidebar color
        document.querySelector('.saveSideBarColor').addEventListener('click', function() {
            const selectedColor = document.querySelector('.changeSideBarColor.selected')?.getAttribute(
            'data-color');
            if (selectedColor) {
                localStorage.setItem('sideBarColor', selectedColor);
                document.querySelector('.sidebar').style.backgroundColor = selectedColor;
                alert('Sidebar Color saved!');
            }
        });
    </script>
    </div>
    </div>









    <!--   Core JS Files   -->
    <script src="assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

    <!-- Chart JS -->
    <script src="assets/js/plugin/chart.js/chart.min.js"></script>

    <!-- jQuery Sparkline -->
    <script src="assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

    <!-- Chart Circle -->
    <script src="assets/js/plugin/chart-circle/circles.min.js"></script>

    <!-- Datatables -->
    <script src="assets/js/plugin/datatables/datatables.min.js"></script>

    <!-- Bootstrap Notify -->
    <script src="assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

    <!-- jQuery Vector Maps -->
    <script src="assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
    <script src="assets/js/plugin/jsvectormap/world.js"></script>

    <!-- Sweet Alert -->
    <script src="assets/js/plugin/sweetalert/sweetalert.min.js"></script>

    <!-- Kaiadmin JS -->
    <script src="assets/js/kaiadmin.min.js"></script>

    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    <script src="assets/js/setting-demo.js"></script>
    <script src="assets/js/demo.js"></script>
    <script>
        $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#177dff",
            fillColor: "rgba(23, 125, 255, 0.14)",
        });

        $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#f3545d",
            fillColor: "rgba(243, 84, 93, .14)",
        });

        $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#ffa534",
            fillColor: "rgba(255, 165, 52, .14)",
        });
    </script>
</body>

</html>
