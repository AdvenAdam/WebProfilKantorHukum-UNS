<?= $this->extend('admin/layout/main'); ?>
<?= $this->Section('content'); ?>
<div class="page-content">
    <div class="main-wrapper">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body pl-6 pb-6">
                        <h5 class="card-title">Form Input Dokumen</h5>
                        <div class="row">
                            <div class="col-12">

                                <form action="/Admin/Dokumen/update/<?= $dokumen['id']; ?>" method="Post" enctype="multipart/form-data">
                                    <?= csrf_field(); ?>
                                    <div class="form-floating mb-4">
                                        <input type="text" value="<?= old('judul') ? old('judul') : $dokumen['judul']; ?>" name="judul" class="form-control <?= $validation->hasError('judul') ? 'is-invalid' : '' ?>" id="judul" placeholder="judul">
                                        <label for="judul">Judul</label>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('judul'); ?>
                                        </div>
                                    </div>
                                    <div class="form-floating mb-4">
                                        <select class="form-select <?= $validation->hasError('kategori_dokumen') ? 'is-invalid' : '' ?>" id="kategori_dokumen" name="kategori_dokumen" value="">
                                            <option value="<?= $dokumen['id_kategori_dokumen']; ?>"><?= $dokumen['kategori_dokumen']; ?></option>
                                            <?php foreach ($kategori as $list) { ?>
                                                <?php if ($list['id_kategori_dokumen'] == old('kategori_dokumen')) { ?>
                                                    <option value="<?= $list['id_kategori_dokumen'] ?>" selected><?= $list['kategori_dokumen']; ?></option>
                                                <?php continue;
                                                } ?>
                                                <option value="<?= $list['id_kategori_dokumen']; ?>"><?= $list['kategori_dokumen']; ?></option>
                                            <?php } ?>
                                        </select>
                                        <label>Pilih Kategori Dokumen</label>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('kategori_dokumen'); ?>
                                        </div>
                                    </div>
                                    <div class="form-floating mb-4">
                                        <input type="text" value="<?= old('no') ? old('no') : $dokumen['no']; ?>" name="no" class="form-control <?= $validation->hasError('no') ? 'is-invalid' : '' ?>" id="no" placeholder="no">
                                        <label for="no">No</label>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('no'); ?>
                                        </div>
                                    </div>
                                    <div class="form-floating mb-4">
                                        <input type="text" autocomplete="off" value="<?= old('tahun') ? old('tahun') : $dokumen['tahun']; ?>" name="tahun" class="form-control <?= $validation->hasError('tahun') ? 'is-invalid' : '' ?>" id="tahun" placeholder="Tahun">
                                        <label for="tahun">Tahun</label>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('tahun'); ?>
                                        </div>
                                    </div>
                                     <div class="form-floating mb-4">
                                        <div class="row">
                                            <div class="col-4">
                                                <label for="berlaku">Berlaku Mulai</label>
                                                <input type="date" value="<?= old('berlaku') ? old('berlaku') : $dokumen['berlaku']; ?>" name="berlaku" class="form-control <?= $validation->hasError('berlaku') ? 'is-invalid' : '' ?>" id="berlaku" placeholder="berlaku">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('berlaku'); ?>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <label for="sampai">Berlaku Sampai</label>
                                                <input type="date" value="<?= old('sampai') ? old('sampai') : $dokumen['sampai']; ?>" name="sampai" class="form-control <?= $validation->hasError('sampai') ? 'is-invalid' : '' ?>" id="sampai" placeholder="sampai">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('sampai'); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <label for="dokumen" class="form-label d-inline"><?= $dokumen['dokumen']; ?>
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#view">> <i data-feather="eye"></i></a>
                                        </label>
                                        <input id="dokumen" class="form-control form-control-sm <?= $validation->hasError('dokumen') ? 'is-invalid' : '' ?>" name="dokumen" type="file">
                                        <canvas id="pdfViewer" height="0%"></canvas>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('dokumen'); ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirm">Simpan</a>
                                        </div>
                                        <div class="col-6" align="right">
                                            <a href="/Admin/Dokumen" class="btn btn-secondary">Kembali</a>
                                        </div>
                                    </div>
                                    <!-- Modal confirm-->
                                    <div class="modal fade" id="confirm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Pastikan Anda Yakin</h5>
                                                    <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda Yakin Untuk Menyimpan Perubahan ?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success">Simpan</button>
                                                    <a class="btn btn-secondary" data-bs-dismiss="modal">Tutup</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Modal View PDF -->
                        <div class="modal fade" id="view" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel"><?= $dokumen['dokumen']; ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                    </div>
                                    <div class="modal-body">
                                        <embed type="application/pdf" src="/dokumen/<?= $dokumen['kategori_dokumen']; ?>/<?= $dokumen['dokumen']; ?>" width="100%" height="750"></embed>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
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
<!-- tinymce -->
<script src="/tema/admin/circladmin-10/circl/theme/assets/plugins/tinymce/tinymce.min.js"></script>
<!-- tinymce WYSWYG -->
<script>
    tinymce.init({
        selector: '#pendahuluan',

    });
</script>

<?= $this->endSection(); ?>