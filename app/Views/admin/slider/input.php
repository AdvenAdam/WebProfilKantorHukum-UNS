<?= $this->extend('admin/layout/main'); ?>
<?= $this->Section('content'); ?>
<div class="page-content">
    <div class="main-wrapper">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body pl-6 pb-6">
                        <h5 class="card-title">Form Input Slider</h5>
                        <div class="row">
                            <div class="col-12">
                                <form action="/Admin/Slider/save" method="Post" enctype="multipart/form-data">
                                    <?= csrf_field(); ?>
                                    <div class="form-floating mb-4">
                                        <input type="text" value="<?= old('judul'); ?>" name="judul" class="form-control <?= $validation->hasError('judul') ? 'is-invalid' : '' ?>" id="judul" placeholder="judul">
                                        <label for="judul">Judul</label>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('judul'); ?>
                                        </div>
                                    </div>
                                    <div class="form-floating mb-4">
                                        <input type="text" value="<?= old('keterangan'); ?>" name="keterangan" class="form-control" id="keterangan" placeholder="keterangan">
                                        <label for="keterangan">Keterangan</label>
                                    </div>
                                    <div class="form-floating mb-4">
                                        <input type="text" value="<?= old('link'); ?>" name="link" class="form-control" id="link" placeholder="link">
                                        <label for="link">Link</label>
                                        <strong>tombol akan otomatis tampil ada apabila link diisi</strong>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="row">
                                            <div class="col-3" style="margin: 0px auto;">
                                                <img class="img-thumbnail img-preview" src="/image/foto/default.jpg">
                                            </div>
                                        </div>
                                        <label for="foto" class="form-label">Silahkan Pilih Background Slider</label>
                                        <input type="file" id="foto" name="foto" onchange="previewImg()" class="custom-file-input form-control <?= $validation->hasError('foto') ? 'is-invalid' : '' ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('foto'); ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                        <div class="col-6" align="right">
                                            <a href="/Admin/Slider" class="btn btn-secondary">Kembali</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>