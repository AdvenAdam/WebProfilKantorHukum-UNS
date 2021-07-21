<?= $this->extend('admin/layout/main'); ?>
<?= $this->Section('content'); ?>

<div class="page-content">
    <div class="main-wrapper">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body pl-6 pb-6">
                        <h5 class="card-title">Form Input Pengajuan SK Pengangkatan/Pemberhentian</h5>
                        <div class="row">
                            <div class="col-12">
                                <form action="/Admin/SK/save" method="Post" enctype="multipart/form-data">
                                    <?= csrf_field(); ?>
                                    <!-- tentang -->
                                    <div class="row mt-2 mb-4">
                                        <div class="col-2"><b>Tentang</b></div>
                                        <div class="col-10">
                                            <textarea required name="tentang" rows="3" id='tentang' class="editor form-control"></textarea>
                                        </div>
                                    </div>
                                    <!-- penandatangan -->
                                    <div class="row mt-2 mb-4">
                                        <div class="col-2">
                                            <b>Penandatangan</b>
                                        </div>
                                        <div class="col-10">
                                            <select class="form-select select" name="penandatangan" id="penandatangan">
                                                <option value="" data-pangkatgol="Silahkan Pilih Penandatangan">Pilih Nama </option>
                                                <?php foreach ($pegawai as $list) { ?><option value="<?= $list['id']; ?>" data-pangkatgol="<?= $list['pangkatgol']; ?>"><?= $list['nama']; ?></option><?php } ?>\
                                            </select>
                                        </div>
                                    </div>
                                    <!-- menimbang -->
                                    <div class="row mt-2 mb-4">
                                        <div class="col-2"> <b>Menimbang</b></div>
                                        <div class="col-10">
                                            <div class="container1">
                                            </div>
                                            <button class="add_menimbang btn btn-primary">Add New Field &nbsp;
                                                <span style="font-size:16px; font-weight:bold;">+ </span>
                                            </button>
                                        </div>
                                    </div>
                                    <!-- mengingat -->
                                    <div class="row mt-2 mb-4">
                                        <div class="col-2"> <b>Mengingat</b></div>
                                        <div class="col-10">
                                            <div class="container0">
                                            </div>
                                            <button class="add_mengingat btn btn-primary">Add New Field &nbsp;
                                                <span style="font-size:16px; font-weight:bold;">+ </span>
                                            </button>
                                        </div>
                                    </div>
                                    <!-- memutuskan -->
                                    <div class="row">
                                        <div class="row mt-2 mb-4">
                                            <center>
                                                <b> Memutuskan</b>
                                            </center>
                                        </div>
                                        <div class="row mt-2 mb-4">
                                            <div class="col-2">MENETAPKAN</div>
                                            <div class="col-10">
                                                <textarea name="memutuskan[]" rows="3" readonly id='memutuskan' class="editor form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="memutuskan">
                                        </div>
                                        <div class="row mt-2 mb-4">
                                            <div class="col-2"></div>
                                            <div class="col-10">
                                                <button class="add_memutuskan btn btn-primary">Add New Field &nbsp;
                                                    <span style="font-size:16px; font-weight:bold;">+ </span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- lampiran -->
                                    <div class="row">
                                        <div class="row mt-2 mb-4">
                                            <label><b>Lampiran</b></label>
                                        </div>
                                        <div class="row mt-2 mb-4">
                                            <div class="accordion" id="accordionExample">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingOne">
                                                        <button class="btn btn-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                            Lampiran berdasarkan pegawai uns
                                                        </button>
                                                        <button class="btn btn-secondary collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                            Lampiran Custom
                                                        </button>
                                                    </h2>
                                                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <div class="row mt-2 mb-4">
                                                                <label>keterangan</label>
                                                                <textarea name="keterangan_uns" class="form-control" rows="3"></textarea>
                                                            </div>
                                                            <table class="display table-hover invoice-table" style="margin-top: 10px; width:100%">
                                                                <thead>
                                                                    <tr>
                                                                        <th>No</th>
                                                                        <th>Nama</th>
                                                                        <th>NIK/NIP</th>
                                                                        <th>Pangkat, Golongan</th>
                                                                        <th>Keterangan</th>
                                                                        <th>#</th>
                                                                    </tr>
                                                                </thead>
                                                                <?php $i = 1; ?>
                                                                <tbody class="lampiranuns">
                                                                    <!-- muncul disini -->
                                                                </tbody>
                                                            </table>
                                                            <button class="add_lampiran_uns btn btn-primary mt-5">Add New Field &nbsp;
                                                                <span style="font-size:16px; font-weight:bold;">+ </span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item">

                                                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <div class="row mt-2 mb-4">
                                                                <label>keterangan</label>
                                                                <textarea name="keterangan_siswa" class="form-control" rows="3"></textarea>
                                                            </div>
                                                            <table class="display table-hover invoice-table" style=" width:100%">
                                                                <thead>
                                                                    <tr>
                                                                        <th>No</th>
                                                                        <th>Nama</th>
                                                                        <th>NIM</th>
                                                                        <th>Prodi</th>
                                                                        <th>Keterangan</th>
                                                                        <th>#</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody class=lampiransiswa>
                                                                    <!-- lampiran siswa show  -->
                                                                </tbody>
                                                            </table>
                                                            <button class="add_lampiran_siswa btn btn-primary mt-5">Add New Field &nbsp;
                                                                <span style="font-size:16px; font-weight:bold;">+ </span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- button simpan -->
                                    <div class="row">
                                        <div class="col-6">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                        <div class="col-6" align="right">
                                            <a href="/Admin/Peraturan" class="btn btn-secondary">Kembali</a>
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

    <?= $this->endSection(); ?>
    <?= $this->section('source'); ?>
    <?= $this->include('/admin/sk/input-js'); ?>
    <?= $this->endSection(); ?>