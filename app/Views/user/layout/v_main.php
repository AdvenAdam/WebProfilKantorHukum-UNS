<!doctype html>
<html lang="en">

<head>

    <!--====== Required meta tags ======-->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="google-site-verification" content="8KlUerVzVhQ_kQe3Qe08KouB9WeQPfp1qW2PUh-ow3Y" />
    <!--====== Title ======-->
    <title><?= $title; ?></title>

    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="/tema/user/template/assets/images/logo/fav.jpg" type="image/png">
    <?= base_url(); ?>
    <!--====== Bootstrap css ======-->
    <link rel="stylesheet" href="/tema/user/template/assets/css/bootstrap.min.css">

    <!--====== Fontawesome Pro css ======-->
    <link rel="stylesheet" href="/tema/user/template/assets/css/all.css">

    <!--====== Magnific Popup css ======-->
    <link rel="stylesheet" href="/tema/user/template/assets/css/magnific-popup.css">

    <!--====== Slick css ======-->
    <link rel="stylesheet" href="/tema/user/template/assets/css/nice-select.css">

    <!--====== Animate css ======-->
    <link rel="stylesheet" href="/tema/user/template/assets/css/animate.min.css">

    <!--====== Slick css ======-->
    <link rel="stylesheet" href="/tema/user/template/assets/css/slick.css">

    <!--====== Default css ======-->
    <link rel="stylesheet" href="/tema/user/template/assets/css/default.css">

    <!--====== Style css ======-->
    <link rel="stylesheet" href="/tema/admin/circl/theme/assets/plugins/DataTables/datatables.min.css">
    <link rel="stylesheet" href="/tema/user/template/assets/css/style.css">


</head>

<body>
    <?= $this->include('user/layout/v_nav'); ?>
    <?= $this->renderSection('content'); ?>
    <?= $this->include('user/layout/v_footer'); ?>

    <!--====== jquery js ======-->
    <script src="/tema/user/template/assets/js/vendor/modernizr-3.6.0.min.js"></script>
    <script src="/tema/user/template/assets/js/vendor/jquery-1.12.4.min.js"></script>

    <!--====== Bootstrap js ======-->
    <script src="/tema/user/template/assets/js/bootstrap.min.js"></script>
    <script src="/tema/user/template/assets/js/popper.min.js"></script>
    <!-- datatable -->
    <script src="/tema/admin/circl/theme/assets/plugins/DataTables/datatables.min.js"></script>
    <script src="/tema/admin/circl/theme/assets/js/pages/datatables.js"></script>
    <!--====== Slick js ======-->
    <script src="/tema/user/template/assets/js/slick.min.js"></script>
    <!--====== Isotope js ======-->
    <script src="/tema/user/template/assets/js/isotope.pkgd.min.js"></script>
    <!--====== Images Loaded js ======-->
    <script src="/tema/user/template/assets/js/imagesloaded.pkgd.min.js"></script>
    <!--====== Magnific Popup js ======-->
    <script src="/tema/user/template/assets/js/jquery.magnific-popup.min.js"></script>
    <!--====== Magnific Popup js ======-->
    <script src="/tema/user/template/assets/js/jquery.counterup.min.js"></script>
    <!--====== Circle Progress js ======-->
    <script src="/tema/user/template/assets/js/circle-progress.min.js"></script>
    <!--====== Syotimer js ======-->
    <script src="/tema/user/template/assets/js/jquery.syotimer.min.js"></script>
    <!--====== Nice Select js ======-->
    <script src="/tema/user/template/assets/js/jquery.nice-select.min.js"></script>
    <!--====== wow js ======-->
    <script src="/tema/user/template/assets/js/wow.min.js"></script>
    <!--====== Magnific Popup js ======-->
    <script src="/tema/user/template/assets/js/waypoints.min.js"></script>
    <!--====== Main js ======-->
    <script src="/tema/user/template/assets/js/main.js"></script>
    <script>
        $(document).ready(function() {
            $('.datatable').DataTable({
                "aaSorting": [],
                "oLanguage": {
                    "sSearch": "",
                    "sSearchPlaceholder": "Cari",
                    "sLengthMenu": "Tampil _MENU_ data",
                    "sInfo": "Menampilkan data _START_ sampai _END_ dari _TOTAL_ data",
                    "sZeroRecords": "Data tidak Ditemukan",
                    "sInfoFiltered": " - disaring dari _MAX_ data",
                }
            });
        });
    </script>

</body>

</html>