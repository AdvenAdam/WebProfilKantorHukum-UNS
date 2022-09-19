<?= $this->extend('user/layout/v_main'); ?>
<?= $this->section('content'); ?>
<!--====== PAGE TITLE PART START ======-->

<div class="page-title-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-title-item text-center">
                    <h2 class="title">Detail Dokumen</h2>
                </div> <!-- page title -->
            </div>
        </div> <!-- row -->
    </div> <!-- container -->
</div>

<!--====== PAGE TITLE PART ENDS ======-->

<!--====== Dokumen Detail START ======-->

<div class="shop-details-area pt-10 pb-115 gray-bg">
    <div class="container">
        <?php if (session()->getFlashData('danger')) { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session()->getFlashData('danger') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php } ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="shop-descriptions-area">
                            <h3 class="title">Detail "<?= strtoupper($dokumen['judul']); ?>"</h3>
                            <div class="shop-descriptions-list d-flex">
                                <ul class="shop-list-1">
                                    <li>Judul</li>
                                </ul>
                                <ul class="shop-list-2">
                                    <li><?= strtoupper($dokumen['judul']); ?></li>
                                </ul>
                            </div>
                            <div class="shop-descriptions-list d-flex">
                                <ul class="shop-list-1">
                                    <li>Kategori Dokumen</li>
                                </ul>
                                <ul class="shop-list-2">
                                    <li><?= $dokumen['kategori_dokumen']; ?></li>
                                </ul>
                            </div>
                            <div class="shop-descriptions-list d-flex">
                                <ul class="shop-list-1">
                                    <li>Berlaku Mulai</li>
                                </ul>
                                <ul class="shop-list-2">
                                    <li><?= $dokumen['berlaku'] == '0000-00-00' ? '-' : format_indo($dokumen['berlaku']); ?></li>
                                </ul>
                            </div>
                            <div class="shop-descriptions-list d-flex">
                                <ul class="shop-list-1">
                                    <li>Berlaku Sampai</li>
                                </ul>
                                <ul class="shop-list-2">
                                    <li><?= $dokumen['sampai'] == '0000-00-00' ? '-' : format_indo($dokumen['sampai']); ?></li>
                                </ul>
                            </div>
                            <div class="shop-descriptions-list d-flex">
                                <ul class="shop-list-1">
                                    <li>Status</li>
                                </ul>
                                <ul class="shop-list-2">
                                    <li><?php if ($dokumen['status'] == 1) { ?>
                                            <span style="color:white;" class="badge rounded-pill bg-success">Berlaku</span>
                                        <?php } else if ($dokumen['status'] == 2) { ?>
                                            <span style="color:white;" class="badge rounded-pill bg-danger">Tidak Berlaku</span>
                                        <?php } else { ?>
                                            <span style="color:white;" class="badge rounded-pill bg-primary">Peraturan Tetap</span>
                                        <?php } ?>
                                    </li>
                                </ul>
                            </div>

                            <div class="shop-descriptions-list d-flex">
                                <ul class="shop-list-1">
                                    <li>Download PDF</li>
                                </ul>
                                <ul class="shop-list-2">
                                    <li><a href="/Download/<?= $dokumen['id']; ?>" class="btn btn-success">Download</a></li>
                                </ul>
                            </div>
                            <h3 class="title">File Dokumen</h3>
                            <embed type="application/pdf" src="/dokumen/<?= $dokumen['kategori_dokumen']; ?>/<?= $dokumen['dokumen']; ?>" width="100%" height="750"></embed>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!--====== Dokumen Detail ENDS ======-->
<?= $this->endSection(); ?>