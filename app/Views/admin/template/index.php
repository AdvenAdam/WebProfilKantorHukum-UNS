<?= $this->extend('/admin/layout/main'); ?>
<?= $this->Section('Style'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">

<?= $this->endSection(); ?>
<?= $this->section('content'); ?>
<div class="page-content">
    <div class="main-wrapper">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h3 class="Card-title mb-4">Data Template Tersimpan</h3>
                        <div class="row mb-4">
                            <div class="col-6">
                                <a href="javascript;" data-bs-toggle="modal" data-bs-target="#Input" class="btn btn-primary">Tambah Data</a>
                            </div>
                            <div class="col-6" align="right">
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
                                    <th width="5%">No</th>
                                    <th>Judul</th>
                                    <th>Unduh</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <?php $i = 1; ?>
                            <tbody>
                                <?php foreach ($template as $list) { ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $list['judul']; ?></td>
                                        <td><a href="Template/download/<?= $list['id']; ?>"><i data-feather="download"></i></a></td>
                                        <!-- action -->
                                        <td>
                                            <div class="d-inline">
                                                <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#Update<?= $list['id']; ?>" title="Edit"><i data-feather="edit"></i> </a>
                                            </div>
                                            <div class="d-inline">
                                                <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#confirm" data-id='Template/delete/<?= $list['id']; ?>' title="Hapus Data"><i data-feather="delete"></i> </a>
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
<?= $this->include('/admin/template/modal'); ?>
<?= $this->endSection(); ?>
<?= $this->section('source'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.dropify').dropify({
            messages: {
                default: 'Upload Dokumen',
                replace: 'Ganti',
                remove: 'Hapus',
                error: 'error'
            }
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