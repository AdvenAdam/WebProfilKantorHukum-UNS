<?= $this->extend('/admin/layout/main'); ?>
<?= $this->section('content'); ?>
<div class="page-content">
    <div class="main-wrapper">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h3 class="Card-title mb-4">Data Dokumen Internal (Khusus Untuk Kantor Hukum)</h3>
                        <div class="row mb-4">
                            <div class="col-6">
                                <div class="btn-group">
                                    <a href="javascript;" data-bs-toggle="modal" data-bs-target="#inputData" class="btn btn-primary">Tambah Data</a>
                                    <a href="DokumenInternal/excel" class="btn btn-success"> <i class="fas fa-file-excel"> </i> Download Rekap Data</a>
                                </div>
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
                                    <th>No SK</th>
                                    <th>Tahun</th>
                                    <th>Judul</th>
                                    <th>Status Berlaku</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <?php $i = 1; ?>
                            <tbody>
                                <?php foreach ($dok_intern as $list) { ?>
                                    <tr>
                                        <td width="5%"><?= $list['no_sk']; ?></td>
                                        <td><?= $list['tahun']; ?></td>
                                        <td><?= $list['status'] == '1' ? '[ASLI]' : '[SALINAN]'; ?><?= strtoupper($list['judul']); ?></td>
                                        <td>
                                            <?php if ($list['status_berlaku'] == 1) { ?>
                                                <span class="badge rounded-pill bg-success">Berlaku</span>
                                            <?php } else if ($list['status_berlaku'] == 2) { ?>
                                                <span class="badge rounded-pill bg-danger">Tidak Berlaku</span>
                                            <?php } else { ?>
                                                <span class="badge rounded-pill bg-primary">Peraturan Tetap</span>
                                            <?php } ?>
                                        </td>
                                        <!-- action -->
                                        <td>
                                            <div class="btn-group">

                                                <a href="DokumenInternal/download/<?= $list['id']; ?>"><i data-feather="download"></i> </a>
                                                <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#updateData" data-sk='<?= $list['no_sk']; ?>' data-judul='<?= $list['judul'] ?>' data-tahun='<?= $list['tahun']; ?>' data-status='<?= $list['status']; ?>' data-idupdate='DokumenInternal/update/<?= $list['id']; ?>' data-mulai=<?= $list['mulai']; ?> data-sampai=<?= $list['sampai']; ?> title="Edit Data"><i data-feather="edit"></i> </a>

                                                <a href="DokumenInternal/detail/<?= $list['id']; ?>" title="Lihat"><i data-feather="eye"></i> </a>

                                                <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#confirm" data-id='DokumenInternal/delete/<?= $list['id']; ?>' title="Hapus Data"><i data-feather="delete"></i> </a>
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

<?= $this->include('admin/dokumen_internal/modal'); ?>
<?= $this->renderSection('input'); ?>
<?= $this->endSection(); ?>
<?= $this->section('source'); ?>
<script>
    $(document).ready(function() {
        // Untuk sunting
        $('#updateData').on('show.bs.modal', function(event) {
            var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
            var modal = $(this)
            // Isi nilai pada field
            modal.find('#idupdate').attr("action", div.data('idupdate'));
            modal.find('#judul').attr("value", div.data('judul'));
            modal.find('#tahun').attr("value", div.data('tahun'));
            modal.find('#no_sk').attr("value", div.data('sk'));
            modal.find('#mulai').attr("value", div.data('mulai'));
            modal.find('#sampai').attr("value", div.data('sampai'));
            modal.find('#status').val(div.data('status'));

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