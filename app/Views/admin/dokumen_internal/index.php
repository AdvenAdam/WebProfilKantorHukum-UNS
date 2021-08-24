<?= $this->extend('/admin/layout/main'); ?>
<?= $this->section('content'); ?>
<div class="page-content">
    <div class="main-wrapper">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h3 class="Card-title mb-4">Data Dokumen Internal (Khusus Untuk Kantor Hukum)</h3>
                        <div class="row mb-4">
                            <div class="col-6">
                                <a href="javascript;" data-bs-toggle="modal" data-bs-target="#inputData" class="btn btn-primary">Tambah Data</a>
                            </div>
                        </div>
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
                        <table id="table" class="display table-hover table invoice-table" style=" width:100%">
                            <thead>
                                <tr>
                                    <th>No SK</th>
                                    <th>Status</th>
                                    <th>Tahun</th>
                                    <th>Judul</th>
                                    <th>Unduh</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <?php $i = 1; ?>
                            <tbody>
                                <?php foreach ($dok_intern as $list) { ?>
                                    <tr>
                                        <td><?= $list['no_sk']; ?></td>
                                        <td><?= $list['status'] == '1' ? 'ASLI' : 'SALINAN'; ?></td>
                                        <td><?= $list['tahun']; ?></td>
                                        <td><?= $list['judul']; ?></td>
                                        <td><a href="DokumenInternal/download/<?= $list['id']; ?>" class="btn btn-default btn-sm"><i data-feather="download"></i> </a></td>
                                        <!-- action -->
                                        <td>
                                            <div class="d-inline">
                                                <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#updateData" data-sk='<?= $list['no_sk']; ?>' data-judul='<?= $list['judul'] ?>' data-tahun='<?= $list['tahun']; ?>' data-status='<?= $list['status']; ?>' data-idupdate='DokumenInternal/update/<?= $list['id']; ?>' title="Edit Data"><i data-feather="edit"></i> </a>
                                            </div>
                                            <div class="d-inline">
                                                <a href="DokumenInternal/detail/<?= $list['id']; ?>" title="Lihat"><i data-feather="eye"></i> </a>
                                            </div>
                                            <div class="d-inline">
                                                <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#confirm" data-id='DokumenInternal/delete/<?= $list['id']; ?>' title="Hapus Data"><i data-feather="delete"></i> </a>
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

<?= $this->include('admin/dokumen_internal/modal'); ?>
<?= $this->renderSection('input'); ?>
<?= $this->endSection(); ?>
<?= $this->section('source'); ?>
<script>
    $(document).ready(function() {
        // Untuk sunting
        $('#updateData').on('show.bs.modal', function(event) {
            var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
            var modal = $(this)
            // Isi nilai pada field
            modal.find('#idupdate').attr("action", div.data('idupdate'));
            modal.find('#judul').attr("value", div.data('judul'));
            modal.find('#tahun').attr("value", div.data('tahun'));
            modal.find('#no_sk').attr("value", div.data('sk'));
            modal.find('#status').val(div.data('status'));

        });
    });
</script>
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
<!-- pdf viewer -->
<script>
    // Loaded via <script> tag, create shortcut to access PDF.js exports.
    var pdfjsLib = window['pdfjs-dist/build/pdf'];
    // The workerSrc property shall be specified.

    $("#dok").on("change", function(e) {
        var file = e.target.files[0]
        if (file.type == "application/pdf") {
            var fileReader = new FileReader();
            fileReader.onload = function() {
                var pdfData = new Uint8Array(this.result);
                // Using DocumentInitParameters object to load binary data.
                var loadingTask = pdfjsLib.getDocument({
                    data: pdfData
                });
                loadingTask.promise.then(function(pdf) {
                    console.log('PDF loaded');

                    // Fetch the first page
                    var pageNumber = 1;
                    pdf.getPage(pageNumber).then(function(page) {
                        console.log('Page loaded');

                        var scale = 1.5;
                        var viewport = page.getViewport({
                            scale: scale
                        });

                        // Prepare canvas using PDF page dimensions
                        var canvas = $("#pdfView")[0];
                        var context = canvas.getContext('2d');
                        canvas.height = viewport.height;
                        canvas.width = viewport.width;

                        // Render PDF page into canvas context
                        var renderContext = {
                            canvasContext: context,
                            viewport: viewport
                        };
                        var renderTask = page.render(renderContext);
                        renderTask.promise.then(function() {
                            console.log('Page rendered');
                        });
                    });
                }, function(reason) {
                    // PDF loading error
                    console.error(reason);
                });
            };
            fileReader.readAsArrayBuffer(file);
        }
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