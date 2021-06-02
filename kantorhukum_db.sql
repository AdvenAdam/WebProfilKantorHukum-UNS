/*
Navicat MySQL Data Transfer

Source Server         : konek
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : kantorhukum_db

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2021-06-02 14:55:43
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `migrations`
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('7', '2021-05-24-025457', 'App\\Database\\Migrations\\User', 'default', 'App', '1621845205', '1');
INSERT INTO `migrations` VALUES ('8', '2021-05-24-025856', 'App\\Database\\Migrations\\TblKategoriDokumen', 'default', 'App', '1621845205', '1');
INSERT INTO `migrations` VALUES ('9', '2021-05-24-025876', 'App\\Database\\Migrations\\Dokumen', 'default', 'App', '1621845206', '1');

-- ----------------------------
-- Table structure for `tbl_dokumen`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_dokumen`;
CREATE TABLE `tbl_dokumen` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `judul` text NOT NULL,
  `tahun` varchar(5) NOT NULL,
  `berlaku` date DEFAULT NULL,
  `sampai` date DEFAULT NULL,
  `status` int(5) DEFAULT NULL,
  `id_kategori_dokumen` int(10) DEFAULT NULL,
  `dokumen` varchar(255) DEFAULT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_dokumen_id_kategori_dokumen_foreign` (`id_kategori_dokumen`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_dokumen
-- ----------------------------
INSERT INTO `tbl_dokumen` VALUES ('9', 'wht if flat earth is real ', '2021', '2021-05-24', '0000-00-00', '3', '8', '24-05-2021_wht if flat earth is real .pdf', '2021-05-24', '2021-06-02');
INSERT INTO `tbl_dokumen` VALUES ('10', 'coba3', '2019', '2021-05-23', '2021-05-31', '2', '9', '28-05-2021_coba3.pdf', '2021-05-24', '2021-06-02');
INSERT INTO `tbl_dokumen` VALUES ('11', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex, rerum?', '2019', '2021-05-17', '0000-00-00', '3', '9', '24-05-2021_LoremipsumdolorsitametconsecteturadipisicingelitExrerum.pdf', '2021-05-24', '2021-06-02');
INSERT INTO `tbl_dokumen` VALUES ('12', 'yayayay', '2010', '2021-05-27', '2021-05-28', '2', '10', '27-05-2021_yayayay.pdf', '2021-05-27', '2021-06-02');
INSERT INTO `tbl_dokumen` VALUES ('14', 'zizuz', '2020', '0000-00-00', '0000-00-00', '3', '19', '30-05-2021_zizuz.pdf', '2021-05-30', '2021-05-30');
INSERT INTO `tbl_dokumen` VALUES ('15', 'tatang sutarma', '2020', '0000-00-00', '0000-00-00', '3', '24', '30-05-2021_tatangsutarma.pdf', '2021-05-30', '2021-06-02');
INSERT INTO `tbl_dokumen` VALUES ('16', 'tatang sutarma', '2020', '0000-00-00', '0000-00-00', '3', '23', '31-05-2021_tatangsutarma.pdf', '2021-05-31', '2021-06-02');

-- ----------------------------
-- Table structure for `tbl_informasi`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_informasi`;
CREATE TABLE `tbl_informasi` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `profil` text DEFAULT NULL,
  `tugas_pokok` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tbl_informasi
-- ----------------------------
INSERT INTO `tbl_informasi` VALUES ('1', '<ol><li><strong>Lorem,</strong> ipsum dolor sit amet consectetur adipisicing elit. Accusamus vel, eum esse, corrupti amet at rerum <i>nostrum deleniti voluptate cupiditate nemo ipsa alias optio, quo nulla fugiat? Obcaecati quasi quae culpa modi doloribus veritatis temporibus,</i> neque placeat commodi ratione tenetur inventore</li><li>magnam ab nihil quidem nam sint. Fuga, aliquid animi <i><strong>esse quis delectus pariatur nihil? Cum laboriosam reiciendis quam quidem amet iste possimus soluta iusto optio debitis libero magni excepturi distinctio voluptas at obcaecati dolor neque sit vero rerum officia, esse placeat. Sit neque porro ut modi.</strong></i> Cumque soluta numquam, perferendis, vel explicabo pariatur exercitationem odio ab ducimus voluptas rerum?</li></ul><ol><li>asdasdasda</li><li>sadas</li><li>sad</li><li>da</li></ol>', '<p>TUGAS KANTOR HUKUM</p><ol><li>menyusun program pembentukan produk hukum yang menjadi kewenangan Rektor;</li><li>memberikan bantuan penyusunan produk hukum di lingkungan UNS;</li><li>mempelajari, menelaah peraturan perundang-undangan, keputusan, petunjuk pelaksanaan dan petunjuk teknis yang ditetapkan Rektor;</li><li>melakukan pengharmonisasian, pembulatan dan pemantapan rancangan Produk Hukum yang menjadi kewenangan Rektor;</li><li>menghimpun dan mempelajari peraturan perundang-undangan, kebijaksanaan teknis, pedoman dan petunjuk teknis serta bahan-bahan lainnya yang berhubungan dengan UNS;</li><li>melakukan pengadministrasian dan autentifikasi produk hukum di lingkungan UNS;</li><li>melaksanakan kajian dan/atau analisis hukum untuk menghasilkan produk hukum&nbsp;yang menjadi kewenangan Rektor sesuai dengan ketentuan peraturan perundangan;</li><li>menyelesaikan permasalahan hukum yang dihadapi oleh UNS;</li><li>memberikan saran pertimbangan dan pendampingan hukum kepada ASN di lingkungan UNS atas masalah hukum yang timbul dalam pelaksanaan tugas sesuai dengan peraturan perundang-undangan;</li><li>menyiapkan penyusunan rancangan&nbsp; Peraturan Rektor, Keputusan/Instruksi/Surat Edaran Rektor dan/atau perjanjian kontrak kerjasama;</li><li>melaksanakan tugas tambahan terkait yang diberikan oleh Rektor.</li></ol><p>&nbsp;</p><p>KANTOR HUKUM MENYELENGGARAKAN FUNGSI</p><ol><li>pelaksanaan penyusunan program pembentukan produk hukum yang menjadi kewenangan Rektor;</li><li>pelaksanaan pendampingan dan bantuan penyusunan produk hukum di lingkungan UNS;</li><li>pelaksanaan penelaahan peraturan perundang-undangan, keputusan, petunjuk pelaksanaan dan petunjuk teknis yang ditetapkan Rektor;</li><li>pelaksanaan pengharmonisasian, pembulatan dan pemantapan rancangan Produk Hukum yang menjadi kewenangan Rektor;</li><li>pelaksanaan pengadministrasian dan autentifikasi produk hukum di lingkungan UNS;</li><li>pelaksanaan kajian dan/atau analisis hukum untuk menghasilkan produk hukum&nbsp; yang menjadi kewenangan Rektor sesuai dengan ketentuan peraturan perundangan;</li><li>pelaksanaan penyelesaian permasalahan hukum yang dihadapi oleh UNS;</li><li>pemberian saran pertimbangan dan pendampingan hukum kepada ASN di lingkungan UNS atas masalah hukum yang timbul dalam pelaksanaan tugas sesuai dengan peraturan perundang-undangan;</li><li>penyiapan penyusunan rancangan&nbsp; Peraturan Rektor, Keputusan/Instruksi Rektor dan/atau menyiapkan perjanjian kontrak kerjasama;</li><li>mewakili UNS untuk penyelesaian masalah hukum; dan</li><li>pelaksanaan manajemen risiko di tingkat Kantor Hukum.</li></ol><p>yayayayyayay</p>');

-- ----------------------------
-- Table structure for `tbl_kategori_dokumen`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_kategori_dokumen`;
CREATE TABLE `tbl_kategori_dokumen` (
  `id_kategori_dokumen` int(10) NOT NULL AUTO_INCREMENT,
  `kategori_dokumen` varchar(50) NOT NULL,
  PRIMARY KEY (`id_kategori_dokumen`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_kategori_dokumen
-- ----------------------------
INSERT INTO `tbl_kategori_dokumen` VALUES ('8', 'Peraturan MWA');
INSERT INTO `tbl_kategori_dokumen` VALUES ('9', 'Peraturan Rektor');
INSERT INTO `tbl_kategori_dokumen` VALUES ('10', 'Keputusan Rektor');
INSERT INTO `tbl_kategori_dokumen` VALUES ('23', 'yeyeye2224');
INSERT INTO `tbl_kategori_dokumen` VALUES ('24', 'asdasdyps4');

-- ----------------------------
-- Table structure for `tbl_kontak`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_kontak`;
CREATE TABLE `tbl_kontak` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `pesan` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tbl_kontak
-- ----------------------------
INSERT INTO `tbl_kontak` VALUES ('2', 'Full Name', 'email@email.com', 'suvject', '08595222222', 'yusysuu');
INSERT INTO `tbl_kontak` VALUES ('3', 'sdaasdsa', 'adjvenadam@gmail.com', 'asdasd', 'ssad', 'yusysuu');
INSERT INTO `tbl_kontak` VALUES ('5', null, null, null, null, null);

-- ----------------------------
-- Table structure for `tbl_slider`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_slider`;
CREATE TABLE `tbl_slider` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `judul` varchar(225) DEFAULT '',
  `subjudul` varchar(255) DEFAULT '',
  `keterangan` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tbl_slider
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_strukturorganisasi`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_strukturorganisasi`;
CREATE TABLE `tbl_strukturorganisasi` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `struktur_organisasi` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tbl_strukturorganisasi
-- ----------------------------
INSERT INTO `tbl_strukturorganisasi` VALUES ('1', '1622608116_10da2437cf1102c802a5.png');

-- ----------------------------
-- Table structure for `tbl_user`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(75) NOT NULL,
  `password` varchar(225) NOT NULL,
  `foto` varchar(225) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_user
-- ----------------------------
INSERT INTO `tbl_user` VALUES ('2', 'Cemeti Putra', 'cemetra@gmail.com', '$2y$10$RE8DuvVvANggcO/f1ZuHbuDR8SteD.PRSFhBX0qVeXxWTW0XgysIC', 'default.jpg', '0000-00-00', '0000-00-00');
INSERT INTO `tbl_user` VALUES ('3', 'Baktiadi Saputri', 'baktiatri@gmail.com', '$2y$10$iYZVvCowj5uebkf/C2SsguxYkZuc3zi/M/T1I76KQmNT3/g1Wfk2i', '1622186428_d73e67d8ca34c8385b0e.png', '0000-00-00', '2021-05-28');
INSERT INTO `tbl_user` VALUES ('4', 'akashi', 'adjvenadam@gmail.coms', '$10$RE8DuvVvANggcO/f1ZuHbuDR8SteD.PRSFhBX0qVeXxWTW0XgysIC', '1622089065_b766295fa7bc702b744b.png', '2021-05-26', '2021-05-26');
INSERT INTO `tbl_user` VALUES ('5', 'Adven Adam', 'advenadam48@gmail.com', '$2y$10$eRbri7k.tDnyTn0poBJ/VOwGwkgkMxBobySBeXLcyKr.hQx8QjAVu', '1622100633_e196c4cb7dba975fa2d3.png', '2021-05-27', '2021-05-27');
INSERT INTO `tbl_user` VALUES ('6', 'Paris Hartatis', 'AFIF@student.uns.ac.id', '$2y$10$7XCbkawIaiiYWG3HAnTfPOORSC7lVNnII/YsIIAJ1U6kXCvZSJmz6', 'default.jpg', '2021-05-28', '2021-05-28');
