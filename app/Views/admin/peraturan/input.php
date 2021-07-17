<?= $this->extend('admin/layout/main'); ?>
<?= $this->Section('content'); ?>

<div class="page-content">
    <div class="main-wrapper">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body pl-6 pb-6">
                        <h5 class="card-title">Form Input Peratuan</h5>
                        <div class="row">
                            <div class="col-12">
                                <form action="/Admin/Peraturan/save" method="Post" enctype="multipart/form-data">
                                    <?= csrf_field(); ?>
                                    <div class="form-floating mb-4">
                                        <select class="form-control select <?= $validation->hasError('herarki') ? 'is-invalid' : '' ?>" name="herarki" style="padding: 10px;">
                                            <option value="<?= old('herarki'); ?>">Pilih Herarki</option>
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
                                        <input type="text" value="<?= old('nomor'); ?>" name="nomor" class="form-control <?= $validation->hasError('nomor') ? 'is-invalid' : '' ?>" id="nomor" placeholder="nomor">
                                        <label for="nomor">Nomor</label>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('nomor'); ?>
                                        </div>
                                    </div>
                                    <div class="form-floating mb-4">
                                        <input type="text" autocomplete="off" name="tahun" class="form-control <?= $validation->hasError('tahun') ? 'is-invalid' : '' ?>" id="tahun" placeholder="Tahun" style="width:50%;">
                                        <label for="tahun">Tahun</label>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('tahun'); ?>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="detail" class="form-label">Detail Peraturan</label>
                                        <textarea name="detail" rows="5" class=" form-control <?= $validation->hasError('detail') ? 'is-invalid' : '' ?>" id="editor"></textarea>
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
<?= $this->section('source'); ?>
<script>
    $(document).ready(function() {
        $('.select').select2();
    });
</script>
<?= $this->endSection(); ?>