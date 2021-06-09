<!-- Modal Insert Data -->
<div class="modal fade" id="inputData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Form Edit Data</h5>
                <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <form action="/Admin/User/save" method="Post" id="formUser" enctype="multipart/form-data">
                <div class="modal-body">
                    <?= csrf_field(); ?>
                    <div class="form-floating mb-3">
                        <input type="text" value="<?= old('username'); ?>" name="username" class="form-control <?= $validation->hasError('username') ? 'is-invalid' : '' ?>" id="username" placeholder="username">
                        <label for="username">Username</label>
                        <div class="invalid-feedback">
                            <?= $validation->getError('username'); ?>
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" value="<?= old('email'); ?>" name="email" class="form-control <?= $validation->hasError('email') ? 'is-invalid' : '' ?>" id="email" placeholder="email">
                        <label for="email">Email</label>
                        <div class="invalid-feedback">
                            <?= $validation->getError('email'); ?>
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" value="<?= old('password'); ?>" name="password" class="form-control <?= $validation->hasError('password') ? 'is-invalid' : '' ?>" id="password" placeholder="password">
                        <label for="password">Password</label>
                        <div class="invalid-feedback">
                            <?= $validation->getError('password'); ?>
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" value="<?= old('repassword'); ?>" name="repassword" class="form-control <?= $validation->hasError('repassword') ? 'is-invalid' : '' ?>" id="repassword" placeholder="repassword">
                        <label for="repassword">Ulangi Password</label>
                        <div class="invalid-feedback">
                            <?= $validation->getError('repassword'); ?>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="row">
                            <div class="col-3" style="margin: 0px auto;">
                                <img class="img-thumbnail img-preview" src="/image/foto/default.jpg">
                            </div>
                        </div>
                        <label for="foto" class="form-label">Silahkan Pilih foto</label>
                        <input type="file" id="foto" name="foto" onchange="previewImg()" class="custom-file-input form-control <?= $validation->hasError('foto') ? 'is-invalid' : '' ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('foto'); ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="submit" class="btn btn-success d-inline">Tambah Data</button>
                    <a class="btn btn-secondary" data-bs-dismiss="modal">Tutup</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal confirm hapus-->
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