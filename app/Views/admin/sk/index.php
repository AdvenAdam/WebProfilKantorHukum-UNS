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
                                <a href="SK/create" class="btn btn-primary">Tambah Data</a>
                            </div>
                        </div>
                        <?php if (session()->getFlashdata('success')) { ?>
                            <div class="alert alert-success fade show" role="alert">
                                <span><?= session()->getFlashdata('success'); ?></span>
                            </div>
                        <?php } ?>
                        <table id="table" class="display table-hover table invoice-table" style=" width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tentang</th>
                                    <th>Penandatangan</th>
                                    <th>Waktu</th>
                                    <th>Cetak</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <?php $i = 1; ?>
                            <tbody>
                                <?php foreach ($sk as $list) { ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= json_decode($list['memutuskan'])['0']; ?></td>
                                        <td><?= json_decode($list['penandatangan'])->nama; ?></td>
                                        <td><?= $list['created_at']; ?></td>
                                        <td><a href="SK/cetak/<?= $list['id']; ?>" target="_blank"><i class="feather-32" data-feather="printer"></i> </a></td>
                                        <!-- action -->
                                        <td>
                                            <div class="d-inline">
                                                <a href="SK/edit/<?= $list['id']; ?>" title="Edit"><i data-feather="edit"></i> </a>
                                            </div>
                                            <div class="d-inline">
                                                <a href="SK/detail/<?= $list['id']; ?>" target="_blank" title="Lihat"><i data-feather="eye"></i> </a>
                                            </div>
                                            <div class="d-inline">
                                                <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#confirm" data-id='SK/delete/<?= $list['id']; ?>' title="Hapus Data"><i data-feather="delete"></i> </a>
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