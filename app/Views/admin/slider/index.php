<?= $this->extend('/admin/layout/main'); ?>
<?= $this->section('content'); ?>
<div class="page-content">
    <div class="main-wrapper">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h3 class="Card-title mb-4">Data Kategori Tersimpan</h3>
                        <div class="row mb-4">
                            <div class="col-6">
                                <a href="Slider/create" class="btn btn-primary">Tambah Data</a>
                            </div>
                        </div>
                        <?php if (session()->getFlashdata('danger')) { ?>
                            <div class="alert alert-danger fade show" role="alert">
                                <span><?= session()->getFlashdata('danger'); ?></span>
                            </div>
                        <?php } ?>
                        <?php if (session()->getFlashdata('success')) { ?>
                            <div class="alert alert-success fade show" role="alert">
                                <span><?= session()->getFlashdata('success'); ?></span>
                            </div>
                        <?php } ?>
                        <!--====== Style css ======-->
                        <link rel="stylesheet" href="/tema/user/template/assets/css/style.css">
                        <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,700,800&display=swap" rel="stylesheet">
                        <!--====== Style css ======-->
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <?php
                            $i = 1;
                            foreach ($slider as $list) { ?>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-<?= $i; ?>" aria-expanded="false" aria-controls="flush-<?= $i; ?>">
                                            <?= $list['judul'] . ' #' . $i ?>
                                        </button>
                                    </h2>
                                    <div id="flush-<?= $i++; ?>" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <div class="banner-active">
                                                <div class="single-banner bg_cover" style="margin-top:0px !important;background-image: url(/image/slider/<?= $list['foto']; ?>);">
                                                    <div class="banner-overlay">
                                                        <div class="container">
                                                            <div class="row">
                                                                <div class="col-lg-9">
                                                                    <a href="Slider/edit/<?= $list['id']; ?>" class="btn btn-primary">Edit</a>
                                                                    <a href="" data-bs-toggle="modal" data-bs-target="#confirm" data-id="Slider/delete/<?= $list['id']; ?>" class="btn btn-secondary">Hapus</a>
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
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- modal confirm hapus -->
    <div class="modal fade" id="confirm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Pastikan Anda Yakin ??</h5>
                    <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda Yakin Untuk Menghapus Data ?
                </div>
                <div class="modal-footer">
                    <form action="" id="id" method="POST">
                        <?php csrf_field(); ?>
                        <button class="btn btn-danger d-inline">Ya, Saya Mengerti</button>
                        <a class="btn btn-secondary" data-bs-dismiss="modal">Tutup</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?= $this->renderSection('input'); ?>
    <?= $this->endSection(); ?>
    <?= $this->section('source'); ?>

    <script>
        $(document).ready(function() {
            // Untuk sunting
            $('#confirm').on('show.bs.modal', function(event) {
                var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
                var modal = $(this)

                // Isi nilai pada field
                modal.find('#id').attr("action", div.data('id'));
            });

        });
    </script>
    <?= $this->endSection(); ?>