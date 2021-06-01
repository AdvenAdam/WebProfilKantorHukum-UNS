<!--====== BANNER PART START ======-->

<div class="banner-active" id="home">
    <?php foreach ($slider as $list) { ?>
        <div class="single-banner bg_cover" style="background-image: url(image/slider/<?= $list['foto']; ?>);">
            <div class="banner-overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="banner-content">
                                <span data-animation="fadeInLeft" data-delay="0.5s"><?= $list['judul']; ?></span>
                                <h1 data-animation="fadeInLeft" data-delay="0.9s" class="title"><?= $list['subjudul']; ?></h1>
                                <p data-animation="fadeInLeft" data-delay="1.3s"><?= $list['keterangan']; ?> </p>
                                <?php if ($list['link'] != null) { ?>
                                    <a data-animation="fadeInUp" data-delay="1.6s" class="main-btn" href="<?= $list['link']; ?>">lihat Selengkapnya <i class="fal fa-long-arrow-right"></i></a>
                                <?php } ?>
                            </div> <!-- banner content -->
                        </div>
                    </div> <!-- row -->
                </div> <!-- container -->
            </div>
        </div>
    <?php } ?>
</div>

<!--====== BANNER PART ENDS ======-->