<?= $this->extend('user/layout/v_main'); ?>
<?= $this->section('content'); ?>
<!--====== PAGE TITLE PART START ======-->

<div class="page-title-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-title-item text-center">
                    <h2 class="title">
                        <?= $title; ?>
                    </h2>
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
                        <div class="shop-descriptions-area khusus">
                            <?php foreach ($info as $val) { ?>
                                <font color="black"> <?= $val['tugas_pokok']; ?> </font>
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