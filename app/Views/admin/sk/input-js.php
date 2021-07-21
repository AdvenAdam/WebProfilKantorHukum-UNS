<script>
    $(document).ready(function() {
        $('.select').select2({});
    });
</script>
<!-- script untuk bagian menimbang -->
<script>
    $(document).ready(function() {
        var wrapper = $(".container1");
        var add_button = $(".add_menimbang");
        var select = $(".select");
        var text = $(".text");
        let x = 1;
        $(add_button).click(function(e) {
            var my_html = '\
            <div class="content">\
            <div class="row mb-4 id="id">\
            <div class="col-10">\
            <label>Tambahkan nama</label>\
            <div class="col-12 mb-4">\
            <select class="form-select select" id="select' + x + '">\
            <option value="">Pilih Nama Pegawai</option>\
            <?php foreach ($pegawai as $list) { ?><option value="<?= $list['nama']; ?>"><?= $list['nama']; ?></option><?php } ?>\
            </select></div>\
            <div class="col-12">\
            <textarea required name="menimbang[]" id="text' + x + '" rows="3" class="form-control text"></textarea>\
            </div></div>\
            <div class="col-2">\
            <a href="#" class="delete btn btn-danger mt-5">Delete</a></div></div></div>\
                    ';
            e.preventDefault();
            scrollDown();
            $(wrapper).append(my_html);
            $('.select').select2();
            autocomplete(x);
            ++x;
        });
        $(wrapper).on("click", '.delete', function(e) {
            e.preventDefault();
            scrollUp();
            $(this).parents('.content').remove();
        })

        function autocomplete(x) {
            $(wrapper).on("change", '#select' + x + '', function(e) {
                e.preventDefault()
                var select = $(this).val();
                $("#text" + x + "").val(function(i, val) {
                    return val += select;
                })
            });
        }

    });
</script>
<!-- script bagian mengingat -->
<script>
    $(document).ready(function() {
        var wrapper = $(".container0");
        var add_button = $(".add_mengingat");
        var pilih = $(".pilih");
        var text = $(".text");
        let y = 1;
        $(add_button).click(function(e) {
            var html_mengingat = '\
            <div class="konten">\
            <div class="row mb-4 id="id">\
            <div class="col-10">\
            <label>Tambahkan Peraturan</label>\
            <div class="col-12 mb-4">\
            <select class="form-select pilih" name="mengingat[]" id="pilih' + y + '">\
            <option value="">Pilih Peraturan</option>\
            <?php foreach ($peraturan as $list) { ?><option value="<?= $list['id']; ?>" data-detail="<?= ($list['detail']); ?>"><?= $list['herarki'] . ' Nomor ' . $list['nomor'] . ' Tahun ' . $list['tahun']; ?></option><?php } ?>\
            </select></div>\
            <div class="col-12">\
            <textarea id="textarea' + y + '" readonly rows="3" class="form-control text"></textarea>\
            </div></div>\
            <div class="col-2">\
            <a href="#" class="delete btn btn-danger mt-5">Delete</a></div></div></div>\
                    ';
            e.preventDefault();
            scrollDown();
            $(wrapper).append(html_mengingat);
            $('.pilih').select2();
            autocomplete(y);
            ++y;
        });
        $(wrapper).on("click", '.delete', function(e) {
            e.preventDefault();
            scrollUp();
            $(this).parents('.konten').remove();
        })

        function autocomplete(y) {
            $(wrapper).on("change", '#pilih' + y + '', function(e) {
                e.preventDefault()
                var pilih = $(this).find(':selected').data('detail');
                $("#textarea" + y + "").val(function(i, val) {
                    return val = (pilih);
                })
            });
        }

    });
</script>
<!-- script memutuskan -->
<script>
    $(document).ready(function() {
        var wrapper = $(".memutuskan");
        var add_button = $(".add_memutuskan");
        var text = $(".text");
        let z = 1;
        $(add_button).click(function(e) {
            var my_html = '\
            <div class="content">\
            <div class="row mt-2 mb-4">\
            <div class="col-2"><p id="urutan' + z + '"> </p></div>\
            <div class="col-8">\
            <label>Tambahkan Putusan</label>\
            <textarea required name="memutuskan[]" id="text' + z + '" rows="2" class="form-control text"></textarea>\
            </div>\
            <div class="col-2" id="tempat' + z + '">\
            <a href="#" class="delete btn btn-danger mt-5" id="delete' + z + '">Delete</a></div></div>\
                    ';
            e.preventDefault();
            scrollDown();
            $(wrapper).append(my_html);
            document.getElementById('urutan' + z + '').innerHTML = urutan(z);
            ++z;
            if (z > 2) {
                hapus(z);
            }
        });
        $(wrapper).on("click", '.delete', function(e) {
            e.preventDefault();
            scrollUp();
            $(this).parents('.content').remove();
            --z;
            if (z > 1) {
                addButton(z);
            }
        })

        function addButton(z) {
            --z;
            var deleteButton = '\
            <a href="#" class="delete btn btn-danger mt-5" id="delete' + z + '">Delete</a>\
            ';
            var div = document.getElementById('tempat' + z + '');
            div.insertAdjacentHTML('beforeend', deleteButton);
        }

        function hapus(z) {
            z = z - 2;
            document.getElementById('delete' + z + '').remove();
        }

        function urutan(z) {
            var urutan = ["", "KESATU", "KEDUA", "KETIGA", "KEEMPAT", "KELIMA", "KEENAM", "KETUJUH", "KEDELAPAN", "KESEMBILAN", "KESEPULUH", "KESEBELAS", "KEDUA BELAS", "KETIGA BELAS", "KEEMPAT BELAS", "KELIMA BELAS"];
            return urutan[z];
        }
    });
</script>
<!-- script lampiran untuk  uns -->
<script>
    $(document).ready(function() {
        var wrapper = $(".lampiranuns");
        var add_button = $(".add_lampiran_uns");
        var text = $(".text");
        let counter = 1;
        $(add_button).click(function(e) {
            var my_html = '\
            <tr>\
            <td>' + counter + '</td>\
            <td><select class="form-select select pilihUns" required name="lampiran_employ[]" id="pilih' + counter + '">\
            <option value="">Pilih Nama Pegawai</option>\
            <?php foreach ($pegawai as $list) { ?><option value = "<?= $list['id']; ?>" data-pangkatgol ="<?= $list['pangkatgol']; ?>" data-nik="<?= $list['nik']; ?>"><?= $list['nama']; ?></option><?php } ?>\
            </select></td>\
            <td><input type="text" id="nik' + counter + '" name="nik[]" class="form-control"></td>\
            <td><input type="text" id="pangkatgol' + counter + '" name="pangkatgol[]" class="form-control"></td>\
            <td id="markerUns' + counter + '"><input type="text" id="ketuns' + counter + '" name="ketuns[]" class="form-control"></td>\
            <td id="deleteUns' + counter + '"><a href="#" class="delete"><i class="fas fa-trash"></i> </a></td>\
            </tr>\
            ';
            e.preventDefault();
            scrollDown();
            $(wrapper).append(my_html);
            $('.select').select2();
            addDataUns(counter);
            ++counter;
            if (counter > 2) {
                hapusUns(counter);
            }
        });
        // delete button 
        $(wrapper).on("click", '.deleteUns', function(e) {
            e.preventDefault();
            $(this).closest('tr').remove();
            --counter;
            if (counter > 1) {
                addButtonUns(counter);
            }
        })

        function addDataUns(counter) {
            $(wrapper).on("change", '#pilihUns' + counter + '', function(e) {
                e.preventDefault()
                var nik = $(this).find(':selected').data('nik');
                var pangkat = $(this).find(':selected').data('pangkatgol');
                $("#nik" + counter + "").val(function(i, val) {
                    return val = (nik);
                })
                $("#pangkatgol" + counter + "").val(function(i, val) {
                    return val = (pangkat);
                })
            });
        }

        function addButtonUns(counter) {
            --counter;
            var deleteButton = '\
            <td id="deleteUns' + counter + '"><a href="#" class="delete"><i class="fas fa-trash"></i> </a></td>\
            ';
            var div = document.getElementById('markerUns' + counter + '');
            div.insertAdjacentHTML('afterend', deleteButton);
        }

        function hapusUns(counter) {
            counter = counter - 2;
            document.getElementById('deleteUns' + counter + '').remove();
        }
    });
</script>
<!-- script lampiran siswa -->
<script>
    $(document).ready(function() {
        var wrapper = $(".lampiransiswa");
        var add_button = $(".add_lampiran_siswa");
        let counter2 = 1;
        $(add_button).click(function(e) {
            var my_html = '\
            <tr>\
            <td>' + counter2 + '</td>\
            <td><input type="text" required id="nama' + counter2 + '" name="nama[]" class="form-control"></td>\
            <td><input type="text" required id="nim' + counter2 + '" name="nim[]" class="form-control"></td>\
            <td><input type="text" required id="prodi' + counter2 + '" name="prodi[]" class="form-control"></td>\
            <td id="marker' + counter2 + '"><input type="text" id="ketsiswa' + counter2 + '" name="ketsiswa[]" class="form-control"></td>\
            <td id="delete' + counter2 + '"><a href="#" class="delete"><i class="fas fa-trash"></i> </a></td>\
            </tr>\
            ';
            e.preventDefault();
            scrollDown();
            $(wrapper).append(my_html);
            $('.select').select2();
            ++counter2;
            if (counter2 > 2) {
                hapus(counter2);
            }
        });
        // delete button 
        $(wrapper).on("click", '.delete', function(e) {
            e.preventDefault();
            $(this).closest('tr').remove();
            --counter2;
            if (counter2 > 1) {
                addButton(counter2);
            }
        })

        function addButton(counter2) {
            --counter2;
            var deleteButton = '\
            <td id="delete' + counter2 + '"><a href="#" class="delete"><i class="fas fa-trash"></i> </a></td>\
            ';
            var div = document.getElementById('marker' + counter2 + '');
            div.insertAdjacentHTML('afterend', deleteButton);
        }

        function hapus(counter2) {
            counter2 = counter2 - 2;
            document.getElementById('delete' + counter2 + '').remove();
        }
    });
</script>
<!-- script copy Penandatangan dan Tentang -->
<script>
    $(document).ready(function() {
        $(function penandatangan() {
            $('#penandatangan').change(function() {
                var tentang = $('#tentang').val();
                var $pangkatgol = $(this).find(':selected').data('pangkatgol');
                var $memutuskan = $('#memutuskan');
                var isi = 'KEPUTUSAN ' + $pangkatgol + ' TENTANG ' + tentang + '';
                onChange(isi);
            });

            $('#tentang').keyup(function() {
                var tentang = $('#tentang').val();
                var $pangkatgol = 'Silahkan Pilih Penandatangan';
                var $memutuskan = $('#memutuskan');
                var isi = 'KEPUTUSAN ' + $pangkatgol + ' TENTANG ' + tentang + '';
                onChange(isi);
                $('#penandatangan').prop('selectedIndex', 0);
            });

            function onChange(isi) {
                $("#memutuskan").val(function(i, val) {
                    return isi.toUpperCase();
                })
            };

        });
    });
</script>
<!-- fungsi scroll horizontall -->
<script>
    function scrollDown() {
        window.scrollBy(0, 185);
    }

    function scrollUp() {
        window.scrollBy(0, -185);
    }
</script>