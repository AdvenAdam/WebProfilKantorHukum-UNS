<?= $this->extend('admin/layout/main'); ?>
<?= $this->Section('content'); ?>
<div class="page-content">
    <div class="main-wrapper">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body pl-6 pb-6">
                        <h5 class="card-title">Form Input Peraturan</h5>
                        <div class="row">
                            <div class="col-12">
                                <?php foreach ($peraturan as $peraturan) { ?>
                                    <form action="/Admin/Peraturan/update/<?= $peraturan['id']; ?>" method="Post" enctype="multipart/form-data">
                                        <?= csrf_field(); ?>
                                        <div class="form-floating mb-4">
                                            <select class="form-control select <?= $validation->hasError('herarki') ? 'is-invalid' : '' ?>" name="herarki" style="padding: 10px;">
                                                <option value="<?= $peraturan['id_herarki']; ?>"><?= $peraturan['herarki']; ?></option>
                                                <?php foreach ($herarki as $list) { ?>
                                                    <?php if ($list['id'] == old('herarki')) { ?>
                                                        <option value="<?= $list['id'] ?>" selected><?= $list['herarki']; ?></option>
                                                    <?php continue;
                                                    } ?>
                                                    <option value="<?= $list['id']; ?>"><?= $list['herarki']; ?></option>
                                                <?php } ?>
                                            </select>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('herarki'); ?>
                                            </div>
                                        </div>
                                        <div class="form-floating mb-4">
                                            <input type="text" value="<?= old('nomor') ? old('nomor') : $peraturan['nomor']; ?>" name="nomor" class="form-control <?= $validation->hasError('nomor') ? 'is-invalid' : '' ?>" id="nomor" placeholder="nomor">
                                            <label for="nomor">Nomor</label>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('nomor'); ?>
                                            </div>
                                        </div>
                                        <div class="form-floating mb-4">
                                            <input type="text" autocomplete="off" value="<?= old('tahun') ? old('tahun') : $peraturan['tahun']; ?>" name="tahun" class="form-control <?= $validation->hasError('tahun') ? 'is-invalid' : '' ?>" id="tahun" placeholder="Tahun" style="width:50%;">
                                            <label for="tahun">Tahun</label>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('tahun'); ?>
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <label for="detail" class="form-label">Detail Peraturan</label>
                                            <textarea name="detail" rows="5" class="form-control <?= $validation->hasError('detail') ? 'is-invalid' : '' ?>" id="editor"><?= old('detail') ? old('detail') : $peraturan['detail']; ?></textarea>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('detail'); ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                            <div class="col-6" align="right">
                                                <a href="/Admin/Peraturan" class="btn btn-secondary">Kembali</a>
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
                                <?php } ?>
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
    $(document).ready(function() {
        $('.select').select2();
    });
</script>

<?= $this->endSection(); ?>