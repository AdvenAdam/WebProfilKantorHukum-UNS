<?= $this->extend('/admin/layout/main'); ?>
<?= $this->section('content'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
<style>
    .ck-editor__editable {
        min-height: 300px;
    }
</style>
<div class="page-content">
    <div class="main-wrapper">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h3 class="Card-title mb-4">Data Pengumuman Tersimpan</h3>
                        <div class="row mb-4">
                            <div class="col-6">
                                <a href="javascript;" data-bs-toggle="modal" data-bs-target="#inputData" class="btn btn-primary">Tambah Data</a>
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
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Tanggal</th>
                                    <th>Penulis</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <?php $i = 1; ?>
                            <tbody>
                                <?php foreach ($pengumuman as $list) { ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $list['judul']; ?></td>
                                        <td><?= format_indo($list['created_at']); ?></td>
                                        <td><?= $list['creator']; ?></td>

                                        <!-- action -->
                                        <td>
                                            <div class="d-inline">
                                                <a href="/Admin/Pengumuman/edit/<?= $list['id']; ?>" title="Edit"><i data-feather="edit"></i> </a>
                                            </div>
                                            <div class="d-inline">
                                                <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#detail" title="Detail" data-judul="<?= $list['judul']; ?>" data-gambar="/image/pengumuman/<?= $list['gambar']; ?>" data-tgl="<?= format_indo($list['created_at']); ?>" data-isi="<?= htmlspecialchars($list['isi']); ?>"><i data-feather="eye"></i> </a>
                                            </div>
                                            <div class="d-inline">
                                                <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#confirm" data-id='Pengumuman/delete/<?= $list['id']; ?>' title="Hapus Data"><i data-feather="delete"></i> </a>
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
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Form Input Data</h5>
                <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <form action="/Admin/Pengumuman/save" method="Post" enctype="multipart/form-data">
                <div class="modal-body">
                    <?= csrf_field(); ?>
                    <div class="form-floating mb-3">
                        <input type="text" value="<?= old('judul'); ?>" name="judul" class="form-control <?= $validation->hasError('judul') ? 'is-invalid' : '' ?>" placeholder="judul">
                        <label for="judul">Judul</label>
                        <div class="invalid-feedback">
                            <?= $validation->getError('judul'); ?>
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" value="<?= session()->user_name; ?>" name="creator" class="form-control <?= $validation->hasError('creator') ? 'is-invalid' : '' ?>" placeholder="Penulis" readonly>
                        <label for="penulis">Penulis</label>
                        <div class="invalid-feedback">
                            <?= $validation->getError('creator'); ?>
                        </div>
                    </div>
                    <label>Thumbnail</label>
                    <div class="form-floating mb-3">
                        <div class="card radius-15">
                            <div class="card-body">
                                <input type="file" name="gambar" id="file" value="" class="dropify" data-height="250" data-width="10">
                            </div>
                        </div>
                    </div>
                    <label for="isi" class="form-label">Isi Pengumuman</label>
                    <div class="form-floating mb-3">
                        <textarea name="isi" class="form-control input" rows="30"></textarea>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="cek" name="cekToSlider">
                        <label class="form-check-label" for="cek">
                            <b>
                                Tampilkan juga di Slider
                            </b>
                        </label>
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
<!-- Modal Detail Data -->
<div class="modal fade" id="detail" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="judul"></h5>
                <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <p><i><?= session()->user_name; ?> | </i><i id="tgl"></i></p>
                <img src="" id="gambar" alt="" height="40%" width="40%" class="img-fluid rounded mx-auto d-block">
                <br><br><br>
                <div class="row">
                    <div class="col" id="isi">

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="submit" class="btn btn-success d-inline">Tambah Data</button>
                <a class="btn btn-secondary" data-bs-dismiss="modal">Tutup</a>
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
<?= $this->endSection(); ?>
<?= $this->section('source'); ?>

<script>
    $(document).ready(function() {
        // Untuk Delete
        $('#confirm').on('show.bs.modal', function(event) {
            var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
            var modal = $(this)

            // Isi nilai pada field
            modal.find('#id').attr("action", div.data('id'));
        });
    });
</script>

<script>
    $(document).ready(function() {
        // Untuk Update
        $('#detail').on('show.bs.modal', function(event) {
            var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
            var modal = $(this)

            // Isi nilai pada field
            modal.find('#id').attr("action", div.data('id'));
            document.getElementById("tgl").innerHTML = div.data('tgl');
            document.getElementById("judul").innerHTML = div.data('judul');
            document.getElementById("isi").innerHTML = div.data('isi');
            modal.find('#gambar').attr("src", div.data('gambar'));
            // modal.find('#judul').attr("value", div.data('judul'));
        });
    });
</script>
<!-- ckeditor 5 -->
<script src="/tema/admin/circl/theme/assets/plugins/ckeditor5/build/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('.input'), {
            toolbar: {
                items: [
                    'heading', '|',
                    'alignment', '|',
                    'bold', 'italic', '|',
                    'link', '|',
                    'bulletedList', 'numberedList',
                    'fontfamily', 'fontsize', 'fontColor', 'fontBackgroundColor', '|',
                    'insertTable', '|',
                    'outdent', 'indent', '|',
                    'blockQuote', '|',
                    'undo', 'redo'
                ],
                shouldNotGroupWhenFull: true
            }
        })
        .catch(error => {
            console.log(error);
        });
</script>

<!-- dropify  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.dropify').dropify({
            messages: {
                default: 'Upload Gambar',
                replace: 'Ganti',
                remove: 'Hapus',
                error: 'error'
            }
        });
    });
</script>
<?= $this->endSection(); ?>