<!-- Modal Insert Data -->
<div class="modal fade" id="inputData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Form Input Data</h5>
                <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <form action="/Admin/DokumenInternal/save" method="Post" enctype="multipart/form-data">
                <div class="modal-body">
                    <?= csrf_field(); ?>
                    <div class="form-floating mb-4">
                        <input type="text" value="<?= old('judul'); ?>" name="judul" class="form-control <?= $validation->hasError('judul') ? 'is-invalid' : '' ?>" placeholder="judul">
                        <label for="judul">Judul</label>
                        <div class="invalid-feedback">
                            <?= $validation->getError('judul'); ?>
                        </div>
                    </div>
                    <div class="form-floating mb-4">
                        <input type="text" value="<?= old('no_sk') ? old('no_sk') : ' /UNS27/HK/' . date('Y'); ?>" name="no_sk" class="form-control <?= $validation->hasError('no_sk') ? 'is-invalid' : '' ?>" placeholder="no_sk">
                        <label for="no_sk">NO SK</label>
                        <div class="invalid-feedback">
                            <?= $validation->getError('no_sk'); ?>
                        </div>
                    </div>
                    <div class="form-floating mb-4">
                        <select class="form-select <?= $validation->hasError('status') ? 'is-invalid' : '' ?>" name="status">
                            <option value="">Buka Pilihan Jenis</option>
                            <option value="1">Asli</option>
                            <option value="0">Salinan</option>
                        </select>
                        <label>Pilih Jenis Dokumen</label>
                        <div class="invalid-feedback">
                            <?= $validation->getError('status'); ?>
                        </div>
                    </div>
                    <div class="form-floating mb-4">
                        <input type="text" autocomplete="off" name="tahun" class="form-control tahun <?= $validation->hasError('tahun') ? 'is-invalid' : '' ?>" placeholder="Tahun">
                        <label for="tahun">Tahun</label>
                        <div class="invalid-feedback">
                            <?= $validation->getError('tahun'); ?>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="dokumen" class="form-label">Silahkan Pilih Dokumen</label>
                        <input class="form-control dok form-control-sm <?= $validation->hasError('file') ? 'is-invalid' : '' ?>" name="file" type="file" id="dokumen" required>
                        <canvas id="pdfViewer" height="10%"></canvas>
                        <div class="invalid-feedback">
                            <?= $validation->getError('file'); ?>
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
<!-- Modal confirm-->
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
<!-- Modal Update Data -->
<div class="modal fade" id="updateData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Form Edit Data</h5>
                <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <form id="idupdate" method="Post" enctype="multipart/form-data">
                <div class="modal-body">
                    <?= csrf_field(); ?>
                    <div class="form-floating mb-4">
                        <input type="text" value="<?= old('judul'); ?>" name="judul" class="form-control <?= $validation->hasError('judul') ? 'is-invalid' : '' ?>" id="judul" placeholder=" judul">
                        <label for="judul">Judul</label>
                        <div class="invalid-feedback">
                            <?= $validation->getError('judul'); ?>
                        </div>
                    </div>
                    <div class="form-floating mb-4">
                        <input type="text" value="<?= old('no_sk'); ?>" name="no_sk" id="no_sk" class="form-control <?= $validation->hasError('no_sk') ? 'is-invalid' : '' ?>" id="no_sk" placeholder="no_sk">
                        <label for="no_sk">NO SK</label>
                        <div class="invalid-feedback">
                            <?= $validation->getError('no_sk'); ?>
                        </div>
                    </div>
                    <div class="form-floating mb-4">
                        <select class="form-select <?= $validation->hasError('status') ? 'is-invalid' : '' ?>" id="status" name="status">
                            <option value="" selected>Buka Pilihan Jenis</option>
                            <option value="1">Asli</option>
                            <option value="0">Salinan</option>
                        </select>
                        <label>Pilih Jenis Dokumen</label>
                        <div class="invalid-feedback">
                            <?= $validation->getError('status'); ?>
                        </div>
                    </div>
                    <div class="form-floating mb-4">
                        <input type="text" autocomplete="off" name="tahun" id="tahun" class="form-control tahun <?= $validation->hasError('tahun') ? 'is-invalid' : '' ?>" id="tahun" placeholder="Tahun">
                        <label for="tahun">Tahun</label>
                        <div class="invalid-feedback">
                            <?= $validation->getError('tahun'); ?>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="dokumen" class="form-label">Silahkan Pilih Dokumen <b>**lewati jika tidak ada perubahan</b></label>
                        <input class="form-control form-control-sm <?= $validation->hasError('file') ? 'is-invalid' : '' ?>" name="file" id="dok" type="file">
                        <canvas id="pdfView" height="10%"></canvas>
                        <div class="invalid-feedback">
                            <?= $validation->getError('file'); ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success d-inline">Tambah Data</button>
                    <a class="btn btn-secondary" data-bs-dismiss="modal">Tutup</a>
                </div>
            </form>
        </div>
    </div>
</div>