<?= $this->extend('user/layout/v_main'); ?>
<?= $this->section('content'); ?>
<!--====== PAGE TITLE PART START ======-->

<div class="page-title-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-title-item text-center">
                    <h3 class="title"> Informasi Struktur Organisasi Kantor Hukum UNS</h3>
                </div> <!-- page title -->
            </div>
        </div> <!-- row -->
    </div> <!-- container -->
</div>

<!--====== PAGE TITLE PART ENDS ======-->

<!--====== Dokumen Detail START ======-->

<div class="shop-details-area pt-10 pb-115 gray-bg">
    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="shop-descriptions-area">
                            <!-- <h3 class="title"><?= $title; ?></h3> -->
                            <?php foreach ($struktur as $val) { ?>
                                <center>
                                    <img src="/image/struktur/<?= $val['struktur_organisasi']; ?>" class="img-fluid" alt="Struktur Organisasi" style=" object-fit: cover; object-position: center;">
                                </center>
                            <?php } ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!--====== Dokumen Detail ENDS ======-->
<?= $this->endSection(); ?>