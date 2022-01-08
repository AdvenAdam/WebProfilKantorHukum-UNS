<?= $this->extend('user/layout/v_main'); ?>
<?= $this->section('content'); ?>
<!--====== LATEST NEWS PART START ======-->

<div class="latest-news-area gray-bg pb-10 mt-150">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section-title text-center">
                    <span>Kantor Hukum Universitas Sebelas Maret</span>
                    <h4 class="title">Template Produk Hukum</h4>
                </div> <!-- sction title -->
            </div>
        </div> <!-- row -->
    </div> <!-- container -->
</div>
<div class="shop-descriptions-area">
    <section class="cart-area pt-50 pb-140">
        <div class="container">
            <?php if (session()->getFlashData('danger')) { ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= session()->getFlashData('danger') ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php } ?>
            <div class="cart-table table-responsive">
                <table class="table" id="example" width="100%">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Judul</th>
                            <th>Download</th>
                        </tr>
                    </thead>
                    <?php $i = 1; ?>
                    <tbody>
                        <?php foreach ($template as $value) { ?>
                            <tr>
                                <td>
                                    <?= $i++ ?>
                                </td>
                                <td><?= strtoupper($value['judul']); ?></td>
                                <td>
                                    <a href="Download/Template/<?= $value['id']; ?>" class="btn btn-success">Unduh</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection(); ?>