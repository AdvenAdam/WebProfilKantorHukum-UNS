<?= $this->extend('/admin/layout/main'); ?>
<?= $this->section('content'); ?>
<div class="page-content">
    <div class="main-wrapper">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h3 class="Card-title mb-4">Data Masukan Tersimpan</h3>
                        <div class="row mb-4">

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
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>No. HP</th>
                                    <th>Subject</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <?php $i = 1; ?>
                            <tbody>
                                <?php foreach ($kontak as $list) { ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $list['nama']; ?></td>
                                        <td><?= $list['email']; ?></td>
                                        <td><?= $list['phone']; ?></td>
                                        <td><?= $list['subject']; ?></td>
                                        <!-- action -->
                                        <td>
                                            <div class="d-inline">
                                                <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#view" data-nama="<?= $list['nama']; ?>" data-email="<?= $list['email']; ?>" data-phone="<?= $list['phone']; ?>" data-subject="<?= $list['subject']; ?>" data-pesan="<?= $list['pesan']; ?>" data-id='Masukan/view/<?= $list['id']; ?>' title="View Data"><i data-feather="eye"></i> </a>
                                            </div>
                                            <div class="d-inline">
                                                <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#confirm" data-id='Masukan/delete/<?= $list['id']; ?>' title="Hapus Data"><i data-feather="delete"></i> </a>
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


<!-- modal View -->
<div class="modal fade" id="view" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Detail Masukan</h5>
                <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <div class="form-floating mb-3">
                    <input type="text" value="" class="form-control" placeholder="zzzz" readonly id="nama">
                    <label for="nama">Nama</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" value="" class="form-control" placeholder="zzzz" readonly id="email">
                    <label for="email">Email</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" value="" class="form-control" placeholder="zzzz" readonly id="phone">
                    <label for="phone">No HP</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" value="" class="form-control" placeholder="zzzz" readonly id="subject">
                    <label for="subject">Subject</label>
                </div>
                <div class="form-floating mb-3">
                    <textarea cols="30" id="pesan" rows="50" class="form-control" readonly></textarea>
                    <label for="pesan">Pesan</label>
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-secondary" data-bs-dismiss="modal">Tutup</a>
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
        $('#view').on('show.bs.modal', function(event) {
            var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
            var modal = $(this)

            // Isi nilai pada field
            modal.find('#id').attr("action", div.data('id'));
            modal.find('#nama').attr("value", div.data('nama'));
            modal.find('#email').attr("value", div.data('email'));
            modal.find('#phone').attr("value", div.data('phone'));
            modal.find('textarea#pesan').val(div.data('pesan'));
            modal.find('#subject').attr("value", div.data('subject'));
        });
    });
</script>
<?= $this->endSection(); ?>