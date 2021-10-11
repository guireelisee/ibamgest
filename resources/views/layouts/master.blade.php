<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>Laravel Project @yield('title')</title>
    <!-- HTML5 Shim and Respond.js IE11 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 11]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!-- Meta -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="description" content="" />
        <meta name="keywords" content="">
        <meta name="author" content="MIAGE-L2" />
        <!-- Favicon icon -->
        <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon">

        <!-- vendor css -->
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
        @yield('css')

    </head>
    <body class="">
        <!-- [ Pre-loader ] start -->
        <div class="loader-bg">
            <div class="loader-track">
                <div class="loader-fill"></div>
            </div>
        </div>
        <!-- [ Pre-loader ] End -->

        <!-- [ navigation menu ] start -->
        @include('partials.sidebar')
        <!-- [ navigation menu ] end -->
        <!-- [ Header ] start -->
        @include('partials.navbar')
        <!-- [ Header ] end -->

        <!-- [ Main Content ] start -->
        <div class="pcoded-main-container">
            <div class="pcoded-content">
                <!-- [ breadcrumb ] start -->
                <div class="page-header">
                    <div class="page-block">
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <div class="page-header-title">
                                    <h5 class="m-b-10">@yield('page-title')</h5>
                                </div>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                                    <li class="breadcrumb-item"><a href="#">@yield('subpage-title')</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ breadcrumb ] end -->
                <!-- [ Main Content ] start -->
                <!-- page statustic card start -->
                @yield('main-content')
                <!-- page statustic card end -->
                <!-- [ Main Content ] end -->

                <!-- Warning Section start -->
                <!-- Older IE warning message -->
                <!--[if lt IE 11]>
                    <div class="ie-warning">
                        <h1>Warning!!</h1>
                        <p>You are using an outdated version of Internet Explorer, please upgrade
                            <br/>to any of the following web browsers to access this website.
                        </p>
                        <div class="iew-container">
                            <ul class="iew-download">
                                <li>
                                    <a href="http://www.google.com/chrome/">
                                        <img src="assets/images/browser/chrome.png" alt="Chrome">
                                        <div>Chrome</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.mozilla.org/en-US/firefox/new/">
                                        <img src="assets/images/browser/firefox.png" alt="Firefox">
                                        <div>Firefox</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="http://www.opera.com">
                                        <img src="assets/images/browser/opera.png" alt="Opera">
                                        <div>Opera</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.apple.com/safari/">
                                        <img src="assets/images/browser/safari.png" alt="Safari">
                                        <div>Safari</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                                        <img src="assets/images/browser/ie.png" alt="">
                                        <div>IE (11 & above)</div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <p>Sorry for the inconvenience!</p>
                    </div>
                    <![endif]-->
                    <!-- Warning Section Ends -->

                    <!-- Required Js -->
                    <script src="{{ asset('assets/js/vendor-all.min.js') }}"></script>
                    <script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
                    <script src="{{ asset('assets/js/ripple.js') }}"></script>
                    <script src="{{ asset('assets/js/pcoded.min.js') }}"></script>

                    <!-- Apex Chart -->
                    <script src="{{ asset('assets/js/plugins/apexcharts.min.js') }}"></script>
                    <!-- custom-chart js -->
                    <script src="{{ asset('assets/js/pages/dashboard-main.js') }}"></script>
                    <script>
                        $(document).ready(function() {
                            checkCookie();
                        });

                        function setCookie(cname, cvalue, exdays) {
                            var d = new Date();
                            d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
                            var expires = "expires=" + d.toGMTString();
                            document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
                        }

                        function getCookie(cname) {
                            var name = cname + "=";
                            var decodedCookie = decodeURIComponent(document.cookie);
                            var ca = decodedCookie.split(';');
                            for (var i = 0; i < ca.length; i++) {
                                var c = ca[i];
                                while (c.charAt(0) == ' ') {
                                    c = c.substring(1);
                                }
                                if (c.indexOf(name) == 0) {
                                    return c.substring(name.length, c.length);
                                }
                            }
                            return "";
                        }

                        function checkCookie() {
                            var ticks = getCookie("modelopen");
                            if (ticks != "") {
                                ticks++ ;
                                setCookie("modelopen", ticks, 1);
                                if (ticks == "2" || ticks == "1" || ticks == "0") {
                                    $('#exampleModalCenter').modal();
                                }
                            } else {
                                // user = prompt("Please enter your name:", "");
                                $('#exampleModalCenter').modal();
                                ticks = 1;
                                setCookie("modelopen", ticks, 1);
                            }
                        }
                    </script>

                    @yield('javascript')

                </body>


                </html>
