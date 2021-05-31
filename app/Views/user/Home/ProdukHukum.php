<!--====== LATEST NEWS PART START ======-->

<div class="latest-news-area gray-bg pb-10" id="berita">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section-title text-center">
                    <span>Produk Hukum</span>
                    <h4 class="title">Produk Hukum</h4>
                </div> <!-- sction title -->
            </div>
        </div> <!-- row -->
    </div> <!-- container -->
</div>
<section class="cart-area pt-50 pb-140">
    <div class="container">
        <div class="cart-table table-responsive">
            <table class="table" id="example" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Tahun</th>
                        <th>Kategori </th>
                        <th>Berlaku</th>
                        <th>Lihat</th>
                        <th>Download</th>
                    </tr>
                </thead>
                <?php $i = 1; ?>
                <tbody>
                    <?php foreach ($dokumen as $list) { ?>
                        <tr>
                            <td class="product-thumbnail">
                                <?= $i++; ?>
                            </td>
                            <td><?= $list['judul']; ?></td>
                            <td><?= $list['tahun']; ?></td>
                            <td><?= $list['kategori_dokumen']; ?></td>
                            <td><?= $list['created_at'] == '0000-00-00' ? '-' : format_indo($list['created_at']); ?></td>
                            <td>
                                <a href="detailDokumen/<?= $list['id']; ?>" class="btn btn-primary">Lihat</a>
                            </td>
                            <td>
                                <a href="Download/<?= $list['id']; ?>" class="btn btn-success">Download</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</section>


<!--====== LATEST NEWS PART ENDS ======-->