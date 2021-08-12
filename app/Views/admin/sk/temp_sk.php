<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="/tema/surat/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/tema/surat/assets/css/Times%20New%20Roman.css">
    <link rel="stylesheet" href="/tema/surat/assets/css/styles.css">
    <style>
        @media print {
            @page {
                margin-bottom: 0;
            }

            body {
                margin: 1.6cm;
            }
        }
    </style>
</head>

<body class="text-justify" style="padding: 10px;">

    <!-- oooHEADERooo -->
    <div class="container">
        <!-- header surat -->
        <div class="row">
            <div class="col-sm-3 col-md-2 col-lg-2 col-xl-2 offset-sm-0 offset-lg-0 offset-xl-0" style="padding: 10px 15px;">
                <img src="/tema/surat/assets/img/logo-uns-biru.png" style="width: 120px;height: 120px; object-fit: cover; object-position: center;">
            </div>
            <div class="col-md-9 col-lg-8 col-xl-8" style="padding: 0px 0px;">
                <p class="text-center" style="margin: 2px;padding: 10px 0px; text-transform: uppercase; font-size:16px;"><strong> Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi </strong><br></p>
                <p class="text-center" style="font-size: 14px;text-transform: uppercase;"><strong>UNIVERSITAS SEBELAS MARET</strong><br></p>
                <p class="text-center" style="font-size: 12px;font-family: 'Times New Roman';">Jl.Ir.Sutami 36 A Kentingan Surakarta 57126<br>Telp. 646994, 636895, Fax. 636268&nbsp; Laman :<a href="http://www.uns.ac.id">http://www.uns.ac.id</a><br></p>
            </div>
            <div class="col-md-1 col-lg-2 col-xl-2"></div>
        </div>
    </div>
    <hr style="margin: 10px;height: 0px;">
    <!-- oooISIooo -->
    <div class="container">
        <!-- judul SK -->
        <div class="row">
            <div class="col-md-2 col-lg-2 col-xl-2"></div>
            <div class="col-md-8">
                <p class="text-center" style="font-size: 18px; text-transform: uppercase;">KEPUTUSAN <?= json_decode($sk['penandatangan'])->pangkatgol; ?></p>
            </div>
            <div class="col-md-2 col-lg-2 col-xl-2"></div>
        </div>
        <!-- Tentang -->
        <div class="row">
            <div class="col-md-2 col-xl-2"></div>
            <div class="col-md-8 offset-xl-0">
                <p class="text-center" style="font-size: 18px;">TENTANG</p>
                <p class="text-center" style=" text-transform: uppercase;"><?= $sk['tentang']; ?></p>
                <p class="text-center" style=" text-transform: uppercase;"><?= json_decode($sk['penandatangan'])->pangkatgol; ?></p>
            </div>
            <div class="col-md-2 col-xl-2"></div>
        </div>
        <!-- Menimbang&Mengingat -->
        <div class="row">
            <div class="col">
                <table class="table">
                    <tbody>
                        <?php if (!empty(json_decode($sk['menimbang']))) { ?>
                            <tr>
                                <td style="width: 5%;" rowspan="<?= count(json_decode($sk['menimbang'])) + 1; ?>">Menimbang</td>
                                <td style="width: 1%;" rowspan="<?= count(json_decode($sk['menimbang'])) + 1; ?>">:</td>
                            </tr>
                            <?php $a = 'a'; ?>
                            <?php foreach (json_decode($sk['menimbang']) as $list) { ?>
                                <tr>
                                    <td style="width: 5%;">
                                        <?= $a++; ?><?= '.'; ?>
                                    </td>
                                    <td class="text-justify" style="padding: 12px 50px 12px 10px;"><?= $list; ?></td>
                                </tr>
                        <?php }
                        } ?>
                        <tr colspan="4" class="noBorder">
                            <td></td>
                        </tr>
                        <?php if (!empty(json_decode($sk['mengingat']))) { ?>
                            <tr>
                                <td style="width: 5%;" rowspan="<?= count(json_decode($sk['mengingat'])) + 1; ?>">Mengingat </td>
                                <td style="width: 1%;" rowspan="<?= count(json_decode($sk['mengingat'])) + 1; ?>">:</td>
                            </tr>
                            <?php $b = 1; ?>
                            <?php foreach (json_decode($sk['mengingat']) as $list) { ?>
                                <tr>
                                    <td style="width: 5%;"><?= $b++; ?><?= '.'; ?></td>
                                    <td class="text-justify" style="padding: 12px 50px 12px 10px;"><?= ($list->detail); ?></td>
                                </tr>
                        <?php }
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Memutuskan -->
        <div class="row">
            <div class="col-xl-12">
                <p class="text-center" style="padding: 30px;">MEMUTUSKAN :</p>
            </div>
            <div class="col-xl-12">
                <?php $c = 0; ?>
                <?php function numbering($c)
                {
                    $urutan = ["MENETAPKAN", "KESATU", "KEDUA", "KETIGA", "KEEMPAT", "KELIMA", "KEENAM", "KETUJUH", "KEDELAPAN", "KESEMBILAN", "KESEPULUH", "KESEBELAS", "KEDUA BELAS", "KETIGA BELAS", "KEEMPAT BELAS", "KELIMA BELAS"];
                    return $urutan[$c];
                }
                ?>
                <table class="table">
                    <tbody>
                        <?php foreach (json_decode($sk['memutuskan']) as $list) { ?>
                            <tr>
                                <td style="width: 5%;">
                                    <p><?= numbering($c++); ?></p>
                                </td>
                                <td style="width: 1%;">
                                    <p>:</p>
                                </td>
                                <td class="text-justify" style="padding: 12px 50px 12px 10px; <?= $c == 1 ? 'text-transform:uppercase;' : '' ?>">
                                    <p><?= $list; ?></p>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Ditetapkan -->
        <?php if (!empty($sk['penandatangan'])) { ?>
            <div class="row">
                <div class="col-xl-6"></div>
                <div class="col-xl-6" style="font-family: 'Times New Roman';">
                    <p>
                    <div>Ditetapkan di surakarta <br>pada tanggal ..<br>
                        <br>
                        <?= json_decode($sk['penandatangan'])->pangkatgol; ?>
                    </div>
                    </p>
                    <p style="margin: 70px 0px 0px;">
                    <div><?= json_decode($sk['penandatangan'])->nama; ?><br>NIP. <?= json_decode($sk['penandatangan'])->nik; ?>
                    </div>
                    </p>
                </div>
                <div class="col-xl-12">
                    <p>Selain keputusan ini disampaikan kepada:<br>1.&nbsp;&nbsp;Pejabat terkait di lingkungan Universitas Sebelas Maret;<br>2.&nbsp;&nbsp;Yang bersangkutan untuk diketahui dan dilaksanakan sebaik-baiknya.<br></p>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="container" style="height: 200px;"></div>
    <!-- oooLAMPIRANooo -->
    <?php if ((json_decode($sk['lampiran_employ'])->data != null) && (json_decode($sk['lampiran_student'])->nama != null)) { ?>
        <div class="container">
            <!-- Judul Lampiran -->
            <div class="row">
                <div class="col-xl-4"></div>
                <div class="col" style="padding: 12px 50px;">
                    <p class="text-justify" style="text-transform:uppercase;">LAMPIRAN<br>KEPUTUSAN <?= json_decode($sk['penandatangan'])->pangkatgol; ?> UNIVERSITAS SEBELAS MARET<br></p>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr></tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="width: 5%;">
                                        <p>Nomor</p>
                                    </td>
                                    <td style="width: 1%;">:</td>
                                    <td class="text-left">
                                        <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; /UN27/HK/2021</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 5%;">
                                        <p>Tanggal</p>
                                    </td>
                                    <td style="width: 1%;">:</td>
                                    <td class="text-left">
                                        <p>&nbsp;</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 5%;">
                                        <p>Tentang</p>
                                    </td>
                                    <td style="width: 1%;">:</td>
                                    <td class="text-justify">
                                        <p><?= $sk['tentang']; ?>
                                        <p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- table buat  lampiran pegawai -->
            <?php if (json_decode($sk['lampiran_employ'])->data != null) { ?>
                <div class="row">
                    <div class="col">
                        <p class="text-center keterangan" style="text-transform:uppercase;"><?= $sk['ket_employ']; ?></p>
                        <div class="table-responsive ">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <td style="width: 1%;">No</td>
                                        <td>Nama</td>
                                        <td>NIK/NIP</td>
                                        <td>Pangkat/Golongan</td>
                                        <td>Keterangan</td>
                                    </tr>
                                </thead>
                                <?php $i = 1; ?>
                                <tbody>
                                    <?php
                                    $emp = json_decode($sk['lampiran_employ']);
                                    ?>
                                    <?php foreach ($emp->data as $key => $val) { ?>
                                        <tr>
                                            <td style="width: 1%;"><?= $i++; ?></td>
                                            <td><?= $val->nama; ?></td>
                                            <td><?= $val->nik; ?></td>
                                            <td><?= $val->pangkatgol; ?></td>
                                            <td><?= $emp->keterangan[$key]; ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <!-- table buat  lampiran mahasiswa      -->
            <?php if (json_decode($sk['lampiran_student'])->nama != null) { ?>
                <div class="row">
                    <div class="col">
                        <p class="text-center keterangan" style="text-transform:uppercase;"><?= $sk['ket_student']; ?><br></p>
                        <div class="table-responsive ">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td style="width: 1%;">No</td>
                                        <td>Nama</td>
                                        <td>NIM</td>
                                        <td>Prodi</td>
                                        <td>Keterangan</td>
                                    </tr>
                                    <?php $i = 1;
                                    $stu = json_decode($sk['lampiran_student']);

                                    ?>
                                    <?php foreach ($stu->nama as $key => $val) { ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $val; ?></td>
                                            <td><?= $stu->nim[$key]; ?></td>
                                            <td><?= $stu->prodi[$key]; ?></td>
                                            <td><?= $stu->keterangan[$key]; ?></td>

                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php }
    if ($cetak == true) {
    ?>
        <script>
            window.print();
        </script>
    <?php } ?>
    <script src="/tema/surat/assets/js/jquery.min.js"></script>
    <script src="/tema/surat/assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>