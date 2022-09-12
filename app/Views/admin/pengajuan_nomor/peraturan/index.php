<?= $this->extend('/admin/layout/main'); ?>
<?= $this->section('style'); ?>
<link href="/tema/admin/circl/theme/assets/css/custom.css" rel="stylesheet">
<?= $this->endSection(); ?>
<?= $this->section('content'); ?>
<div class="page-content">
    <div class="main-wrapper">
        <!-- alert -->
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
        <div class="row">
            <div class="col-sm-12 col-md-4 m-b-md">
                <!-- menu ajuan nomor -->
                <div class="card">
                    <?php
                    $jml_Peraturan = 0;
                    $jml_SK = 0;
                    $jml_SE = 0;
                    foreach ($data as $value) {
                        if ($value['kategori'] === 'PERATURAN') {
                            $jml_Peraturan += 1;
                        } elseif ($value['kategori'] === 'SK') {
                            $jml_SK += 1;
                        } else {
                            $jml_SE += 1;
                        }
                    }
                    ?>
                    <div class="card-body">
                        <h5 class="card-title">Pengajuan Nomor</h5>
                        <div class="email-list">
                            <ul class="list-unstyled pt-10 pb-200">
                                <li class="tab">
                                    <a href="#peraturan" class="tablinks" onclick="openNomor(event,'Peraturan')">
                                        <div class="email-list-item">
                                            <div class="email-author">
                                                <i class="fas fa-file"></i>
                                                <span class="author-name">Peraturan</span>
                                                <span class="email-date"><?= $jml_Peraturan . ' Nomor'; ?></span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#sk" class="tablinks" onclick="openNomor(event,'SK')">
                                        <div class="email-list-item">
                                            <div class="email-author">
                                                <i class="fas fa-book"></i>
                                                <span class="author-name">Surat Keterangan</span>
                                                <span class="email-date"><?= $jml_SK . ' Nomor'; ?></span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#se" class="tablinks" onclick="openNomor(event,'SE')">
                                        <div class="email-list-item">
                                            <div class="email-author">
                                                <i class="fas fa-envelope"></i>
                                                <span class="author-name">Surat Edaran</span>
                                                <span class="email-date"><?= $jml_SE . ' Nomor'; ?></span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- recently added  -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Recently Added </h5>
                        <div class="email-list">
                            <ul class="list-unstyled">
                                <?php foreach ($data as $key => $value) {
                                    if ($key === 3) {
                                        break;
                                    }
                                ?>
                                    <li>
                                        <a>
                                            <div class="email-value-item">
                                                <div class="email-author">
                                                    <span class="author-name"><?= $value['kategori']; ?></span>
                                                    <span class="email-date"><?= 'Nomor : '  . $value['no_dokumen']; ?></span>
                                                </div>
                                                <div class="email-info">
                                                    <span class="email-text">
                                                        <?= format_indo($value['tanggal_dokumen']); ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content Peraturan -->
            <div class="col-sm-12 col-md-8 tabcontent" id="Peraturan">
                <div class="card ">
                    <div class="card-body">
                        <div class="open-email-content">
                            <div class="mail-header">
                                <div class="mail-title">
                                    <h4>PERATURAN</h4>
                                </div>
                                <div class="mail-actions">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-success">Download Rekap</button>
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#inputDataPeraturan" class="btn btn-primary">Tambah Data</button>
                                    </div>
                                </div>
                            </div>
                            <div class="mail-text">
                                <table id="table" class="display table-hover table invoice-table" style=" width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Perihal</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($data as $value) { ?>
                                            <?php if ($value['kategori'] === 'PERATURAN') {
                                            } else {
                                                continue;
                                            } ?>
                                            <tr>
                                                <td width="5%"><?= $value['no_dokumen']; ?></td>
                                                <td width="20%"><?= format_indo($value['tanggal_dokumen']); ?></td>
                                                <td><?= $value['perihal']; ?></td>
                                                <!-- action -->
                                                <td width='5%'>
                                                    <div class="btn-group">
                                                        <div class="btn-group">
                                                            <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#updateData" data-no='<?= $value['no_dokumen']; ?>' data-perihal='<?= $value['perihal'] ?>' data-kategori='<?= $value['kategori']; ?>' data-idupdate='PengajuanNomor/update/<?= $value['id']; ?>' data-nomor="<?= $value['no_dokumen']; ?> " data-tanggal_dokumen=<?= $value['tanggal_dokumen']; ?> title="Edit Data"><i data-feather="edit"></i> </a>
                                                            <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#confirm" data-id='PengajuanNomor/delete/<?= $value['id']; ?>' title="Hapus Data"><i data-feather="delete"></i> </a>
                                                        </div>
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
            <!-- content SK -->
            <div class="col-sm-12 col-md-8 tabcontent " id="SK">
                <div class="card ">
                    <div class="card-body">
                        <div class="open-email-content">
                            <div class="mail-header">
                                <div class="mail-title">
                                    <h4>Surat Keterangan</h4>
                                </div>
                                <div class="mail-actions">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-success">Download Rekap</button>
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#inputDataSK" class="btn btn-primary">Tambah Data</button>
                                    </div>
                                </div>
                            </div>
                            <div class="mail-text">
                                <table id="table" class="display table-hover table invoice-table" style=" width:120%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Perihal</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php foreach ($data as $value) { ?>
                                            <?php if ($value['kategori'] === 'SK') {
                                            } else {
                                                continue;
                                            } ?>
                                            <tr>
                                                <td width="5%"><?= $value['no_dokumen']; ?></td>
                                                <td width="20%"><?= format_indo($value['tanggal_dokumen']); ?></td>
                                                <td><?= $value['perihal']; ?></td>
                                                <!-- action -->
                                                <td width='5%'>
                                                    <div class="btn-group">
                                                        <div class="btn-group">
                                                            <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#updateData" data-no='<?= $value['no_dokumen']; ?>' data-perihal='<?= $value['perihal'] ?>' data-kategori='<?= $value['kategori']; ?>' data-idupdate='PengajuanNomor/update/<?= $value['id']; ?>' data-nomor="<?= $value['no_dokumen']; ?>" data-tanggal_dokumen=<?= $value['tanggal_dokumen']; ?> title=" Edit Data"><i data-feather="edit"></i> </a>
                                                            <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#confirm" data-id='PengajuanNomor/delete/<?= $value['id']; ?>' title="Hapus Data"><i data-feather="delete"></i> </a>
                                                        </div>
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
            <!-- content SE -->
            <div class="col-sm-12 col-md-8 tabcontent" id="SE">
                <div class="card ">
                    <div class="card-body">
                        <div class="open-email-content">
                            <div class="mail-header">
                                <div class="mail-title">
                                    <h4>Surat Edaran</h4>
                                </div>
                                <div class="mail-actions">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-success">Download Rekap</button>
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#inputDataSE" class="btn btn-primary">Tambah Data</button>
                                    </div>
                                </div>
                            </div>
                            <div class="mail-text">
                                <table id="table" class="display table-hover table invoice-table" style=" width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Perihal</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php foreach ($data as $value) { ?>
                                            <?php if ($value['kategori'] === 'SE') {
                                            } else {
                                                continue;
                                            } ?>
                                            <tr>
                                                <td width="5%"><?= $value['no_dokumen']; ?></td>
                                                <td width="20%"><?= format_indo($value['tanggal_dokumen']); ?></td>
                                                <td><?= $value['perihal']; ?></td>
                                                <!-- action -->
                                                <td width="5%">
                                                    <div class="btn-group">
                                                        <div class="btn-group">
                                                            <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#updateData" data-no='<?= $value['no_dokumen']; ?>' data-perihal='<?= $value['perihal'] ?>' data-kategori='<?= $value['kategori']; ?>' data-idupdate='PengajuanNomor/update/<?= $value['id']; ?>' data-nomor="<?= $value['no_dokumen']; ?>" data-tanggal_dokumen=<?= $value['tanggal_dokumen']; ?> title="Edit Data"><i data-feather="edit"></i> </a>
                                                            <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#confirm" data-id='PengajuanNomor/delete/<?= $value['id']; ?>' title="Hapus Data"><i data-feather="delete"></i> </a>
                                                        </div>
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
    </div>
</div>
<!-- file modal  -->
<?= $this->include('admin/pengajuan_nomor/modal'); ?>
<?= $this->renderSection('input'); ?>
<?= $this->endSection(); ?>
<?= $this->section('source'); ?>
<script src="/tema/admin/circl/theme/assets/js/pages/charts.js"></script>
<script>
    window.onload = function() {
        document.getElementById('SK').style.display = "block";
        evt.currentTarget.className += " active";


    }

    function openNomor(evt, namaAjuan) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        document.getElementById(namaAjuan).style.display = "block";
        evt.currentTarget.className += " active";
    }
</script>
<!-- fungsi show edit modal -->
<script>
    $(document).ready(function() {
        // Untuk sunting
        $('#updateData').on('show.bs.modal', function(event) {
            var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
            var modal = $(this)
            // Isi nilai pada field
            modal.find('#idupdate').attr("action", div.data('idupdate'));
            modal.find('#perihal').val(div.data('perihal'));
            modal.find('#no_dokumen').attr("value", div.data('nomor'));
            modal.find('#tanggal_dokumen').attr("value", div.data('tanggal_dokumen'));
            modal.find('#kategori').val(div.data('kategori'));

        });
    });
</script>
<!-- fungsi show confirm modal -->
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

<!-- fungsi date picker format tahun -->
<script>
    $(".tahun").datepicker({
        format: "yyyy",
        viewMode: "years",
        minViewMode: "years"
    });
</script>
<?= $this->endSection(); ?>