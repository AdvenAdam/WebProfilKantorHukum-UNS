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

<!-- Modal  input -->
<div class="modal fade" id="Input" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Input Data</h5>
                <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <form action="/Admin/Template/save" id="id" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <?php csrf_field(); ?>
                    <div class="form-floating mb-4">
                        <input type="text" value="<?= old('judul'); ?>" name="judul" class="form-control" placeholder="judul" required>
                        <label for="judul">Judul</label>
                    </div>
                    <div class="form-floating mb-4">
                        <input type="file" name="file" value="<?= old('file'); ?>" class="dropify form-control" data-height="300" required>
                        <label for="file">File</label>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary d-inline">Kirim</button>
                    <a class="btn btn-secondary" data-bs-dismiss="modal">Tutup</a>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal  Update -->
<?php foreach ($template as $val) { ?>
    <div class="modal fade" id="Update<?= $val['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Update Data Template</h5>
                    <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <form action="" id="id" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <?php csrf_field(); ?>
                        <div class="form-floating mb-4">
                            <input type="text" id="judul" value="<?= $val['judul'] ? $val['judul'] : old('judul'); ?>" name="judul" class="form-control" placeholder="judul">
                            <label for="judul">Judul</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="file" id="file" name="file" class="dropify" data-height="300" data-default-file="/dokumen/template/<?= $val['file']; ?>">
                            <label for="file">File</label>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary d-inline">Kirim</button>
                        <a class="btn btn-secondary" data-bs-dismiss="modal">Tutup</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>