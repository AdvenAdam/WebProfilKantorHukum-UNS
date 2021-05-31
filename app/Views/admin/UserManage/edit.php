<?= $this->extend('admin/layout/main'); ?>
<?= $this->Section('content'); ?>
<div class="page-content">
    <div class="main-wrapper">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body pl-6 pb-6">
                        <h5 class="card-title">Form Edit User</h5>
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
                        <div class="row">
                            <div class="col-12">

                                <form action="/Admin/User/update/<?= $list['id']; ?>" method="Post" enctype="multipart/form-data">
                                    <?= csrf_field(); ?>

                                    <div class="form-floating mb-3">
                                        <input type="text" value="<?= old('username') ? old('username') : $list['username']; ?>" name="username" class="form-control <?= $validation->hasError('username') ? 'is-invalid' : '' ?>" placeholder="username">
                                        <label for="username">Username</label>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('username'); ?>
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="email" value="<?= old('email') ? old('email') : $list['email']; ?>" name="email" class="form-control <?= $validation->hasError('email') ? 'is-invalid' : '' ?>" placeholder="email">
                                        <label for="email">Email</label>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('email'); ?>
                                        </div>
                                    </div>
                                    <div class="row-mb3">
                                        <!-- Update password start -->
                                        <a href="" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ubahPass">Ubah Password</a>
                                        <!-- Update password end -->
                                    </div>

                                    <div class="row mb-3">
                                        <div class="row">
                                            <div class="col-3" style="margin: 0px auto;">
                                                <img class="img-thumbnail img-preview" src="/image/foto/<?= $list['foto']; ?>">
                                            </div>
                                        </div>
                                        <label for="foto" class="form-label"><?= $list['foto']; ?></label>
                                        <input type="file" id="foto" name=" foto" onchange="previewImg()" class="custom-file-input foto form-control <?= $validation->hasError('foto') ? 'is-invalid' : '' ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('foto'); ?>
                                        </div>
                                    </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirm">Simpan</a>
                                </div>
                                <div class="col-6" align="right">
                                    <a href="/Admin/User" class="btn btn-secondary">Kembali</a>
                                </div>
                            </div>
                            <!-- Modal confirm-->
                            <div class="modal fade" id="confirm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
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
                            <!-- Modal Change Password-->
                            <div class="modal fade" id="ubahPass" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Masukan Password Lama Untuk Mengubah Password</h5>
                                            <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                        </div>
                                        <form action="/Admin/User/editPass/<?= $list['id']; ?>" method="Post" enctype="multipart/form-data">
                                            <?= csrf_field(); ?>
                                            <div class="modal-body">
                                                <div class="form-floating mb-3">
                                                    <input type="password" value="<?= old('pass'); ?>" name="pass" class="form-control <?= $validation->hasError('pass') ? 'is-invalid' : '' ?>" id="pass" placeholder="pass">
                                                    <label for="pass">Password Lama</label>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('pass'); ?>
                                                    </div>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input type="password" value="<?= old('newpass'); ?>" name="newpass" class="form-control <?= $validation->hasError('newpass') ? 'is-invalid' : '' ?>" id="newpass" placeholder="newpass">
                                                    <label for="newpass">Password Baru</label>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('newpass'); ?>
                                                    </div>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input type="password" value="<?= old('repass'); ?>" name="repass" class="form-control <?= $validation->hasError('repass') ? 'is-invalid' : '' ?>" id="repass" placeholder="repass">
                                                    <label for="repass">Ulangi Password</label>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('repass'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success">Simpan</button>
                                                <a class="btn btn-secondary" data-bs-dismiss="modal">Tutup</a>
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
    </div>
</div>
</div>


<?= $this->endSection(); ?>