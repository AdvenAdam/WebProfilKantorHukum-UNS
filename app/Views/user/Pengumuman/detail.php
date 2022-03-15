<?= $this->extend('user/layout/v_main'); ?>
<?= $this->section('content'); ?>
<!--====== PAGE TITLE PART START ======-->

<div class="page-title-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-title-item text-center">
                    <div class="section-title">
                        <span>UNIVERSITAS SEBELAS MARET</span>
                        <h2 class=""><?= $value['judul']; ?> </h2>
                    </div> <!-- section title -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <p>
                                <li class="breadcrumb-item"><a href="/#home">Home </a></li>
                                <li class="breadcrumb-item"><a href="/Pengumuman">Feeds </a></li>

                        </ol>
                        </p>
                    </nav>
                </div> <!-- page title -->
            </div>
        </div> <!-- row -->
    </div> <!-- container -->
</div>
<!--====== PAGE TITLE PART ENDS ======-->

<div class="case-details-area pt-120 pb-10">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="case-details-thumb">
                    <img src="/image/pengumuman/<?= $value['gambar']; ?>" alt="">
                    <div class="case-live">
                        <div class="case-live-item-area d-flex justify-content-between">
                            <div class="case-live-item">
                                <h5 class="title">Penulis</h5>
                                <span><?= $value['creator']; ?></span>
                                <i class="fal fa-user"></i>
                            </div>
                            <div class="case-live-item">
                                <h5 class="title">Tanggal</h5>
                                <span><?= format_indo($value['created_at']); ?></span>
                                <i class="fal fa-calendar-alt"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="case-details-content mt-50 pb-20">
                    <?= $value['isi']; ?>
                </div>
            </div>
        </div>
    </div>
    <!--====== CASE DETAILS PART ENDS ======-->
</div>
<div class="case-studies-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="section-title">
                    <!-- <span>UNIVERSITAS SEBELAS MARET</span> -->
                    <h2 class="title">Feeds Lain </h2>
                </div> <!-- section title -->
            </div>
        </div> <!-- row -->
    </div> <!-- container -->
    <div class="container-fluid pl-70 pr-70">
        <div class="row no-gutters justify-content-center case-studies-active">
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
    </div>
</div>


<?= $this->endSection(); ?>