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
                                <h2>Detail Dokumen Internal</h2>
                            </div>
                            <div class="col-4" align="right">
                                <a href="/Admin/DokumenInternal"><i data-feather="arrow-left"></i></a>
                            </div>
                        </div>
                        <div class="invoice-details">
                            <div class="row">
                                <div class="col">
                                    <p class="info">Judul:</p>
                                    <p><?= $dokumen['judul']; ?></p>
                                </div>
                                <div class="col">
                                    <p class="info">No SK:</p>
                                    <p><?= $dokumen['no_sk']; ?></p>
                                </div>
                                <div class="col">
                                    <p class="info">Tahun:</p>
                                    <p><?= $dokumen['tahun']; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <p class="info">Jenis Dokumen:</p>
                                    <p><?= $dokumen['status'] == '1' ? 'ASLI' : 'SALINAN'; ?></p>
                                </div>
                                <div class="col">
                                    <p class="info">Diupload pada:</p>
                                    <p><?= $dokumen['created_at']; ?></p>
                                </div>
                                <div class="col"></div>
                            </div>
                        </div>
                        <div class="row invoice-details">
                            <h2>Pdf</h2>
                            <div class="col-12">
                                <embed type="application/pdf" src="/dokumen_internal/<?= $dokumen['file']; ?>" width="100%" height="750"></embed>
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