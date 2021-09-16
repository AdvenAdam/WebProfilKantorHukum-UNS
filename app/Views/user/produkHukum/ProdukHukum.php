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
<div class="row">
    <div class="col-lg-12">
        <div class="shop-tab mt-80 d-flex justify-content-center">
            <img src="assets/images/shop-border.png" alt="">
            <ul class="nav nav-pills mb-3" role="tablist">
                <?php $min = min(array_column($kategori, 'id_kategori_dokumen')); ?>
                <?php foreach ($kategori as $val) { ?>
                    <li class="nav-item">
                        <a class="nav-link <?= $val['id_kategori_dokumen'] == $min ? 'active' : ''; ?>" data-toggle="pill" href="#pills-<?= $val['id_kategori_dokumen']; ?>" role="tab"><?= $val['kategori_dokumen']; ?></a>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <div class="tab-content">
            <?php $loop = 1; ?>
            <?php foreach ($kategori as $list) { ?>
                <div class="tab-pane fade <?= $list['id_kategori_dokumen'] == $min ? 'show active' : ''; ?>" id="pills-<?= $list['id_kategori_dokumen']; ?>" role="tabpanel">
                    <div class="shop-descriptions-area">
                        <section class="cart-area pt-50 pb-140">
                            <div class="container">
                                <div class="cart-table table-responsive">
                                    <table class="table" id="example" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Judul</th>
                                                <th>Tahun</th>
                                                <th>No</th>
                                                <th>Kategori </th>
                                                <th>Lihat</th>
                                                <th>Download</th>
                                            </tr>
                                        </thead>
                                        <?php $data = "data" . $loop;
                                        ?>
                                        <?php $i = 1; ?>
                                        <tbody>
                                            <?php foreach ($$data as $value) { ?>
                                                <tr>
                                                    <td class="product-thumbnail">
                                                        <?= $i++; ?>
                                                    </td>
                                                    <td><?= $value['judul']; ?></td>
                                                    <td><?= $value['tahun']; ?></td>
                                                    <td><?= $value['no']; ?></td>
                                                    <td><?= $value['kategori_dokumen']; ?></td>
                                                    <td>
                                                        <a href="detailDokumen/<?= $value['id']; ?>" class="btn btn-primary">Lihat</a>
                                                    </td>
                                                    <td>
                                                        <a href="Download/<?= $value['id']; ?>" class="btn btn-success">Download</a>
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