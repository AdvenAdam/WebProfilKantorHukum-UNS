<?= $this->extend('/admin/layout/main'); ?>
<?= $this->section('content'); ?>
<div class="page-content">
    <div class="main-wrapper">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h3 class="Card-title mb-4">Data Kategori Tersimpan</h3>
                        <div class="row mb-4">
                            <div class="col-6">
                                <a href="" data-bs-toggle="modal" data-bs-target="#input" class="btn btn-primary">Tambah Data</a>
                            </div>
                            <div class="col-6" align="right">
                                <a href="" class="btn btn-success"><i class="fas fa-file-excel"></i> button 1</a>
                                <a href="" class="btn btn-danger"> <i class="fas fa-file-pdf"></i> button 2</a>
                            </div>
                        </div>
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
                        <table class="table-hover table invoice-table" style=" width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kategori Dokumen</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <?php $i = 1; ?>
                            <tbody>
                                <?php foreach ($kategori as $list) { ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $list['kategori_dokumen']; ?></td>
                                        <!-- action -->
                                        <td>
                                            <div class="d-inline">
                                                <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#edit" data-kategori='<?= $list['kategori_dokumen']; ?>' data-id='Kategori/update/<?= $list['id_kategori_dokumen']; ?>' title="Edit Data"><i data-feather="edit"></i> </a>
                                            </div>
                                            <div class="d-inline">
                                                <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#confirm" data-id='Kategori/delete/<?= $list['id_kategori_dokumen']; ?>' title="Hapus Data"><i data-feather="delete"></i> </a>
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
<!-- Modal confirm delete-->
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
<!-- Modal input-->
<div class="modal fade" id="input" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Form Input Kategori</h5>
                <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <form action="Kategori/save" method="POST">
                <?php csrf_field(); ?>
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="text" id="kategori" value="<?= old('kategori'); ?>" name="kategori" class="form-control" id="kategori" placeholder="kategori">
                        <label for="kategori">Kategori</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary d-inline">Simpan</button>
                    <a class="btn btn-secondary" data-bs-dismiss="modal">Tutup</a>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- modal edit -->
<div class="modal fade" id="edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Form Input Kategori</h5>
                <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <form action="" id="id" method="POST">
                <?php csrf_field(); ?>
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="text" value="<?= old('kategori'); ?>" name="kategori" class="form-control <?= $validation->hasError('kategori') ? 'is-invalid' : '' ?>" id="kategori" placeholder="kategori">
                        <label for="kategori">Kategori</label>
                        <div class="invalid-feedback">
                            <?= $validation->getError('kategori'); ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary d-inline">Simpan</button>
                    <a class="btn btn-secondary" data-bs-dismiss="modal">Tutup</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->renderSection('input'); ?>
<?= $this->endSection(); ?>
<?= $this->section('source'); ?>
<script>
    $(document).ready(function() {
        // Untuk sunting
        $('#confirm').on('show.bs.modal', function(event) {
            var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
            var modal = $(this)

            // Isi nilai pada field
            modal.find('#id').attr("action", div.data('id'));
        });
        $('#edit').on('show.bs.modal', function(event) {
            var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
            var modal = $(this)

            // Isi nilai pada field
            modal.find('#id').attr("action", div.data('id'));
            modal.find('#kategori').attr("value", div.data('kategori'));
        });
    });
</script>
<?= $this->endSection(); ?>