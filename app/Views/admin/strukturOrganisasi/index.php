<?= $this->extend('/admin/layout/main'); ?>
<?= $this->section('content'); ?>
<div class="page-content">
    <div class="main-wrapper">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                            </div>
                            <div class="col-6">
                                <center>
                                    <h3 class="Card-title mb-4">Data Struktur Organisasi</h3>
                                </center>
                            </div>
                            <div class="col-3">
                            </div>
                        </div>
                        <div class="row mb-4">
                        </div>
                        <div class="row">
                            <center>
                                <div class="col-6">
                                    <?php foreach ($struktur as $list) { ?>
                                        <img src="/image/struktur/<?= $list['struktur_organisasi']; ?>" alt="">
                                        <br><br>
                                        <center>
                                            <a href="" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#ubahStruktur">Ubah Struktur Organisasi</a>
                                        </center>

                                        <form action="/Admin/Struktur/update/<?= $list['id']; ?>" method="Post" enctype="multipart/form-data">
                                            <div class="modal fade" id="ubahStruktur" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="staticBackdropLabel">Mengubah Struktur Organisasi</h5>
                                                            <a class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></a>
                                                        </div>
                                                        <?= csrf_field(); ?>
                                                        <div class="modal-body">
                                                            <div class="row mb-3">
                                                                <div class="row">
                                                                    <div class="col-3" style="margin: 0px auto;">
                                                                        <img class="img-thumbnail img-preview" src="/image/struktur/<?= $list['struktur_organisasi']; ?>">
                                                                    </div>
                                                                </div>
                                                                <label for="foto" class="form-label"><?= $list['struktur_organisasi']; ?></label>
                                                                <input type="file" id="foto" name="struktur" onchange="previewImg()" class="custom-file-input form-control <?= $validation->hasError('struktur') ? 'is-invalid' : '' ?>">
                                                                <div class="invalid-feedback">
                                                                    <?= $validation->getError('struktur'); ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirmStruktur">Simpan</a>
                                                            <a class="btn btn-secondary" data-bs-dismiss="modal">Tutup</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="confirmStruktur" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="staticBackdropLabel">Masukan Password Untuk Mengubah Data</h5>
                                                            <a class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></a>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-floating mb-3">
                                                                <input type="password" value="<?= old('password'); ?>" name="password" class="form-control <?= $validation->hasError('password') ? 'is-invalid' : '' ?>" placeholder="password">
                                                                <label for="password">Password</label>
                                                                <div class="invalid-feedback">
                                                                    <?= $validation->getError('password'); ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success">Simpan</button>
                                                            <a class="btn btn-secondary" data-bs-dismiss="modal">Tutup</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    <?php } ?>
                                </div>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?= $this->renderSection('input'); ?>
<?= $this->endSection(); ?>