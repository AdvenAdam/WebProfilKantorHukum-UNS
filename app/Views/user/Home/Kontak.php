<!--====== CONTACT US PART START ======-->

<div class="contact-us-area bg_cover" style="background-image: url(template/assets/images/contact-bg.jpg)" id="kontak">
    <div class="contact-overlay">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-title text-center">
                        <span>Hubungi Kami</span>
                        <h2 class="title">Kirim Kritik & Saran </h2>
                    </div> <!-- sevtion title -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
        <div class="container">
            <div class="row">
                <div class="contact-details d-flex">
                    <div class="col-6">
                        <div class="contact-thumb wow slideInLeft" data-wow-duration=".5s" data-wow-delay="0s">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1977.5584215991657!2d110.85654074758212!3d-7.56223775805333!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a17019722f141%3A0x702a722a62faa5f9!2sAkademik%20UNS!5e0!3m2!1sid!2sid!4v1622166688188!5m2!1sid!2sid" width="450" height="487" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div>
                    <div class="contact-form-area">
                        <form action="/saveMasukan" method="POST" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <div class="input-title">
                                <h3 class="title">Kirimkan Kritik & Saran Anda</h3>
                            </div> <!-- input title -->
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="input-box mt-30">
                                        <input type="text" name="nama" placeholder="Full Name Here">
                                        <i class="fal fa-user"></i>
                                    </div> <!-- input box -->
                                </div>
                                <div class="col-lg-6">
                                    <div class="input-box mt-30">
                                        <input type="email" name="email" placeholder="Email Here">
                                        <i class="fal fa-envelope-open"></i>
                                    </div> <!-- input box -->
                                </div>
                                <div class="col-lg-6">
                                    <div class="input-box mt-30">
                                        <input type="text" name="phone" placeholder="Phone No">
                                        <i class="fal fa-phone"></i>
                                    </div> <!-- input box -->
                                </div>
                                <div class="col-lg-6">
                                    <div class="input-box mt-30">
                                        <input type="text" name="subject" placeholder="Subject">
                                        <i class="fal fa-edit"></i>
                                    </div> <!-- input box -->
                                </div>
                                <div class="col-lg-12">
                                    <div class="input-box mt-30">
                                        <textarea cols="30" name="pesan" rows="10" placeholder="Message Us"></textarea>
                                        <i class="fal fa-pencil"></i>
                                        <button class="main-btn wow slideInUp" data-wow-duration="1.5s" data-wow-delay="0s" type="submit">Send Message <i class="fal fa-long-arrow-right"></i></button>
                                    </div> <!-- input box -->
                                </div>
                            </div>
                        </form>
                    </div>
                </div> <!-- contact details -->
            </div> <!-- row -->
        </div> <!-- container -->
    </div>
</div>

<!--====== CONTACT US PART END ======-->