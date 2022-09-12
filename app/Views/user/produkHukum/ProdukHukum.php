<?= $this->extend('user/layout/v_main'); ?>
<?= $this->section('content'); ?>
<!--====== LATEST NEWS PART START ======-->

<div class="latest-news-area gray-bg pb-10 mt-150">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section-title text-center">
                    <span>Kantor Hukum Universitas Sebelas Maret</span>
                    <h4 class="title">Produk Hukum</h4>
                </div> <!-- sction title -->
            </div>
        </div> <!-- row -->
    </div> <!-- container -->
</div>
<?php $min = min(array_column($kategori, 'id_kategori_dokumen')); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="shop-tab mt-80 d-flex justify-content-center">
            <img src="assets/images/shop-border.png" alt="">
            <ul class="nav nav-pills mb-3" role="tablist">
                <?php foreach ($kategori as $val) { ?>
                    <li class="nav-item">
                        <a class="nav-link <?= $val['id_kategori_dokumen'] == $min ? 'active' : ''; ?>" data-toggle="pill" href="#pills-<?= $val['id_kategori_dokumen']; ?>" role="tab"><?= $val['kategori_dokumen']; ?></a>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <div class="tab-content" id="tab_content">
            <?php $loop = 1; ?>
            <?php foreach ($kategori as $list) { ?>
                <div class="tab-pane fade <?= $list['id_kategori_dokumen'] == $min ? 'show active' : ''; ?>" id="pills-<?= $list['id_kategori_dokumen']; ?>" role="tabpanel">
                    <div class="shop-descriptions-area">
                        <section class="cart-area pt-50 pb-140">
                            <div class="container">
                                <div class="cart-table table-responsive">
                                    <table class="table datatable" id="example" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th style="width: 539px;">Judul</th>
                                                <th>Tahun</th>
                                                <th>Berlaku Mulai</th>
                                                <!-- <th>Lihat</th> -->
                                                <th>Download</th>
                                            </tr>
                                        </thead>
                                        <?php $data = "data" . $loop;
                                        ?>
                                        <?php $i = 1; ?>
                                        <tbody>
                                            <?php foreach ($$data as $value) { ?>
                                                <tr>
                                                    <td>
                                                        <?= $value['no']; ?>
                                                    </td>
                                                    <td><?= strtoupper($value['judul']); ?></td>
                                                    <td><?= ($value['tahun']); ?></td>
                                                    <td><?= $value['berlaku'] == "0000-00-00" ? '-' : format_indo($value['berlaku']); ?></td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <a href="detailDokumen/<?= $value['id']; ?>" class="btn btn-primary" target="_blank">Lihat</a>
                                                            <a href="Download/<?= $value['id']; ?>" class="btn btn-success">Unduh</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
                <?php $loop++ ?>
            <?php } ?>
        </div>
    </div>
</div>
<!--====== LATEST NEWS PART ENDS ======-->
<?= $this->endSection(); ?>

<script>
    var header = document.getElementById("navigation_pane");
    var btns = header.getElementsByClassName("a");
    for (var i = 0; i < btns.length; i++) {
        btns[i].addEventListener("click", function() {
            alert("Shier");
            var current = document.getElementsByClassName("active");
            current[0].className = current[0].className.replace(" active", "");
            this.className += " active";
        });
    }
</script>
<script>
    var header = document.getElementById("tab_content");
    var btns = header.getElementsByClassName("tab-pane");
    for (var j = 0; j < btns.length; j++) {
        btns[j].addEventListener("click", function() {
            var current = document.getElementsByClassName("show active");
            current[0].className = current[0].className.replace(" show active", "");
            this.className += " show active";
        });
    }
</script>