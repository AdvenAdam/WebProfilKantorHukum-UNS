<!--====== BANNER PART START ======-->
<?php if ($slider == null) { ?>
    <div class="banner-active mt-150" id="home">
    </div>
<?php } ?>
<div class="row">
    <div class="col-md-1">

    </div>
    <div class="col-md-10">
        <div class="banner-active" id="home">
            <?php foreach ($slider as $list) { ?>

                <div class="single-banner bg_cover">
                    <div class="banner-overlay">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-1"></div>
                                <div class="col-lg-10">
                                    <div class="banner-content">
                                        <div class="row">
                                            <div class="col-md-6 <?= empty($list['subjudul'])  || empty($list['keterangan'])  || empty($list['link'])  ? 'pt-100' : ''; ?>">
                                                <span data-animation="fadeInLeft" data-delay="0.5s" style="padding-right: 70px;"><?= $list['judul']; ?></span>
                                                <br><br><br>
                                                <p data-animation="fadeInLeft" data-delay="1.3s"><?= $list['keterangan']; ?> </p>
                                                <?php if ($list['link'] != null) { ?>
                                                    <a data-animation="fadeInUp" data-delay="1.6s" class="main-btn" href="<?= $list['link']; ?>">lihat Selengkapnya <i class="fal fa-long-arrow-right"></i></a>
                                                <?php } ?>
                                            </div>
                                            <div class="col-md-6">
                                                <img src="/image/slider/<?= $list['foto']; ?>" style="width: 100%; height: 300px;  object-position: center;" alt="">
                                            </div>
                                        </div>

                                    </div> <!-- banner content -->
                                </div>
                                <div class="col-lg-1"></div>
                            </div> <!-- row -->
                        </div> <!-- container -->
                    </div>
                </div>

            <?php } ?>
        </div>
    </div>
    <div class="col-md-1">
    </div>
</div>
<!--====== BANNER PART ENDS ======-->