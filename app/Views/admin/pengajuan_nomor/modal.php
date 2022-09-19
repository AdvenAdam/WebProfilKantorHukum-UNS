<!-- Modal Insert Data -->
<div class="modal fade" id="inputDataPeraturan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Form Pengajuan Nomor</h5>
                <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <form action="/Admin/PengajuanNomor/save" method="Post" enctype="multipart/form-data">
                <div class="modal-body">
                    <?= csrf_field(); ?>
                    <div class="form-floating mb-4">
                        <select class="form-select" name="kategori">
                            <option value="PERATURAN">PERATURAN</option>
                            <option value="SK">SK</option>
                            <option value="SE">SE</option>
                        </select>
                        <label>Pilih Jenis Dokumen</label>
                    </div>
                    <div class="form-floating mb-4">
                        <input type="text" value="" name="pengusul" class="form-control" placeholder="pengusul" required>
                        <label for="pengusul">Pengusul</label>
                    </div>
                    <div class="form-floating mb-4">
                        <input type="text" value="" name="no_dokumen" class="form-control" placeholder="no_dokumen" required>
                        <label for="no_dokumen">No</label>
                    </div>
                    <div class="form-floating mb-4">
                        <textarea name="perihal" id="" style="height:100px;" class='form-control' required><?= old('perihal'); ?></textarea>
                        <label for="perihal">Perihal</label>
                    </div>
                    <div class="form-floating mb-4">
                        <div class="row">
                            <div class="col-4">
                                <label for="tanggal_ditetapkan">Tanggal Ditetapkan</label>
                                <input type="date" value="" name="tanggal_ditetapkan" class="form-control" id="tanggal_ditetapkan" placeholder="tanggal_ditetapkan">
                            </div>
                        </div>
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
<!-- Modal Inser Data SK -->
<div class="modal fade" id="inputDataSK" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Form Pengajuan Nomor</h5>
                <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <form action="/Admin/PengajuanNomor/save" method="Post" enctype="multipart/form-data">
                <div class="modal-body">
                    <?= csrf_field(); ?>
                    <div class="form-floating mb-4">
                        <select class="form-select " name="kategori">
                            <option value="SK">SK</option>
                            <option value="PERATURAN">PERATURAN</option>
                            <option value="SE">SE</option>
                        </select>
                        <label>Pilih Jenis Dokumen</label>
                    </div>
                    <div class="form-floating mb-4">
                        <input type="text" value="" name="pengusul" class="form-control" placeholder="pengusul" required>
                        <label for="pengusul">Pengusul</label>
                    </div>
                    <div class="form-floating mb-4">
                        <input type="text" value="/UN27/HK/<?= date('Y'); ?>" name="no_dokumen" class="form-control" placeholder="no_dokumen" required>
                        <label for="no_dokumen">No</label>
                    </div>
                    <div class="form-floating mb-4">
                        <textarea name="perihal" id="" style="height:100px;" class='form-control' required><?= old('perihal'); ?></textarea>
                        <label for="perihal">Perihal</label>
                    </div>
                    <div class="form-floating mb-4">
                        <div class="row">
                            <div class="col-4">
                                <label for="tanggal_ditetapkan">Tanggal Ditetapkan</label>
                                <input type="date" value="" name="tanggal_ditetapkan" class="form-control" id="tanggal_ditetapkan" placeholder="tanggal_ditetapkan">
                            </div>
                        </div>
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
<!-- Modal Insert Data SE -->
<div class="modal fade" id="inputDataSE" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Form Pengajuan Nomor</h5>
                <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <form action="/Admin/PengajuanNomor/save" method="Post" enctype="multipart/form-data">
                <div class="modal-body">
                    <?= csrf_field(); ?>
                    <div class="form-floating mb-4">
                        <select class="form-select " name="kategori">
                            <option value="SE">SE</option>
                            <option value="PERATURAN">PERATURAN</option>
                            <option value="SE">SE</option>
                        </select>
                        <label>Pilih Jenis Dokumen</label>
                    </div>
                    <div class="form-floating mb-4">
                        <input type="text" value="" name="pengusul" class="form-control" placeholder="pengusul" required>
                        <label for="pengusul">Pengusul</label>
                    </div>
                    <div class="form-floating mb-4">
                        <input type="text" value="/UN27/" name="no_dokumen" class="form-control" placeholder="no_dokumen" required>
                        <label for="no_dokumen">No</label>
                    </div>
                    <div class="form-floating mb-4">
                        <textarea name="perihal" id="" style="height:100px;" class='form-control' required><?= old('perihal'); ?></textarea>
                        <label for="perihal">Perihal</label>
                    </div>
                    <div class="form-floating mb-4">
                        <div class="row">
                            <div class="col-4">
                                <label for="tanggal_ditetapkan">Tanggal Ditetapkan</label>
                                <input type="date" value="" name="tanggal_ditetapkan" class="form-control" id="tanggal_ditetapkan" placeholder="tanggal_ditetapkan">
                            </div>
                        </div>
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
<!-- -------------------------------------------------------------------------------- -->
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
<!-- -------------------------------------------------------------------------------- -->
<!-- Modal Update Data -->
<div class="modal fade" id="updateData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Form Edit Data</h5>
                <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <form id="idupdate" method="Post" enctype="multipart/form-data">
                <div class="modal-body">
                    <?= csrf_field(); ?>
                    <div class="form-floating mb-4">
                        <select class="form-select" id="kategori" name="kategori">
                            <option value="" selected>Buka Pilihan Jenis</option>
                            <option value="PERATURAN">PERATURAN</option>
                            <option value="SK">SK</option>
                            <option value="SE">SE</option>
                        </select>
                        <label>Pilih Jenis Dokumen</label>
                    </div>
                    <div class="form-floating mb-4">
                        <input type="text" value="<?= old('pengusul'); ?>" name="pengusul" class="form-control " id="pengusul" placeholder="pengusul">
                        <label for="pengusul">Pengusul</label>
                    </div>
                    <div class="form-floating mb-4">
                        <input type="text" value="<?= old('no_dokumen'); ?>" name="no_dokumen" class="form-control " id="no_dokumen" placeholder="no_dokumen">
                        <label for="no_dokumen">No</label>
                    </div>
                    <div class="form-floating mb-4">
                        <textarea id="perihal" name="perihal" style="height:100px;" class='form-control' required></textarea>
                        <label for="perihal">Perihal</label>
                    </div>
                    <div class="form-floating mb-4">
                        <div class="row">
                            <div class="col-4">
                                <label for="tanggal_ditetapkan"> tanggal_ditetapkan</label>
                                <input type="date" value="" name="tanggal_ditetapkan" class="form-control" id="tanggal_ditetapkan" placeholder="tanggal_ditetapkan">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success d-inline">Tambah Data</button>
                    <a class="btn btn-secondary" data-bs-dismiss="modal">Tutup</a>
                </div>
            </form>
        </div>
    </div>
</div>