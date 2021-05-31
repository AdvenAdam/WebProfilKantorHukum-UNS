<?= $this->extend('/admin/layout/main'); ?>
<?= $this->section('content'); ?>
<div class="page-content">
    <div class="main-wrapper">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h3 class="Card-title ">Data Informasi Kantor Hukum</h3>
                        <div class="row ">
                        </div>
                        <?php if (session()->getFlashdata('success')) { ?>
                            <div class="alert alert-success fade show" role="alert">
                                <span><?= session()->getFlashdata('success'); ?></span>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <?php foreach ($informasi as $value) { ?>

            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="Card-title ">Profil Kantor Hukum UNS</h3>
                        </div>
                        <div class="card-body">

                            <?= $value['profil']; ?>

                        </div>
                        <div class="card-footer">
                            <a href="" data-bs-toggle="modal" data-bs-target="#editProfil" class="btn btn-success">Ubah data</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="Card-title ">Tugas Pokok Kantor Hukum UNS</h3>
                        </div>
                        <div class="card-body">
                            <?= $value['tugas_pokok']; ?>
                        </div>
                        <div class="card-footer">
                            <a href="" data-bs-toggle="modal" data-bs-target="#editTugas" class="btn btn-success">Ubah data</a>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <!-- modal edit -->
    <div class="modal fade" id="editProfil" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Form Ubah Informasi</h5>
                    <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <form action="Informasi/update/<?= $value['id']; ?>" method="POST">
                    <?php csrf_field(); ?>
                    <div class="modal-body">
                        <div class="row mb-4">
                            <label for="profil" class="form-label">Profil Kantor Hukum UNS</label>
                            <textarea name="profil" rows="100" class=" form-control" id="profil"><?= $value['profil']; ?>
                                     </textarea>
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
    <div class="modal fade" id="editTugas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Form Ubah Informasi</h5>
                    <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <form action="Informasi/update/<?= $value['id']; ?>" method="POST">
                    <?php csrf_field(); ?>
                    <div class="modal-body">
                        <div class="row mb-4">
                            <label for="tugas" class="form-label">Tugas Pokok Kantor Hukum UNS</label>
                            <textarea name="tugas" rows="100" class=" form-control" id="tugas"><?= $value['tugas_pokok']; ?>
                                     </textarea>
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
<?php } ?>
</div>


<?= $this->renderSection('input'); ?>
<?= $this->endSection(); ?>
<?= $this->section('source'); ?>
<!-- tinymce -->
<script src="/tema/admin/circl/theme/assets/plugins/tinymce/tinymce.min.js"></script>
<!-- tinymce WYSWYG -->
<script>
    tinymce.init({
        selector: '#profil',
        height: 400,
        images_upload_handler: function(blobInfo, success, failure) {
            var xhr, formData;
            xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            xhr.open('POST', '/home/profile/about/img');
            var token = '{{ csrf_token() }}';
            xhr.setRequestHeader("X-CSRF-Token", token);
            xhr.onload = function() {
                var json;
                if (xhr.status != 200) {
                    failure('HTTP Error: ' + xhr.status);
                    return;
                }
                json = JSON.parse(xhr.responseText);

                if (!json || typeof json.location != 'string') {
                    failure('Invalid JSON: ' + xhr.responseText);
                    return;
                }
                success(json.location);
            };
            formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.filename());
            xhr.send(formData);
        }
    });
</script>
<script>
    tinymce.init({
        selector: '#tugas',
        height: "400",
        images_upload_handler: function(blobInfo, success, failure) {
            var xhr, formData;
            xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            xhr.open('POST', '/home/profile/about/img');
            var token = '{{ csrf_token() }}';
            xhr.setRequestHeader("X-CSRF-Token", token);
            xhr.onload = function() {
                var json;
                if (xhr.status != 200) {
                    failure('HTTP Error: ' + xhr.status);
                    return;
                }
                json = JSON.parse(xhr.responseText);

                if (!json || typeof json.location != 'string') {
                    failure('Invalid JSON: ' + xhr.responseText);
                    return;
                }
                success(json.location);
            };
            formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.filename());
            xhr.send(formData);
        }
    });
</script>
<?= $this->endSection(); ?>