<?= $this->extend('/admin/layout/main'); ?>
<?= $this->section('content'); ?>
<div class="page-content">
    <div class="main-wrapper">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h3 class="Card-title mb-4">Data Herarki Tersimpan</h3>
                        <div class="row mb-4">
                            <div class="col-6">
                                <a href="javascript;" data-bs-toggle="modal" data-bs-target="#inputData" class="btn btn-primary">Tambah Data</a>
                            </div>
                        </div>
                        <?php if (session()->getFlashdata('success')) { ?>
                            <div class="alert alert-success fade show" role="alert">
                                <span><?= session()->getFlashdata('success'); ?></span>
                            </div>
                        <?php } ?>
                        <?php if (session()->getFlashdata('danger')) { ?>
                            <div class="alert alert-danger fade show" role="alert">
                                <span><?= session()->getFlashdata('danger'); ?></span>
                            </div>
                        <?php } ?>
                        <table id="table" class="display table-hover table invoice-table" style=" width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Herarki</th>
                                    <th>Urutan Herarki</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <?php $i = 1; ?>
                            <tbody>
                                <?php foreach ($herarki as $list) { ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $list['herarki']; ?></td>
                                        <td><?= $list['urutan']; ?></td>
                                        <!-- action -->
                                        <td>
                                            <div class="d-inline">
                                                <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#editData" data-urutan='<?= $list['urutan']; ?>' data-herarki='<?= $list['herarki']; ?>' data-id='Herarki/update/<?= $list['id']; ?>' title="Edit Data"><i data-feather="edit"></i> </a>
                                            </div>
                                            <div class="d-inline">
                                                <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#confirm" data-id='Herarki/delete/<?= $list['id']; ?>' title="Hapus Data"><i data-feather="delete"></i> </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Insert Data -->
<div class="modal fade" id="inputData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Form Input Data</h5>
                <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <form action="/Admin/Herarki/save" method="Post" enctype="multipart/form-data">
                <div class="modal-body">
                    <?= csrf_field(); ?>
                    <div class="form-floating mb-3">
                        <input type="text" value="<?= old('herarki'); ?>" name="herarki" class="form-control <?= $validation->hasError('herarki') ? 'is-invalid' : '' ?>" placeholder="herarki">
                        <label for="herarki">Herarki</label>
                        <div class="invalid-feedback">
                            <?= $validation->getError('herarki'); ?>
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" value="<?= old('urutan'); ?>" name="urutan" min='1' class="form-control <?= $validation->hasError('urutan') ? 'is-invalid' : '' ?>" placeholder="urutan">
                        <label for="urutan">Urutan</label>
                        <div class="invalid-feedback">
                            <?= $validation->getError('urutan'); ?>
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
<!-- Modal Edit Data -->
<div class="modal fade" id="editData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Form Edit Data</h5>
                <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <form method="Post" id="id" enctype="multipart/form-data">
                <div class="modal-body">
                    <?= csrf_field(); ?>
                    <div class="form-floating mb-3">
                        <input type="text" value="<?= old('herarki'); ?>" id="herarki" name="herarki" class="form-control <?= $validation->hasError('herarki') ? 'is-invalid' : '' ?>" placeholder="herarki">
                        <label for="herarki">Herarki</label>
                        <div class="invalid-feedback">
                            <?= $validation->getError('herarki'); ?>
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" value="<?= old('urutan'); ?>" id="urutan" min="1" name="urutan" class="form-control <?= $validation->hasError('urutan') ? 'is-invalid' : '' ?>" placeholder="urutan">
                        <label for="urutan">Urutan</label>
                        <div class="invalid-feedback">
                            <?= $validation->getError('urutan'); ?>
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
<?= $this->renderSection('input'); ?>
<?= $this->endSection(); ?>
<?= $this->section('source'); ?>
<script>
    $(document).ready(function() {
        // Untuk sunting
        $('#editData').on('show.bs.modal', function(event) {
            var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
            var modal = $(this)
            // Isi nilai pada field
            modal.find('#id').attr("action", div.data('id'));
            modal.find('#herarki').attr("value", div.data('herarki'));
            modal.find('#urutan').attr("value", div.data('urutan'));
        });
    });
</script>
<script>
    $(document).ready(function() {
        // Untuk sunting
        $('#confirm').on('show.bs.modal', function(event) {
            var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
            var modal = $(this)

            // Isi nilai pada field
            modal.find('#id').attr("action", div.data('id'));
        });
    });
</script>
<?= $this->endSection(); ?>