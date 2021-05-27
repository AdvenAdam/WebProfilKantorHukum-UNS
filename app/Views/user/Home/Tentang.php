<!--====== TEAM MEMBER PART START ======-->

<div class="team-member-area mt-100 mb-100" id="dosen">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section-title text-center">
                    <span class="title">Dosen PTIK</span><br>
                    <h7>"Bila kamu tak tahan lelahnya belajar, maka kamu akan menanggung perihnya kebodohan"
                        (Imam Syafie)</h7>
                </div>
            </div>
        </div> <!-- row -->
    </div> <!-- container -->
    <div class="container-fluid">
        <div class="row">
            <?php foreach ($dosen as $item) { ?>
                <div class="col-lg-2 col-md-4 col-sm-6">
                    <div class="single-team-member mt-30">
                        <img src="template/assets/images/dosen/<?= $item['foto']; ?>" alt="team-member" style="width: 200px; height: 300px; object-fit: cover; object-position: center;">
                        <div class=" team-member-overlay">
                            <ul>
                                <li><a href=""><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href=""><i class="fab fa-twitter"></i></a></li>
                                <li><a href=""><i class="fab fa-behance"></i></a></li>
                                <li><a href=""><i class="fab fa-youtube"></i></a></li>
                                <li><a href=""><i class="fab fa-dribbble"></i></a></li>
                            </ul>
                            <h4 class="title"><?= $item['nama']; ?></h4>
                            <span>Dosen PTIK</span>
                        </div>
                    </div> <!-- single team member -->
                </div>
            <?php } ?>
        </div> <!-- row -->
        <div class="row justify-content-center">
            <div class="col-lg-2 col-md-4 col-m-6 mt-100">
                <a class="main-btn" href="/dosen">Lihat lebih lengkap <i class="fal fa-long-arrow-right"></i></a>
            </div>
        </div><!--  row -->
    </div> <!-- container fluid -->
</div>

<!--====== TEAM MEMBER PART ENDS ======-->