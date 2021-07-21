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
                                <form action="/Admin/SK/update/<?= $sk['id']; ?>" method="Post" enctype="multipart/form-data">
                                    <?= csrf_field(); ?>
                                    <!-- tentang -->
                                    <div class="row mt-2 mb-4">
                                        <div class="col-2"><b>Tentang</b></div>
                                        <div class="col-10">
                                            <textarea required name="tentang" rows="3" id='tentang' class="editor form-control"><?= $sk['tentang']; ?></textarea>
                                        </div>
                                    </div>
                                    <!-- penandatangan -->
                                    <div class="row mt-2 mb-4">
                                        <div class="col-2">
                                            <b>Penandatangan</b>
                                        </div>
                                        <div class="col-10">
                                            <select class="form-select select" height="100px" name="penandatangan" id="penandatangan">
                                                <option value="<?= json_decode($sk['penandatangan'])->id; ?>" data-pangkatgol="<?= json_decode($sk['penandatangan'])->pangkatgol; ?>" selected><?= json_decode($sk['penandatangan'])->nama; ?></option>
                                                <?php foreach ($pegawai as $list) { ?><option value="<?= $list['id']; ?>" data-pangkatgol="<?= $list['pangkatgol']; ?>"><?= $list['nama']; ?></option><?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- menimbang -->
                                    <div class="row mt-2 mb-4">
                                        <div class="col-2"> <b>Menimbang</b></div>
                                        <div class="col-10">
                                            <div class="container1">
                                                <?php foreach (json_decode($sk['menimbang']) as $key => $value) { ?>
                                                    <div class="content">
                                                        <div class="row mb-4" id="id">
                                                            <div class="col-10">
                                                                <label>Tambahkan nama</label>
                                                                <div class="col-12 mb-4">
                                                                    <select class="form-select select" id="select<?= $key; ?>">
                                                                        <option value="">Pilih Nama Pegawai</option>
                                                                        <?php foreach ($pegawai as $list) { ?><option value="<?= $list['nama']; ?>"><?= $list['nama']; ?></option><?php } ?>
                                                                    </select>
                                                                </div>
                                                                <div class="col-12">
                                                                    <textarea required name="menimbang[]" id="text<?= $key; ?>" rows="3" class="form-control text"><?= $value; ?></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-2">
                                                                <a href="#" class="delete btn btn-danger mt-5">Delete</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
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
                                                <?php foreach (json_decode($sk['mengingat']) as $key => $value) { ?>
                                                    <div class="konten">
                                                        <div class="row mb-4" id="id">
                                                            <div class="col-10">
                                                                <label>Tambahkan Peraturan</label>
                                                                <div class="col-12 mb-4">
                                                                    <select class="form-select select" name="mengingat[]" id="pilih<?= $key; ?>">
                                                                        <option value="<?= $value->id; ?>" data-detail="<?= $value->detail; ?>" selected><?= $value->herarki . ' Nomor ' . $value->nomor . ' Tahun ' . $value->tahun; ?></option>
                                                                        <?php foreach ($peraturan as $list) { ?><option value="<?= $list['id']; ?>" data-detail="<?= ($list['detail']); ?>"><?= $list['herarki'] . ' Nomor ' . $list['nomor'] . ' Tahun ' . $list['tahun']; ?></option><?php } ?>
                                                                    </select>
                                                                </div>
                                                                <div class="col-12">
                                                                    <textarea id="textarea<?= $key; ?>" readonly rows="3" class="form-control text"><?= $value->detail; ?></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-2">
                                                                <a href="#" class="delete btn btn-danger mt-5">Delete</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
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
                                                <textarea name="memutuskan[]" rows="3" readonly id='memutuskan' class="editor form-control"><?= json_decode($sk['memutuskan'])[0] ?></textarea>
                                            </div>
                                        </div>
                                        <div class="memutuskan">
                                            <?php function numbering($key)
                                            {
                                                $urutan = ["MENETAPKAN", "KESATU", "KEDUA", "KETIGA", "KEEMPAT", "KELIMA", "KEENAM", "KETUJUH", "KEDELAPAN", "KESEMBILAN", "KESEPULUH", "KESEBELAS", "KEDUA BELAS", "KETIGA BELAS", "KEEMPAT BELAS", "KELIMA BELAS"];
                                                return $urutan[$key];
                                            }
                                            ?>
                                            <?php foreach (json_decode($sk['memutuskan']) as $key => $value) { ?>
                                                <?php if ($key > 0) { ?>
                                                    <div class="content">
                                                        <div class="row mt-2 mb-4">
                                                            <div class="col-2">
                                                                <p><?= numbering($key); ?> </p>
                                                            </div>
                                                            <div class="col-8">
                                                                <label>Tambahkan Putusan</label>
                                                                <textarea required name="memutuskan[]" rows="2" class="form-control text"><?= $value; ?></textarea>
                                                            </div>
                                                            <?php if ($key == count(json_decode($sk['memutuskan'])) - 1) {
                                                            ?>
                                                                <div class="col-2" id="tempat<?= $key; ?>">
                                                                    <a href="#" class="delete btn btn-danger mt-5" id="delete<?= $key; ?>">Delete</a>
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                            <?php }
                                            } ?>
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
                                                                <textarea name="keterangan_uns" class="form-control" rows="3"><?= $sk['ket_employ']; ?></textarea>
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
                                                                <?php
                                                                $emp = json_decode($sk['lampiran_employ']);
                                                                ?>
                                                                <tbody class="lampiranuns">
                                                                    <?php if ($emp->data != null) { ?>
                                                                        <?php foreach ($emp->data as $key => $value) { ?>
                                                                            <tr>
                                                                                <td><?= $key + 1; ?></td>
                                                                                <td><select class="form-select select pilihUns" required name="lampiran_employ[]" id="pilihUns<?= $key + 1; ?>" width="200px">
                                                                                        <option value="<?= $value->id; ?>" data-pangkatgol="<?= $value->pangkatgol; ?>" data-nik="<?= $value->nik; ?>" selected><?= $value->nama; ?></option>
                                                                                        <?php foreach ($pegawai as $list) { ?>
                                                                                            <option value="<?= $list['id']; ?>" data-pangkatgol="<?= $list['pangkatgol']; ?>" data-nik="<?= $list['nik']; ?>"><?= $list['nama']; ?></option>
                                                                                        <?php } ?>
                                                                                    </select></td>
                                                                                <td><input type="text" id="nik<?= $key + 1; ?>" name="nik[]" value="<?= $value->nik; ?>" class="form-control"></td>
                                                                                <td><input type="text" id="pangkatgol<?= $key + 1; ?>" name="pangkatgol[]" value="<?= $value->nama; ?>" class="form-control"></td>
                                                                                <td id="markerUns<?= $key + 1; ?>"><input type="text" id="ketuns<?= $key + 1; ?>" name="ketuns[]" value="<?= $emp->keterangan[$key]; ?>" class="form-control"></td>
                                                                                <?php if ($key + 1 == count($emp->data)) { ?>
                                                                                    <td id="deleteUns<?= $key + 1; ?>"><a href="#" class="deleteUns"><i class="fas fa-trash"></i> </a></td>
                                                                                <?php } ?>
                                                                            </tr>
                                                                    <?php }
                                                                    } ?>
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
                                                                <textarea name="keterangan_siswa" class="form-control" rows="3"><?= $sk['ket_student']; ?></textarea>
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
                                                                <?php
                                                                $i = 1;
                                                                $stu = json_decode($sk['lampiran_student']); ?>
                                                                <tbody class=lampiransiswa>
                                                                    <?php if ($stu->nama != null) { ?>
                                                                        <?php foreach ($stu->nama as $key => $val) { ?>
                                                                            <tr>
                                                                                <td><?= $i; ?></td>
                                                                                <td><input type="text" required id="nama<?= $i; ?>" value="<?= $val; ?>" name="nama[]" class="form-control"></td>
                                                                                <td><input type="text" required id="nim<?= $i; ?>" value="<?= $stu->nim[$key]; ?>" name="nim[]" class="form-control"></td>
                                                                                <td><input type="text" required id="prodi<?= $i; ?>" value="<?= $stu->prodi[$key]; ?>" name="prodi[]" class="form-control"></td>
                                                                                <td id="marker<?= $i; ?>"><input type="text" id="ketsiswa<?= $i; ?>" value="<?= $stu->keterangan[$key]; ?>" name="ketsiswa[]" class="form-control"></td>
                                                                                <?php if ($i == count($stu->nama)) { ?>
                                                                                    <td id="delete<?= $i; ?>"><a href="#" class="delete"><i class="fas fa-trash"></i> </a></td>
                                                                                <?php }
                                                                                $i++ ?>
                                                                            </tr>
                                                                    <?php }
                                                                    } ?>
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
                                    <!-- button send -->
                                    <div class="row">
                                        <div class="col-6">
                                            <button type="submit" class="btn btn-success">Simpan</button>
                                        </div>
                                        <div class="col-6" align="right">
                                            <a href="/Admin/SK" class="btn btn-secondary">Kembali</a>
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
<?= $this->section('source'); ?>
<?= $this->include('/admin/sk/edit-js'); ?>
<?= $this->endSection(); ?>