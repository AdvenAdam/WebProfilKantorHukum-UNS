<?= $this->extend('/admin/layout/main'); ?>
<?= $this->section('content'); ?>
<div class="page-content">
    <div class="main-wrapper">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h3 class="Card-title mb-4">Data Dokumen Tersimpan</h3>
                        <div class="row mb-4">
                            <div class="col-6">
                                <a href="Dokumen/create" class="btn btn-primary">Tambah Data</a>
                            </div>
                            <div class="col-6" align="right">
                                <a href="" class="btn btn-success"> <i class="fas fa-file-excel"></i> button 1</a>
                                <a href="" class="btn btn-danger"> <i class="fas fa-file-pdf"></i> button 2</a>
                            </div>
                        </div>

                        <table id="table" class="display table-hover table invoice-table" style=" width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tahun</th>
                                    <th>Judul</th>
                                    <th>Kategori</th>
                                    <th>Status</th>
                                    <th>Berlaku Sampai</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <?php $i = 1; ?>
                            <tbody>
                                <?php foreach ($dokumen as $list) { ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $list['tahun']; ?></td>
                                        <td><?= $list['judul']; ?></td>
                                        <td><?= $list['kategori_dokumen']; ?></td>
                                        <td>
                                            <?php if ($list['status'] == 1) { ?>
                                                <span class="badge rounded-pill bg-success">Berlaku</span>
                                            <?php } else if ($list['status'] == 2) { ?>
                                                <span class="badge rounded-pill bg-danger">Tidak Berlaku</span>
                                            <?php } else { ?>
                                                <span class="badge rounded-pill bg-primary">Peraturan Tetap</span>
                                            <?php } ?>
                                        </td>
                                        <td><?= $list['sampai'] == '0000-00-00' ? '-' : $list['sampai']; ?></td>
                                        <!-- action -->
                                        <td>
                                            <div class="d-inline">
                                                <a href="Dokumen/edit/<?= $list['id']; ?>" title="Edit"><i data-feather="edit"></i> </a>
                                            </div>
                                            <div class="d-inline">
                                                <a href="Dokumen/detail/<?= $list['id']; ?>" title="Lihat"><i data-feather="eye"></i> </a>
                                            </div>
                                            <div class="d-inline">
                                                <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#confirm" data-id='Dokumen/delete/<?= $list['id']; ?>' title="Hapus Data"><i data-feather="delete"></i> </a>
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
        $('#confirm').on('show.bs.modal', function(event) {
            var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
            var modal = $(this)

            // Isi nilai pada field
            modal.find('#id').attr("action", div.data('id'));
        });
    });
</script>
<?= $this->endSection(); ?>