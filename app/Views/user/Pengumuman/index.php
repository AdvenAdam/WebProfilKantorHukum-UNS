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
                        <h2 class="title">Berita Kantor Hukum </h2>
                    </div> <!-- section title -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/#home">Home </a></li>
                            <li class="breadcrumb-item active" aria-current="page">Berita</li>
                        </ol>
                    </nav>
                </div> <!-- page title -->
            </div>
        </div> <!-- row -->
    </div> <!-- container -->
</div>
<!--====== PAGE TITLE PART ENDS ======-->


<!--====== NEWS PART START ======-->

<div class="news-area news-area-2">
    <div class="container">
        <div class="row justify-content-center">
            <?php foreach ($pengumuman as $list) { ?>
                <div class="col-lg-4 col-md-6 col-sm-9">
                    <div class="single-news mt-30">
                        <img src="/image/pengumuman/<?= $list['gambar']; ?>" style="aspect-ratio: 1/1;" alt="">
                        <div class="single-news-overlay">
                            <span><?= format_indo($list['created_at']); ?></span>
                            <h5 class="title"><a href="/Pengumuman/<?= $list['id']; ?>"><?= $list['judul']; ?></a></h5>
                            <a href="/Pengumuman/<?= $list['id']; ?>"><i class="fal fa-long-arrow-right"></i></a>
                        </div>
                    </div> <!-- single news -->
                </div>
            <?php } ?>


            <!-- <div class="col-lg-8">
                <div class="case-study-btn text-center mt-40">
                    <a class="main-btn" href="#">Load More +</a>
                </div>
            </div> -->
        </div> <!-- row -->
    </div> <!-- container -->
</div>

<!--====== NEWS PART ENDS ======-->
<?= $this->endSection(); ?>