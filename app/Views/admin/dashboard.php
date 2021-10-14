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
                        <h5 class="card-title">Dokumen Eksternal</h5>
                        <h2><?= $jml_dokumen; ?></h2>
                        <i class="fas fa-file-alt fa-7x"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card stat-widget">
                    <div class="card-body">
                        <h5 class="card-title">Kategori Dokumen Eksternal</h5>
                        <h2><?= $jumlahKategori; ?></h2>
                        <i class="fas fa-tags fa-7x"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card stat-widget">
                    <div class="card-body">
                        <h5 class="card-title">Dokumen Internal</h5>
                        <h2><?= $jml_dokumen_intern; ?></h2>
                        <i class="fas fa-file-alt fa-7x"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card stat-widget">

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
                        <h5 class="card-title">Kategori Dokumen Eksternal</h5>
                        <canvas id="kategori">Your browser does not support the canvas element.</canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card table-widget pb-5">
                    <div class="card-body">
                        <h5 class="card-title">Kategori Dokumen Internal</h5>
                        <canvas id="status">Your browser does not support the canvas element.</canvas>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Dokumen Internal</h5>
                        <div id="dokumenInternal"></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Dokumen Eksternal</h5>
                        <div id="dokumenEksternal"></div>
                    </div>
                </div>
            </div>
        </div>
        <?= $this->endSection(); ?>
        <?= $this->section('source'); ?>
        <?php
        //dokumen eksternal
        $dataKategori = array_column($kategori, 'kategori');
        $jumlahKategori = array_column($kategori, 'jumlah');
        $dataTahun = array_column($tahun, 'tahun');
        $jumlahTahun = array_column($tahun, 'jumlah_data');

        //dokumen internal
        $JumlahDokumenInternal = array_column($kategori_internal, 'jumlah');
        $KategoriDokumenInternal = array_column($kategori_internal, 'kategori');
        $dataTahunIntern = array_column($tahunDokInternal, 'tahun');
        $jumlahTahunIntern = array_column($tahunDokInternal, 'jumlah_data');


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
                        "labels": <?= json_encode($KategoriDokumenInternal); ?>,
                        "datasets": [{
                            "label": "My First Dataset",
                            "data": <?= json_encode($JumlahDokumenInternal); ?>,
                            "backgroundColor": ["#8a75d5", "#00f7ff", "#00ff81", "#e7ff00", "#f4670b", "#8100ff", "#39b5c6"]
                        }]
                    }
                });

                var Eksternal = {
                    chart: {
                        height: 350,
                        type: 'line',
                        zoom: {
                            enabled: false
                        }
                    },
                    series: [{
                        name: "Dokumen Internal",
                        data: <?= json_encode($jumlahTahun); ?>
                    }],
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        curve: 'straight'
                    },
                    title: {
                        text: 'Jumlah Dokumen per Tahun',
                        align: 'left'
                    },
                    grid: {
                        row: {
                            colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                            opacity: 0.5
                        },
                        borderColor: 'rgba(94, 96, 110, .5)',
                        strokeDashArray: 4
                    },
                    xaxis: {
                        categories: <?= json_encode($dataTahun); ?>,
                        labels: {
                            style: {
                                colors: 'rgba(94, 96, 110, .5)'
                            }
                        }
                    }
                }

                var chart = new ApexCharts(
                    document.querySelector("#dokumenEksternal"),
                    Eksternal
                );

                chart.render();
                var Internal = {
                    chart: {
                        height: 350,
                        type: 'line',
                        zoom: {
                            enabled: false
                        }
                    },
                    series: [{
                        name: "Dokumen Internal",
                        data: <?= json_encode($jumlahTahunIntern); ?>
                    }],
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        curve: 'straight'
                    },
                    title: {
                        text: 'Jumlah Dokumen per Tahun',
                        align: 'left'
                    },
                    grid: {
                        row: {
                            colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                            opacity: 0.5
                        },
                        borderColor: 'rgba(94, 96, 110, .5)',
                        strokeDashArray: 4
                    },
                    xaxis: {
                        categories: <?= json_encode($dataTahunIntern); ?>,
                        labels: {
                            style: {
                                colors: 'rgba(94, 96, 110, .5)'
                            }
                        }
                    }
                }

                var chart = new ApexCharts(
                    document.querySelector("#dokumenInternal"),
                    Internal
                );

                chart.render();


            });
        </script>
        <?= $this->endSection(); ?>