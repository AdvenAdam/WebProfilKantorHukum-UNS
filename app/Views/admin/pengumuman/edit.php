<?= $this->extend('admin/layout/main'); ?>
<?= $this->Section('content'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
<style>
    .ck-editor__editable {
        min-height: 300px;
    }

    .title-img {
        width: 660px;
        margin: 40px auto 0;
    }

    .dropify-wrapper .dropify-preview {
        padding: 0 ! important;
    }

    .dropify-wrapper .dropify-preview .dropify-render img {
        width: 100%;
        height: 100%;
        -webkit-transform: none;
        transform: none;
        top: 0;
    }

    .dropify-wrapper {
        border: 0;
        background-color: #f7f8f9;
        padding: 0 ! important;
    }

    p {
        margin: 0;
    }
</style>
<div class="page-content">
    <div class="main-wrapper">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body pl-6 pb-6">
                        <h5 class="card-title">Form Edit Pengumuman</h5>
                        <div class="row">
                            <div class="col-12">
                                <form action="/Admin/Pengumuman/update/<?= $pengumuman['id']; ?>" method="Post" enctype="multipart/form-data">
                                    <?= csrf_field(); ?>
                                    <div class="form-floating mb-3">
                                        <input type="text" value="<?= old('judul') ? old('judul') : $pengumuman['judul']; ?>" name="judul" id="judul" class="form-control <?= $validation->hasError('judul') ? 'is-invalid' : '' ?>" placeholder="judul">
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
                                    <label>Gambar</label>
                                    <div class="form-floating mb-3">
                                        <div class="row">
                                            <div class="col-3"></div>
                                            <div class="col-6">
                                                <div class="card radius-15">
                                                    <div class="card-body">
                                                        <input type="file" name="gambar" id="file" data-height="500px" data-default-file="/image/pengumuman/<?= $pengumuman['gambar']; ?>" class="dropify">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-3"></div>
                                        </div>
                                    </div>
                                    <label for="isi" class="form-label">Isi Pengumuman</label>
                                    <div class="form-floating mb-3">
                                        <textarea name="isi" class="form-control edit" id="isi">
                                            <?= $pengumuman['isi']; ?>
                                 </textarea>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="cek" name="cekToSlider" <?= $centang == "true" ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="cek">
                                            <b>
                                                Tampilkan juga di Slider
                                            </b>
                                        </label>
                                    </div>

                                    <div class="row">
                                        <div class="col-6">
                                            <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirm">Simpan</a>
                                        </div>
                                        <div class="col-6" align="right">
                                            <a href="/Admin/Pengumuman" class="btn btn-secondary">Kembali</a>
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
<!-- ckeditor 5 -->
<script src="/tema/admin/circl/theme/assets/plugins/ckeditor5/build/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('.edit'), {
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