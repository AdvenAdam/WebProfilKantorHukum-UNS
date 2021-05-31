<?= $this->extend('/admin/layout/main'); ?>
<?= $this->section('content'); ?>
<div class="page-content">
    <div class="main-wrapper">
        <div class="row">
            <div class="col-md-6 col-xl-3">
                <div class="card stat-widget">
                    <div class="card-body">
                        <h5 class="card-title">User</h5>
                        <i class="fas fa-user fa-7x"></i>
                        <h2><?= count($user); ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card stat-widget">
                    <div class="card-body">
                        <h5 class="card-title">Dokumen</h5>
                        <h2><?= $jml_dokumen; ?></h2>
                        <i class="fas fa-file-alt fa-7x"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card stat-widget">
                    <div class="card-body">
                        <h4 class="card-title">Pengunjung</h4>
                        <h2>7.4K</h2>
                        <i class="fas fa-eye fa-7x"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card stat-widget">
                    <div class="card-body">
                        <h5 class="card-title">Kategori Dokumen</h5>
                        <h2><?= $jumlahKategori; ?></h2>
                        <i class="fas fa-tags fa-7x"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-4">
                <div class="card stat-widget">
                    <div class="card-body">
                        <h5 class="card-title">User List</h5>
                        <?php foreach ($usertampil as $list) { ?>
                            <div class="transactions-list">
                                <div class="tr-item">
                                    <div class="tr-company-name">
                                        <img src="/image/foto/<?= $list['foto']; ?>" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover; object-position: center;" alt="">
                                        <div class="tr-text" style="padding-left: 10px;">
                                            <a href="#">
                                                <h4><?= $list['username']; ?></h4>
                                            </a>
                                            <p><?= $list['email']; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card table-widget pb-5">
                    <div class="card-body">
                        <h5 class="card-title">Kategori Dokumen</h5>
                        <canvas id="kategori">Your browser does not support the canvas element.</canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card table-widget pb-5">
                    <div class="card-body">
                        <h5 class="card-title">Status Dokumen</h5>
                        <canvas id="status">Your browser does not support the canvas element.</canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-8" style="margin: 0px auto;">
                <div class="card table-widget pb-5">
                    <div class="card-body">
                        <h5 class="card-title">Tahun Dokumen</h5>
                        <canvas id="chartTahun">Your browser does not support the canvas element.</canvas>
                    </div>
                </div>
            </div>

        </div>
        <?= $this->endSection(); ?>
        <?= $this->section('source'); ?>
        <?php
        $dataKategori = array_column($kategori, 'kategori');
        $jumlahKategori = array_column($kategori, 'jumlah');

        $dataTahun = array_column($tahun, 'tahun');
        $jumlahTahun = array_column($tahun, 'jumlah_data');

        $jumlahStatus  = array_column($status, 'jumlah_data');
        ?>
        <script>
            $(document).ready(function() {

                "use strict";

                new Chart(document.getElementById("kategori"), {
                    "type": "doughnut",
                    "data": {
                        "labels": <?= json_encode($dataKategori); ?>,
                        "datasets": [{
                            "label": "My First Dataset",
                            "data": <?= json_encode($jumlahKategori); ?>,
                            "backgroundColor": ["#8a75d5", "#00f7ff", "#00ff81", "#e7ff00", "#f4670b", "#8100ff", "#39b5c6"]
                        }]
                    }
                });
                new Chart(document.getElementById("status"), {
                    "type": "doughnut",
                    "data": {
                        "labels": ['Berlaku', 'Tidak Berlaku', 'Peraturan Tetap'],
                        "datasets": [{
                            "label": "My First Dataset",
                            "data": <?= json_encode($jumlahStatus); ?>,
                            "backgroundColor": ["#8a75d5", "#00f7ff", "#00ff81", "#e7ff00", "#f4670b", "#8100ff", "#39b5c6"]
                        }]
                    }
                });
                new Chart(document.getElementById("chartTahun"), {
                    "type": "bar",
                    "data": {
                        "labels": <?= json_encode($dataTahun); ?>,
                        "datasets": [{
                            "label": "jumlaah Dokumen",
                            "data": <?= json_encode($jumlahTahun); ?>,
                            "fill": false,
                            "backgroundColor": ["rgba(255, 99, 132, 0.2)", "rgba(255, 159, 64, 0.2)", "rgba(255, 205, 86, 0.2)", "rgba(75, 192, 192, 0.2)", "rgba(54, 162, 235, 0.2)", "rgba(153, 102, 255, 0.2)", "rgba(201, 203, 207, 0.2)"],
                            "borderColor": ["rgb(255, 99, 132)", "rgb(255, 159, 64)", "rgb(255, 205, 86)", "rgb(75, 192, 192)", "rgb(54, 162, 235)", "rgb(153, 102, 255)", "rgb(201, 203, 207)"],
                            "borderWidth": 1
                        }]
                    },
                    "options": {
                        "scales": {
                            "yAxes": [{
                                "ticks": {
                                    "beginAtZero": true
                                }
                            }]
                        }
                    }
                });

            });
        </script>
        <?= $this->endSection(); ?>