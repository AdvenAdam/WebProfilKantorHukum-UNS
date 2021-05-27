<!--====== LATEST NEWS PART START ======-->

<div class="latest-news-area gray-bg" id="berita">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section-title text-center">
                    <span>berita terkini</span>
                    <h4 class="title">baca berita terkini</h4>
                </div> <!-- sction title -->
            </div>
        </div> <!-- row -->
    </div> <!-- container -->
    <div class="letast-news-grid white-bg  ml-40 mr-40">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="latest-news">
                        <div class="row justify-content-center">
                            <?php foreach ($berita as $item) { ?>
                                <div class="col-lg-4 col-md-6 wow slideInUp" data-wow-duration="1.5s" data-wow-delay="0s">
                                    <div class="letest-news-item mt-30">
                                        <span>By <?= $item['author']; ?>, <?= $item['tanggal']; ?></span>
                                        <h4 class="title"><a href="blog-details.html"><?= $item['judul']; ?></a></h4>
                                        <img src="template/assets/images/berita/<?= $item['gambar']; ?>" alt="team-member" style="height: 200px;">
                                        <?= str_word_count($item['isi']) > 30 ? substr($item['isi'], 0, 100) . '...' : $item['isi'] ?><br>
                                        <a class="main-btn" href="<?= $item['link']; ?>">Read More <i class="fal fa-long-arrow-right"></i></a>
                                    </div> <!-- lesast news item -->
                                </div>
                            <?php } ?>
                        </div>
                    </div> <!-- latest news -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </div>
</div>

<!--====== LATEST NEWS PART ENDS ======-->