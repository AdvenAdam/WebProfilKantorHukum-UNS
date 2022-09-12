<?= $this->extend('user/layout/v_main'); ?>
<?= $this->section('content'); ?>
<!--====== PAGE TITLE PART START ======-->

<div class="page-title-area pb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-title-item text-center">
                    <h4 class="title"> SOP DAN FLOWCHART LEGAL DRAFTING PRODUK HUKUM KANTOR HUKUM UNS</h4>
                </div> <!-- page title -->
            </div>
        </div> <!-- row -->
    </div> <!-- container -->
</div>

<!--====== PAGE TITLE PART ENDS ======-->
<!--====== Dokumen Detail START ======-->

<section class="cart-area mt-100 pb-100">
    <div class="container">
        <center id="flowchart">
            <img src="/image/legaldraft/SopLegal.png" class="img-fluid" alt="Struktur Organisasi" style=" object-fit: cover; object-position: center;">
        </center>
        <div class="cart-table table-responsive pt-100">
            <h3 class="title">Keterangan</h3>
            <table class="table" id="table">
                <thead>
                    <tr>
                        <th width='20%'>Aktivitas</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($aktivitas as $val) { ?>
                        <tr>
                            <td class="product-thumbnail">
                                <a href="#flowchart"><?= $val['aktivitas']; ?></a>
                            </td>
                            <td class="product-name"><a href="#flowchart"><?= $val['isi']; ?></a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<!--====== Dokumen Detail ENDS ======-->
<?= $this->endSection(); ?>