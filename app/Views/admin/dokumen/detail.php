<?= $this->extend('admin/layout/main'); ?>
<?= $this->Section('content'); ?>
<div class="page-content">
    <div class="main-wrapper">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <h2>Detail Dokumen</h2>
                            </div>
                            <div class="col-4">
                                <h4 class="float-end">#
                                    <?php if ($dokumen['status'] == 1) { ?>
                                        <span class="badge rounded-pill bg-success">Berlaku</span>
                                    <?php } else if ($dokumen['status'] == 2) { ?>
                                        <span class="badge rounded-pill bg-danger">Tidak Berlaku</span>
                                    <?php } else { ?>
                                        <span class="badge rounded-pill bg-primary">Peraturan Tetap</span>
                                    <?php } ?>
                                </h4>
                            </div>
                        </div>
                        <div class="invoice-details">
                            <div class="row">
                                <div class="col">
                                    <p class="info">Judul:</p>
                                    <p><?= strtoupper($dokumen['judul']); ?></p>
                                </div>
                                <div class="col">
                                    <p class="info">Kategori:</p>
                                    <p><?= $dokumen['kategori_dokumen']; ?></p>
                                </div>
                                <div class="col">
                                    <p class="info">Tahun:</p>
                                    <p><?= $dokumen['tahun']; ?></p>
                                </div>
                            </div>
                            <div class="invoice-details">
                                <div class="row">
                                    <div class="col">
                                        <p class="info">Berlaku Mulai:</p>
                                        <?= $dokumen['berlaku'] == '0000-00-00' ? '-' : $dokumen['berlaku']; ?>
                                    </div>
                                    <div class="col">
                                        <p class="info">Berlaku Sampai:</p>
                                        <?= $dokumen['sampai'] == '0000-00-00' ? '-' : $dokumen['sampai']; ?>
                                    </div>
                                    <div class="col">
                                        <p class="info">Diupload pada:</p>
                                        <p><?= $dokumen['created_at']; ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="row invoice-details">
                                <h2>Pdf</h2>
                                <div class="col-12">
                                    <embed type="application/pdf" src="/dokumen/<?= $dokumen['kategori_dokumen']; ?>/<?= $dokumen['dokumen']; ?>" width="100%" height="750"></embed>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= $this->endSection(); ?>
    <?= $this->Section('source'); ?>
    <script>

    </script>
    <?= $this->endSection(); ?>