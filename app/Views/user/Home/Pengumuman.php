<!--====== CASE STUDIES PART START ======-->
<?php if ($pengumuman != null) { ?>
    <div class="case-studies-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="section-title">
                        <span>UNIVERSITAS SEBELAS MARET</span>
                        <h2 class="title">Kantor Hukum Feeds </h2>
                    </div> <!-- section title -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
        <div class="container-fluid pl-70 pr-70">
            <div class="row no-gutters case-studies-active">
                <?php foreach ($pengumuman as $list) { ?>
                    <div class="single-case-studies mt-30">
                        <img src="/image/pengumuman/<?= $list['gambar']; ?>" height="450" alt="case-studies">
                        <div class="case-overlay">
                            <div class="item">
                                <span><?= format_indo($list['created_at']); ?></span>
                                <h5 class="title"><?= $list['judul']; ?></h5>
                            </div>
                            <a href="/Pengumuman/<?= $list['id']; ?>"><i class="fal fa-long-arrow-right"></i></a>
                        </div>
                    </div> <!-- single case studies -->
                <?php } ?>
            </div> <!-- row -->
            <!-- button selengkapnya -->
            <div class="row no-gutters case-studies-active mt-100">
                <div class="col-lg-12">
                    <div class="input-box mt-30">
                        <a href="/Pengumuman" class="main-btn wow slideInUp" href="/Pengumuman" data-wow-duration="1.5s" data-wow-delay="0s">Selengkapnya<i class="fal fa-long-arrow-right"></i></a>
                    </div> <!-- input box -->
                </div>
            </div>
        </div> <!-- containe fluid -->
    </div>
<?php } ?>


<!--====== CASE STUDIES PART ENDS ======-->