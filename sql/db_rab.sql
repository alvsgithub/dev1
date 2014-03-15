DROP TABLE analisa_harga;

CREATE TABLE `analisa_harga` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(11) NOT NULL,
  `nama` varchar(150) DEFAULT NULL,
  `satuan` varchar(25) NOT NULL,
  `id_periode` int(11) NOT NULL,
  `created_by` varchar(11) DEFAULT NULL,
  `modified_by` varchar(11) DEFAULT NULL,
  `created_time` timestamp NULL DEFAULT NULL,
  `modified_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ah_periode` (`id_periode`),
  CONSTRAINT `fk_ah_periode` FOREIGN KEY (`id_periode`) REFERENCES `periode` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

INSERT INTO analisa_harga VALUES("35","M150","Bisa","m<sup>3</sup>","2","","firmantok","","2014-03-13 17:12:55");
INSERT INTO analisa_harga VALUES("38","AN-01","ANalisa Pe","m<sup>3</sup>","2","firmantok","firmantok","2014-03-13 18:03:42","2014-03-13 18:13:07");



DROP TABLE analisa_harga_detail;

CREATE TABLE `analisa_harga_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_analisa` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `volume` decimal(9,3) NOT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `modified_by` varchar(20) DEFAULT NULL,
  `created_time` timestamp NULL DEFAULT NULL,
  `modified_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ahd_ah` (`id_analisa`),
  KEY `fk_ahd_item` (`id_item`),
  CONSTRAINT `fk_ahd_ah` FOREIGN KEY (`id_analisa`) REFERENCES `analisa_harga` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_ahd_item` FOREIGN KEY (`id_item`) REFERENCES `item` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

INSERT INTO analisa_harga_detail VALUES("2","35","3","1.230","firmantok","firmantok","2014-03-13 12:00:14","2014-03-13 14:22:00");
INSERT INTO analisa_harga_detail VALUES("9","38","2","3.000","firmantok","firmantok","2014-03-14 08:15:31","2014-03-14 08:15:31");
INSERT INTO analisa_harga_detail VALUES("10","38","1","12.000","firmantok","firmantok","2014-03-14 08:17:44","2014-03-14 08:17:44");
INSERT INTO analisa_harga_detail VALUES("11","35","1","1.230","firmantok","firmantok","2014-03-14 08:33:27","2014-03-14 08:33:27");
INSERT INTO analisa_harga_detail VALUES("12","38","3","2.450","firmantok","firmantok","2014-03-14 08:38:20","2014-03-14 08:38:20");
INSERT INTO analisa_harga_detail VALUES("13","38","4","1.230","firmantok","firmantok","2014-03-14 08:38:41","2014-03-14 08:38:41");



DROP TABLE articles;

CREATE TABLE `articles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `pubdate` date NOT NULL,
  `body` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

INSERT INTO articles VALUES("2","Indonesia, Terbanyak Keempat Dunia Miliki Spesies Terancam Punah","artikel_1","2014-01-01","<p>Daftar baru ini meniai ulang resiko kepunahan sekitar 71.576 spesies di seluruh dunia. Jumlah ini merupakan jumlah total data keragaman hayati terancam punah yang dimiliki oleh IUCN, namun belum termasuk jumlah spesies yang ditemukan di berbagai belahan dunia baru-baru ini. Dari jumlah tersebut, 21.286 atau sekitar sepertiganya terancam punah.<br /><br />&nbsp;<br /><br />Negara dengan jenis spesies terancam yang paling banyak di dunia adalah Ekuador dengan 2.301 spesies, lalu disusul oleh Amerika Serikat dan Malaysia dengan 1.226 spesies, posisi keempat adalah Indonesia dengan 1.206 spesies dan di tempat kelima adalah Mexico dengan 1.074 spesies terancam.<br /><br />&nbsp;<br /><br />Bagaimana negeri-negeri ini bisa muncul dalam lima besar lokasi yang memiliki satwa terancam punah terbanyak di dunia? Untuk kasus Ekuador, mereka memiliki jumlah spesies terancam paling banyak bukan karena spesies-spesies di sana lebih terancam dibandingkan dengan di tempat lain, namun karena negeri di Amerika Latin ini telah membuat upaya yang luar biasa dalam satu setengah dekade terakhir untuk mengevaluasi keragaman hayati mereka, dan memperlihatkan bahwa banyak spesies yang baru terdata. Misalnya jumlah vegetasi di Ekuador, berdasarkan penilaian pakar-pakar di negeri ini, tak kurang dari 1.843 spesies vegetasi asli Ekuador diketahui dalam resiko kepunahan.<br /><br />&nbsp;<br /><br />Sementara empat negara lain yang masuk dalam catatan lima besar negeri terbanyak memiliki spesies terancam memiliki data yang lebih terbuka. Seperti Amerika Serikat memiliki spesies ikan terancam paling banyak dengan 236 jenis, dan moluska 301 jenis, juga untuk satwa yang tercatat sudah mengalami kepunahan mencapai 257 jenis. Sementara Indonesia memiliki jumlah mamalia terbanyak di dunia yang terancam punah dengan 185 jenis, Brasil memiliki jumlah spesies burung terbanyak yang terancam punah dengan 151 jenis, dan Madagaskar memiliki jumlah reptil terbanyak yang terancam punah dengan 136 jenis.<br /><br />Menurut data terbaru IUCN ini nyaris 200 spesies burung kini berada dalam kategori Kritis (Critically Endangered). Spesies terakhir yang masuk dalam kategori ini adalah burung White-winged Flufftail (Sarothrura ayresi), yaitu sejenis burung kecil yang ada di Ethiopia, Zimbabwe dan Afrika Selatan. Kerusakan habitat, termasuk pengeringan lahan basah, konversi lahan untuk pertanian, kerusakan sumber air menjadi penyebab hilangnya spesies ini.</p>","2014-01-01 21:49:42","2014-01-23 11:35:08");
INSERT INTO articles VALUES("3","Penyu Belimbing Tak Lagi Satwa Terancam Punah","artikel_2","2014-01-01","<p style=\"cursor: default; font-size: medium; line-height: 24px; color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\"><span style=\"color: #000000; font-size: 10pt; font-family: verdana, geneva;\"><em>Leatherback sea turtle</em>&nbsp;atau penyu belimbing, yang merupakan penyu terbesar di dunia, kini tak lagi masuk dalam satwa yang dikategorikan terancam punah (Critically Endangered) dalam Daftar Merah IUCN terbaru. Daftar yang terkini, penyu belimbing kini masuk dalam kategori rentan (Vulnerable). Kendati demikian para ahli konservasi memperingatkan bahwa spesies ini masih belum sepenuhnya aman dan jumlahnya masih terus berkurang.</span></p>
<p style=\"cursor: default; font-size: medium; line-height: 24px; color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\">&nbsp;</p>
<p>&nbsp;</p>
<p style=\"cursor: default; font-size: medium; line-height: 24px; color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\"><span style=\"color: #000000; font-size: 10pt; font-family: verdana, geneva;\">&nbsp;</span></p>
<p style=\"cursor: default; font-size: medium; line-height: 24px; color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\"><span style=\"color: #000000; font-size: 10pt; font-family: verdana, geneva;\">Dalam penelitian terbaru ditemukan bahwa populasi penyu belimbing di barat laut Samudera Atantik (di sepanjang Amerika Serikat dan Karibia) kini mulai mulai bertambah jumlahnya terkait upaya-upaya konservasi yang dilakukan. Sementara itu para pakar masih belum tahu pasti bagaimana populasi penyu belimbing di tenggara Samudera Atlantik (terutama di Gabon) yang masih merupakan populasi terbesar penyu belimbing.</span></p>
<p style=\"cursor: default; font-size: medium; line-height: 24px; color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\"><span style=\"color: #000000; font-size: 10pt; font-family: verdana, geneva;\">&nbsp;</span></p>
<p style=\"cursor: default; font-size: medium; line-height: 24px; color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\"><span style=\"color: #000000; font-size: 10pt; font-family: verdana, geneva;\">Namun, situasi di Samudera Pasifik jauh lebih rentan. Populasi penyu belimbing di bagian timur Samudera Pasifik turun hingga 97 persen dalam tiga generasi penyu belimbing, sementara di sisi barat Samudera Pasifik populasinya menurun hingga 80% di periode yang sama.</span></p>
<p style=\"cursor: default; font-size: medium; line-height: 24px; color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\"><span style=\"color: #000000; font-size: 10pt; font-family: verdana, geneva;\">&nbsp;</span></p>
<p style=\"cursor: default; font-size: medium; line-height: 24px; color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\"><span style=\"color: #000000; font-size: 10pt; font-family: verdana, geneva;\">Salah satunya di Indonesia, yang menjadi habitat penyu belimbing. Populasinya hanya tersisa sedikit saja dari sebelumnya (2.983 sarang pada 1999 dari 13.000 sarang pada tahun 1984). Untuk mengatasi hal tersebut, tiga Negara yaitu Indonesia, PNG dan Kepulauan Solomon telah sepakat untuk melindungi habitat penyu belimbing melalui Mou Tri National Partnership Agreement. Menurut hasil penelitian yang dilakukan oleh WWF-Indonesia, migrasi penyu belimbing yang bertelur di Pantai Utara Papua Barat (Abun) menunjukkan bahwa sebagian satwa langka itu juga bermigrasi ke perairan Kei Kecil untuk mengejar mangsanya (ubur-ubur raksasa).</span></p>
<p style=\"cursor: default; font-size: medium; line-height: 24px; color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\"><span style=\"color: #000000; font-size: 10pt; font-family: verdana, geneva;\">&nbsp;</span></p>
<p style=\"cursor: default; font-size: medium; line-height: 24px; color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\"><span style=\"color: #000000; font-size: 10pt; font-family: verdana, geneva;\">Namun ketika bermigrasi ke Kei Kecil untuk mencari makan, Penyu Belimbing tidak begitu saja bebas dari ancaman. Praktik pembukaan hutan di sekitar kawasan pantai peneluran serta tangkapan sampingan oleh aktivitas perikanan yang sering kali lokasi tangkapnya timpang tindih dengan habitat pakannya adalah sejumlah faktor yang mengancam kepunahan reptil terbesar itu. Beberapa dekade yang lalu perburuan daging penyu untuk upacara adat juga turut menambah deret panjang ancaman terhadap Penyu belimbing. Namun kini, praktik tersebut sudah jauh lebih berkurang.</span></p>
<p style=\"cursor: default; font-size: medium; line-height: 24px; color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\"><span style=\"color: #000000; font-size: 10pt; font-family: verdana, geneva;\">&nbsp;</span></p>
<p style=\"cursor: default; font-size: medium; line-height: 24px; color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\"><span style=\"color: #000000; font-size: 10pt; font-family: verdana, geneva;\">Penyu belimbing atau<em>&nbsp;Dermochelys coriacea</em>&nbsp;adalah satu dari tujuh jenis penyu yang ada di dunia, enam diantaranya bisa dijumpai di Indonesia. Penyu belimbing umumnya mempunyai panjang karapas 1-1,75 meter. Sedangkan panjang total umumnya 1,83-2,2 meter. Berat rata-rata penyu belimbing adalah 250-700 kilogram. Meskipun spesies terbesar yang pernah ditemukan (di pantai barat Wales tahun 1988) mempunyai panjang 3 meter dari kepala sampai ekor, dengan berat 916 kg.</span></p>
<p style=\"cursor: default; font-size: medium; line-height: 24px; color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\"><span style=\"color: #000000; font-size: 10pt; font-family: verdana, geneva;\">&nbsp;</span></p>
<p style=\"cursor: default; font-size: medium; line-height: 24px; color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\"><span style=\"color: #000000; font-size: 10pt; font-family: verdana, geneva;\">Selain ukurannya yang besar, penyu belimbing, sebagaimana jenis penyu lainnya pun sebagai penjelajah lautan yang handal. WWF Indonesia bekerjasama dengan NOAA (National Oceanic and Atmospheric Administration) pada Juli 2003 memasang transmitter di punggung sepuluh ekor penyu belimbing yang dilepas dari pantai Jamursba Medi, Papua. Pada Mei 2005, berdasarkan pengamatan satelit, penyu tersebut diketahui berada di Monteray Bay, sekitar 25 km dari Golden Bridge, San Fransisco, Amerika Serikat.</span></p>
<p style=\"cursor: default; font-size: medium; line-height: 24px; color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\"><span style=\"color: #000000; font-size: 10pt; font-family: verdana, geneva;\">&nbsp;</span></p>
<p style=\"cursor: default; font-size: medium; line-height: 24px; color: #333333; font-family: Arial, Helvetica, sans-serif; text-align: justify;\"><span style=\"color: #000000; font-size: 10pt; font-family: verdana, geneva;\">Sumber :&nbsp;<em>Mongabay Indonesia</em></span></p>","2014-01-01 21:49:57","2014-01-23 11:39:00");
INSERT INTO articles VALUES("4","Pembalakan liar ancaman luar biasa","artikel_3","2014-01-01","<div class=\"itemIntroText\">
<p style=\"text-align: justify;\"><span style=\"color: #000000; font-family: verdana, geneva; font-size: 10pt; line-height: 19px;\">Menteri Kehutanan Zulkifli Hasan menyatakan pembalakan liar merupakan ancaman luar biasa yang bisa mengakibatkan bencana alam dan satwa asli Indonesia punah.</span></p>
<p style=\"text-align: justify;\">&nbsp;</p>
</div>
<div class=\"itemFullText\">
<p>&nbsp;</p>
<p style=\"text-align: justify;\"><br style=\"color: #333333; font-family: Arial, Helvetica, sans-serif; font-size: 14px; line-height: 19px;\" /><span style=\"color: #000000; font-family: verdana, geneva; font-size: 10pt; line-height: 19px;\">\"Apabila hal ini tidak diatasi, longsorn dan banjir mengancam, dan hewan asli Indonesia akan punah,\" kata Zulkifli Hasan saat menghadiri Hari Penanaman Nasional tingkat Sumbar yang dipusatkan di Lawang Park, Kecamatan Matur, Kabupaten Agam, Sumatera Barat, Rabu.</span><br style=\"color: #333333; font-family: Arial, Helvetica, sans-serif; font-size: 14px; line-height: 19px;\" /><br style=\"color: #333333; font-family: Arial, Helvetica, sans-serif; font-size: 14px; line-height: 19px;\" /><span style=\"color: #000000; font-family: verdana, geneva; font-size: 10pt; line-height: 19px;\">Agar ancaman ini tidak terjadi, Kementerian Kehutanan (Kemhut) Republik Indonesia dan DPR-RI sedang membahas Undang-undang tentang pembalakan liar. \"Mudah-mudahan dalam waktu dekat sudah disahkan,\" katanya.</span><br style=\"color: #333333; font-family: Arial, Helvetica, sans-serif; font-size: 14px; line-height: 19px;\" /><br style=\"color: #333333; font-family: Arial, Helvetica, sans-serif; font-size: 14px; line-height: 19px;\" /><span style=\"color: #000000; font-family: verdana, geneva; font-size: 10pt; line-height: 19px;\">Kemhut juga mencanangkan penanaman pohon satu miliar di seluruh Indonesia. Pada 2010 sebanyak 1,3 juta pohon ditanam, pada 2011 sebanyak 1,5 miliar pohon, pada 2012 sebanyak 1,6 miliar pohon, pada 2013 diperkirakan sebanyak 1,8 miliar.</span><br style=\"color: #333333; font-family: Arial, Helvetica, sans-serif; font-size: 14px; line-height: 19px;\" /><br style=\"color: #333333; font-family: Arial, Helvetica, sans-serif; font-size: 14px; line-height: 19px;\" /><span style=\"color: #000000; font-family: verdana, geneva; font-size: 10pt; line-height: 19px;\">Pada tahun depan, imbuhnya, penanaman pohon akan tembus 2 miliar pohon. \"Saya optimis ini tercapai, sehingga berdampak positif untuk ketahanan ekosistem, penyimpanan air dan lainnya.\"&nbsp;</span><br style=\"color: #333333; font-family: Arial, Helvetica, sans-serif; font-size: 14px; line-height: 19px;\" /><br style=\"color: #333333; font-family: Arial, Helvetica, sans-serif; font-size: 14px; line-height: 19px;\" /><span style=\"color: #000000; font-family: verdana, geneva; font-size: 10pt; line-height: 19px;\">Zulkifli Hasan menghimbau kepada masyarakat agar menjaga hutan dengan lebih baik demi masa depan.</span><br style=\"color: #333333; font-family: Arial, Helvetica, sans-serif; font-size: 14px; line-height: 19px;\" /><br style=\"color: #333333; font-family: Arial, Helvetica, sans-serif; font-size: 14px; line-height: 19px;\" /><span style=\"color: #000000; font-family: verdana, geneva; font-size: 10pt; line-height: 19px;\">Sementara itu, Gubernur Sumbar Irwan Prayitno menambahkan, Pemprov Sumbar sangat serius menjalankan program menanam pohon dengan melibatkan masyarakat, TNI, polri dan lainnya.</span><br style=\"color: #333333; font-family: Arial, Helvetica, sans-serif; font-size: 14px; line-height: 19px;\" /><br style=\"color: #333333; font-family: Arial, Helvetica, sans-serif; font-size: 14px; line-height: 19px;\" /><span style=\"color: #000000; font-family: verdana, geneva; font-size: 10pt; line-height: 19px;\">\"Program ini kami lakukan dengan tujuan hutan menjadi baik dan terhindar dari bencana alam,\" katanya.&nbsp;</span></p>
<p style=\"text-align: justify;\"><span style=\"color: #000000; font-family: verdana, geneva; font-size: 10pt; line-height: 19px;\">&nbsp;</span></p>
<p style=\"text-align: justify;\"><span style=\"color: #000000; font-family: verdana, geneva; font-size: 10pt; line-height: 19px;\">Sumber : AntaraNews.com</span></p>
</div>","2014-01-01 22:00:09","2014-01-23 11:49:44");
INSERT INTO articles VALUES("5","Lagi, BBKSDA Jatim Gagalkan Trenggiling","artikel_4","2014-01-01","<div style=\"text-align: justify;\"><span style=\"color: #000000; font-size: 10pt; font-family: verdana, geneva;\">Jajaran Kepolisian Sektor Genteng Banyuwangi, Jawa Timur, bersama tim Balai Konservasi Sumber Daya Alam atau Bidang KSDA Wilayah III Jember, Jawa Timur, Senin (2/12), menggagalkan penyelundupan daging trenggiling beserta organnya dan ular sanca.</span></div>
<div class=\"itemFullText\">&nbsp;</div>
<div style=\"text-align: justify;\">&nbsp;</div>
<div style=\"text-align: justify;\"><span style=\"color: #000000; font-size: 10pt; font-family: verdana, geneva;\">Petugas gabungan menggerebek rumah milik Masbudi di Dusun Gedangan, Desa Genteng Wetan, Kecamatan Genteng - Banyuwangi. Berdasarkan laporan warga, rumah tersebut dijadikan tempat penampungan beberapa satwa langka yang dilindungi yang akan diperjualbelikan. Dari penggerebakan ditemukan beberapa ekor Trenggiling yang sudah beku dalam mesin pendingin, sisik Trenggiling basah maupun kering, serta seekor ular Sanca Kembang.</span></div>
<div style=\"text-align: justify;\">&nbsp;</div>
<div style=\"text-align: justify;\"><span style=\"color: #000000; font-size: 10pt; font-family: verdana, geneva;\">Menurut Dheny Mardiono, PPNS BBKSDA Jatim, diduga daging Trenggiling tersebut akan diekspor ke luar negeri, sedangkan sisiknya biasanya akan dibuat sebagai bahan baku kosmetik atau salah satu bahan pembuatan sabu-sabu. Petugas juga menemukan alat hisap sabu yang disimpan di dalam lemari di kamar pelaku. Dalam hal ini, petugas gagal menangkap pelaku yang telah dulu kabur sebelum petugas datang.&nbsp;</span></div>
<div style=\"text-align: justify;\">&nbsp;</div>
<div style=\"text-align: justify;\"><span style=\"color: #000000; font-size: 10pt; font-family: verdana, geneva;\">Agus Irwanto</span></div>
<div style=\"text-align: justify;\"><span style=\"color: #000000; font-size: 10pt; font-family: verdana, geneva;\">Sumber : Metrotvnews</span></div>","2014-01-01 22:00:23","2014-01-23 11:50:27");
INSERT INTO articles VALUES("6","Sertijab Eselon IV","artikel_5","2014-01-01","<div style=\"text-align: justify;\"><span style=\"color: #000000; font-size: 10pt; font-family: verdana, geneva;\">Kepala Balai Besar KSDA Jatim, Ir. Suyatno Sukandar, M.Sc, memimpin acara serah terima jabatan eselon IV. Acara tersebut dilaksanakan di Kantor Balai Besar pada 7 Januari 2014 dengan dihadiri pejabat eselon III dan IV, antara lain Kabag TU Dra. Yani Turniati, Kabidtek Ir. Hartojo, Kabidwil I Madiun Unang Suwarman, B.Sc.F, serta Kepala SKW V dan VI.</span></div>
<div style=\"text-align: justify;\">&nbsp;</div>
<div style=\"text-align: justify;\">&nbsp;</div>
<div style=\"text-align: justify;\"><span style=\"color: #000000; font-size: 10pt; font-family: verdana, geneva;\">Adapun pejabat yang melakukan serah terima yakni Ir. Kuncoro, yang sebelumnya menjabat sebagai Kepala Seksi Konservasi Wilayah I Kediri, menjadi Kepala Seksi Pemanfaatan dan Pelayanan. Juga, Hady Suyitno, SE., MP yang sebelumnya sebagai Kepala Seksi PTN III Balai Besar Taman Nasional Bromo Tengger Semeru, saat ini menjabat Kepala Seksi Konwil I di Kediri.</span></div>
<div style=\"text-align: justify;\">&nbsp;</div>
<div style=\"text-align: justify;\"><span style=\"color: #000000; font-size: 10pt; font-family: verdana, geneva;\">Dalam arahannya, Kepala Balai Besar menekankan untuk bekerja dengan semangat sehingga hasil yang didapatkan lebih baik dari yang sebelumnya. Selanjutnya, diharapkan tidak cepat puas dengan hasil yang di dapat, serta yang utama adalah memahami terlebih dahulu tugas yang akan dikerjakan.&nbsp;</span></div>
<div style=\"text-align: justify;\">&nbsp;</div>
<div style=\"text-align: justify;\"><span style=\"color: #000000; font-size: 10pt; font-family: verdana, geneva;\">Di akhir arahannya, Kababes menginginkan BBKSDA Jatim dapat menjadi tower PHKA untuk di wilayah timur Indonesia. Khusus pejabat yang baru serh terima, beliau mengucapkan selamat bergabung dan bertugas di tempat yang baru. (Agus Irwanto)</span></div>
<div style=\"text-align: justify;\">&nbsp;</div>
<div style=\"text-align: justify;\"><span style=\"color: #000000; font-size: 10pt; font-family: verdana, geneva;\"><img title=\"Sertijab Eselon IV \" src=\"http://bbksdajatim.org/images/2014/DSCN0247A.jpg\" alt=\"tes\" width=\"540\" height=\"355\" /></span></div>","2014-01-01 22:00:47","2014-01-23 11:53:33");
INSERT INTO articles VALUES("7","artikel baru","tes-artikel","2014-02-18","<p>asfsadf</p>","2014-02-18 12:06:34","2014-02-18 12:06:34");



DROP TABLE ci_sessions;

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO ci_sessions VALUES("6d3f1e90618b390023ec45c850893b38","::1","Mozilla/5.0 (Windows NT 6.1; WOW64; rv:27.0) Gecko/20100101 Firefox/27.0","1394762796","");
INSERT INTO ci_sessions VALUES("10dd5fc9e3f0f87878c2662553f34bdf","::1","Mozilla/5.0 (Windows NT 6.1; WOW64; rv:27.0) Gecko/20100101 Firefox/27.0","1394776304","");
INSERT INTO ci_sessions VALUES("969968035928cb589203f2f4ec81e0e8","::1","Mozilla/5.0 (Windows NT 6.1; WOW64; rv:27.0) Gecko/20100101 Firefox/27.0","1394776305","");



DROP TABLE item;

CREATE TABLE `item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(11) NOT NULL,
  `id_periode` int(11) DEFAULT NULL,
  `nama` varchar(150) NOT NULL,
  `jenis` varchar(50) NOT NULL,
  `satuan` varchar(15) NOT NULL,
  `harga_pagu` decimal(17,2) DEFAULT NULL,
  `harga_oe` decimal(17,2) NOT NULL DEFAULT '0.00',
  `created_by` varchar(25) DEFAULT NULL,
  `modified_by` varchar(25) DEFAULT NULL,
  `created_time` timestamp NULL DEFAULT NULL,
  `modified_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_periode_item` (`id_periode`),
  CONSTRAINT `fk_periode_item` FOREIGN KEY (`id_periode`) REFERENCES `periode` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO item VALUES("1","L01","2","Mandor","upah","Org/Hari","1355.00","1050000.00","firmantok","firmantok","0000-00-00 00:00:00","2014-03-14 08:33:27");
INSERT INTO item VALUES("2","E01","2","Sewa Mesin Bor","alat","hari","9000.00","5550.00","firmantok","firmantok","2014-03-10 00:00:00","2014-03-14 08:15:31");
INSERT INTO item VALUES("3","M001","2","Pasir Urug","satuan","M3","1350000.00","1350000.00","firmantok","firmantok","2014-03-10 00:00:00","2014-03-14 08:38:20");
INSERT INTO item VALUES("4","LS001","2","Pekerjaan Uit Set","lumpsum","ls","2000.00","0.00","firmantok","firmantok","2014-03-10 00:00:00","2014-03-14 08:38:41");
INSERT INTO item VALUES("5","L09","3","Tes","upah","M<sup>2</sup>","1000.00","1000.00","firmantok","firmantok","2014-03-11 00:00:00","2014-03-11 21:35:39");



DROP TABLE kabupaten_kota;

CREATE TABLE `kabupaten_kota` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(150) NOT NULL,
  `jenis` varchar(45) DEFAULT NULL,
  `id_provinsi` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nama_UNIQUE` (`nama`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_kk_prov_idx` (`id_provinsi`),
  CONSTRAINT `fk_kk_prov` FOREIGN KEY (`id_provinsi`) REFERENCES `provinsi` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

INSERT INTO kabupaten_kota VALUES("1","Surabaya","Kota","1");
INSERT INTO kabupaten_kota VALUES("5","Malang","Kota","1");
INSERT INTO kabupaten_kota VALUES("6","Kabupaten Bangkalan","Kabupaten","1");
INSERT INTO kabupaten_kota VALUES("7","Kabupaten Banyuwangi","Kabupaten","1");
INSERT INTO kabupaten_kota VALUES("8","Kabupaten Blitar","Kabupaten","1");
INSERT INTO kabupaten_kota VALUES("9","Kabupaten Bojonegoro","Kabupaten","1");
INSERT INTO kabupaten_kota VALUES("10","Kabupaten Bondowoso","Kabupaten","1");
INSERT INTO kabupaten_kota VALUES("11","Kabupaten Gresik","Kabupaten","1");
INSERT INTO kabupaten_kota VALUES("12","Kabupaten Jember","Kabupaten","1");
INSERT INTO kabupaten_kota VALUES("13","Kabupaten Jombang","Kabupaten","1");
INSERT INTO kabupaten_kota VALUES("14","Kabupaten Kediri","Kabupaten","1");
INSERT INTO kabupaten_kota VALUES("15","Kabupaten Lamongan","Kabupaten","1");
INSERT INTO kabupaten_kota VALUES("16","Kabupaten Lumajang","Kabupaten","1");
INSERT INTO kabupaten_kota VALUES("17","Kabupaten Madiun","Kabupaten","1");
INSERT INTO kabupaten_kota VALUES("18","Kabupaten Magetan","Kabupaten","1");
INSERT INTO kabupaten_kota VALUES("19","Kabupaten Malang","Kabupaten","1");
INSERT INTO kabupaten_kota VALUES("20","Kabupaten Mojokerto","Kabupaten","1");
INSERT INTO kabupaten_kota VALUES("21","Kabupaten Nganjuk","Kabupaten","1");
INSERT INTO kabupaten_kota VALUES("22","Kabupaten Ngawi","Kabupaten","1");
INSERT INTO kabupaten_kota VALUES("23","Kabupaten Pacitan","Kabupaten","1");
INSERT INTO kabupaten_kota VALUES("24","Kabupaten Pamekasan","Kabupaten","1");
INSERT INTO kabupaten_kota VALUES("25","Kabupaten Pasuruan","Kabupaten","1");
INSERT INTO kabupaten_kota VALUES("26","Kabupaten Ponorogo","Kabupaten","1");
INSERT INTO kabupaten_kota VALUES("27","Kabupaten Probolinggo","Kabupaten","1");
INSERT INTO kabupaten_kota VALUES("28","Kabupaten Sampang","Kabupaten","1");
INSERT INTO kabupaten_kota VALUES("29","Kabupaten Sidoarjo","Kabupaten","1");
INSERT INTO kabupaten_kota VALUES("30","Kabupaten Situbondo","Kabupaten","1");
INSERT INTO kabupaten_kota VALUES("31","Kabupaten Sumenep","Kabupaten","1");
INSERT INTO kabupaten_kota VALUES("32","Kabupaten Trenggalek","Kabupaten","1");
INSERT INTO kabupaten_kota VALUES("33","Kabupaten Tuban","Kabupaten","1");
INSERT INTO kabupaten_kota VALUES("34","Kabupaten Tulungagung","Kabupaten","1");
INSERT INTO kabupaten_kota VALUES("35","Batu","Kota","1");
INSERT INTO kabupaten_kota VALUES("36","Blitar","Kota","1");
INSERT INTO kabupaten_kota VALUES("37","Kediri","Kota","1");
INSERT INTO kabupaten_kota VALUES("38","Madiun","Kota","1");
INSERT INTO kabupaten_kota VALUES("39","Mojokerto","Kota","1");
INSERT INTO kabupaten_kota VALUES("40","Pasuruan","Kota","1");
INSERT INTO kabupaten_kota VALUES("41","Probolinggo","Kota","1");
INSERT INTO kabupaten_kota VALUES("42","Bekasi","KOTA","2");



DROP TABLE menu;

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `nama_menu` varchar(45) DEFAULT NULL,
  `link` varchar(45) DEFAULT NULL,
  `level` smallint(6) DEFAULT NULL,
  `id_parent` int(11) NOT NULL DEFAULT '0',
  `icon` varchar(45) DEFAULT NULL,
  `menu_allowed` varchar(45) DEFAULT NULL,
  `slug_left` varchar(45) DEFAULT NULL,
  `slug_top` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_menu`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8;

INSERT INTO menu VALUES("5","Users","app/user","2","7","","+1+2+3+","app/user","app/user");
INSERT INTO menu VALUES("7","Master","","1","0","","+1+2+3+","","");
INSERT INTO menu VALUES("20","Group","app/group","2","7","","+1+2+3+","app/group","app/group");
INSERT INTO menu VALUES("21","Menu Privilege","app/group/access","2","7","","+1+2+3+","app/group/access","app/group/access");
INSERT INTO menu VALUES("35","Periode","app/periode","2","7","","+1+2+3+","app/periode","app/periode");
INSERT INTO menu VALUES("39","Data Anggaran","","1","0","","+1+2+3+","","");
INSERT INTO menu VALUES("40","Upah","app/anggaran/index/upah","2","39","","+1+2+3+","app/anggaran/upah","app/anggaran/upah");
INSERT INTO menu VALUES("41","Alat","app/anggaran/index/alat","2","39","","+1+2+3+","app/anggaran/alat","app/anggaran/alat");
INSERT INTO menu VALUES("42","Satuan","app/anggaran/index/satuan","2","39","","+1+2+3+","app/anggaran/satuan","app/anggaran/satuan");
INSERT INTO menu VALUES("44","Lumpsum","app/anggaran/index/lumpsum","2","39","","+1+2+3+","app/anggaran/lumpsum","app/anggaran/lumpsum");
INSERT INTO menu VALUES("47","Data Aktual","","1","0","","+1+2+3+","","");
INSERT INTO menu VALUES("48","Upah","app/aktual/index/upah","2","47","","+1+2+3+","app/aktual/upah","app/aktual/upah");
INSERT INTO menu VALUES("49","Alat","app/aktual/index/alat","2","47","","+1+2+3+","app/aktual/alat","app/aktual/alat");
INSERT INTO menu VALUES("50","Satuan","app/aktual/index/satuan","2","47","","+1+2+3+","app/aktual/satuan","app/aktual/satuan");
INSERT INTO menu VALUES("52","Lumpsum","app/aktual/lumpsum","2","47","","+1+2+3+","app/aktual/lumpsum","app/aktual/lumpsum");
INSERT INTO menu VALUES("55","Analisa Harga","","1","0","","+1+2+3+","","");
INSERT INTO menu VALUES("58","Anggaran","app/analisa_harga/anggaran","2","55","","+1+2+3+","","");
INSERT INTO menu VALUES("60","Aktual","app/analisa_harga/aktual","2","55","","+1+2+3+","","");



DROP TABLE migrations;

CREATE TABLE `migrations` (
  `version` int(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO migrations VALUES("6");



DROP TABLE pages;

CREATE TABLE `pages` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `order` int(11) NOT NULL,
  `body` longtext NOT NULL,
  `parent_id` int(11) unsigned NOT NULL DEFAULT '0',
  `template` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

INSERT INTO pages VALUES("1","Home","","1","<p>Test home page</p>","0","homepage");
INSERT INTO pages VALUES("5","News archive","News-archive","13","<p>tes page New archive</p>","0","news_archive");
INSERT INTO pages VALUES("8","Tentang Kami","tentang-kami","3","<p>this tentang-kami page</p>","0","page");
INSERT INTO pages VALUES("9","Sejarah Balai","Sejarah-Balai","5","<div class=\"newsitem_text\">
<p>Balai Besar KSDA Jawa Timur merupakan salah satu dari 8 (delapan) Balai Besar KSDA di Indonesia yang dibentuk berdasarkan pengembangan dan penyempurnaan organisasi dan tata kerja sebelumnya yang sudah tidak sesuai dengan perkembangan upaya konservasi sumber daya alam hayati dan ekosistemnya.</p>
<p>Pembentukan Balai Besar Konservasi Sumber Daya Alam Jawa Timur diatur berdasarkan Peraturan Menteri Kehutanan No. P.02/Menhut-II/2007 tanggal 1 Pebruari 2007 tentang Organisasi dan Tata Kerja Unit Pelaksana Teknis Konservasi Sumber Daya Alam.</p>
<p>Wilayah kerja Balai Besar Konservasi Sumber Daya Alam Jawa Timur merupakan penggabungan antara wilayah Balai KSDA Jawa Timur I dengan wilayah kerja Balai KSDA Jawa Timur II</p>
</div>","8","page");
INSERT INTO pages VALUES("10","Tugas Pokok dan Fungsi","Tugas-Pokok-dan-Fungsi","6","<p style=\"text-align: justify;\">Balai Besar KSDA Jawa Timur mempunyai tugas penyelenggaraan konservasi sumber daya alam hayati dan ekosistemnya dan pengelolaan kawasan cagar alam, suaka margasatwa, taman wisata alam dan taman buru, koordinasi teknis pengelolaan taman hutan raya dan hutan lindung serta konservasi tumbuhan dan satwa liar di luar kawasan konservasi berdasarkan peraturan perundang-undangan yang berlaku.</p>
<p style=\"text-align: justify;\">Dalam menyelenggarakan tugas tersebut Balai Besar KSDA Jawa Timur menyelenggarakan fungsi :</p>
<ol style=\"list-style-type: lower-alpha;\">
<li style=\"text-align: justify;\">penataan blok, penyusunan rencana kegiatan, pemantauan dan evaluasi pengelolaan kawasan cagar alam, suaka margasatwa, taman wisata alam, dan taman buru, serta konservasi tumbuhan dan satwa liar di dalam dan di luar kawasan konservasi;</li>
<li style=\"text-align: justify;\">pengelolaan kawasan cagar alam, suaka margasatwa, taman wisata alam, dan taman buru, serta konservasi tumbuhan dan satwa liar di dalam dan di luar kawasan konservasi;</li>
<li style=\"text-align: justify;\">koordinasi teknis pengelolaan taman hutan raya dan hutan lindung;</li>
<li style=\"text-align: justify;\">penyidikan, perlindungan dan pengamanan hutan, hasil hutan dan tumbuhan dan satwa liar di dalam dan di luar kawasan konservasi;</li>
<li style=\"text-align: justify;\">pengendalian kebakaran hutan;</li>
<li style=\"text-align: justify;\">promosi, informasi konservasi sumberdaya alam hayati dan ekosistemnya;</li>
<li style=\"text-align: justify;\">pengembangan bina cinta alam serta penyuluhan konservasi sumberdaya alam hayati dan ekosistemnya;</li>
<li style=\"text-align: justify;\">kerja sama pengembangan konservasi sumberdaya alam hayati dan ekosistemnya serta pengembangan kemitraan;</li>
<li style=\"text-align: justify;\">pemberdayaan masyarakat sekitar kawasan konservasi;</li>
<li style=\"text-align: justify;\">pengembangan dan pemanfaatan jasa lingkungan dan pariwisata alam;</li>
<li style=\"text-align: justify;\">pelaksanaan urusan tata usaha dan rumah tangga</li>
</ol>","8","page");
INSERT INTO pages VALUES("11","Visi dan Misi","Visi-dan-Misi","7","<div class=\"newsitem_text\">
<p><strong>Visi : </strong></p>
<p><strong>\"Terwujudnya Penyelenggaraan Konservasi Sumberdaya Alam Hayati dan Ekosistemnya Untuk Menjamin Kelestarian Sistem Penyangga Kehidupan, Keanekaragaman Hayati dan Kesejahteraan Masyarakat\"</strong></p>
<p><strong>&nbsp;</strong></p>
<p><strong>Misi :</strong></p>
<ol>
<li><strong>Mewujudkan pemantapan pengelolaan konservasi sumberdaya alam hayati dan ekosistemnya</strong></li>
<li><strong>Mewujudkan pemantapan perlindungan hutan dan penegakan hukum</strong></li>
<li><strong>Mewujudkan pengembangan secara optimal pemanfaatan sumberdaya alam hayati dan ekosistemnya berdasarkan prinsip kelestarian</strong></li>
<li><strong>Mewujudkan peran serta masyarakat dalam KSDA &amp; E</strong></li>
<li><strong>Mewujudkan pengembangan kelembagaan dan kemitraan dalam rangka pengelolaan, perlindungan dan pemanfaatan sumber daya alam hayati dan ekosistemnya.</strong></li>
<li><strong>Mewujudkan dukungan penanggulangan kemiskinan, pengurangan kesenjangan, perbaikan iklim ketenagakerjaan, dan memacu kewirausahaan.</strong></li>
</ol></div>","8","page");
INSERT INTO pages VALUES("12","Stuktur Organisasi","Stuktur-Organisasi","4","<p>Struktur Organisasi dan Tata Kerja Balai Besar Konservasi Sumber Daya Alam telah ditetapkan oleh Menteri Kehutanan pada tanggal 1 Pebruari 2007 dengan dikeluarkannya Peraturan Menteri Kehutanan nomor P.02/Menhut-II/2007. BBKSDA Jawa Timur berdasarkan Peraturan Menteri Kehutanan tersebut termasuk ke dalam tipologi A.</p>
<p><img title=\"Struktur Organisasi\" src=\"http://bbksdajatim.org/images/struktur.png\" alt=\"sturktur-organisasi\" width=\"523\" height=\"602\" /></p>","8","page");
INSERT INTO pages VALUES("13","Kawasan Korservasi","Kawasan-Korservasi","10","<p>Kawasan Korservasi</p>","0","page");
INSERT INTO pages VALUES("14","Izin Pengambilan dan Penangkapan TSL","Izin-Pengambilan-dan-Penangkapan-TSL","9","<table style=\"margin-left: 5.4pt; border-collapse: collapse; width: 605px;\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\">
<tbody>
<tr style=\"height: 17.8pt;\">
<td style=\"width: 85.05pt; border: 1pt solid windowtext; padding: 0in 5.4pt; height: 17.8pt;\" rowspan=\"4\" valign=\"top\" width=\"113\">
<p style=\"margin-top: 6pt; text-align: center;\" align=\"center\">&nbsp;</p>
<p style=\"margin-top: 3pt; text-align: center;\" align=\"center\"><strong><span style=\"font-size: 11pt; font-family: \'Tahoma\',\'sans-serif\';\">BBKSDA JAWA TIMUR</span></strong></p>
</td>
<td style=\"width: 177.2pt; border-width: 1pt 1pt 1pt medium; border-style: solid solid solid none; border-color: windowtext windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 17.8pt;\" rowspan=\"2\" width=\"236\">
<p style=\"text-align: center;\" align=\"center\"><strong><span style=\"font-size: 14pt; font-family: \'Tahoma\',\'sans-serif\'; color: green;\">SOP</span></strong></p>
</td>
<td style=\"width: 63.8pt; border-width: 1pt medium; border-style: solid none; border-color: windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 17.8pt;\" width=\"85\">
<p><span style=\"font-size: 10pt; font-family: \'Tahoma\',\'sans-serif\';\">Kode Dok</span></p>
</td>
<td style=\"width: 14.2pt; border-width: 1pt medium; border-style: solid none; border-color: windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 17.8pt;\" width=\"19\">
<p style=\"margin-left: -0.15pt; text-align: center; text-indent: 0.15pt;\" align=\"center\"><span style=\"font-size: 10pt; font-family: \'Tahoma\',\'sans-serif\';\">:</span></p>
</td>
<td style=\"width: 113.35pt; border-width: 1pt 1pt 1pt medium; border-style: solid solid solid none; border-color: windowtext windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 17.8pt;\" width=\"151\">
<p><span style=\"font-size: 10pt; font-family: \'Tahoma\',\'sans-serif\';\">SOP-SP2.01.01</span></p>
</td>
</tr>
<tr style=\"height: 21.8pt;\">
<td style=\"width: 63.8pt; border-width: medium medium 1pt; border-style: none none solid; border-color: -moz-use-text-color -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 21.8pt;\" width=\"85\">
<p><span style=\"font-size: 10pt; font-family: \'Tahoma\',\'sans-serif\';\">Terbit/Tgl</span></p>
</td>
<td style=\"width: 14.2pt; border-width: medium medium 1pt; border-style: none none solid; border-color: -moz-use-text-color -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 21.8pt;\" width=\"19\">
<p style=\"margin-left: -0.15pt; text-align: center; text-indent: 0.15pt;\" align=\"center\"><span style=\"font-size: 10pt; font-family: \'Tahoma\',\'sans-serif\';\">:</span></p>
</td>
<td style=\"width: 113.35pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 21.8pt;\" width=\"151\">
<p><span style=\"font-size: 10pt; font-family: \'Tahoma\',\'sans-serif\';\">01/</span><span style=\"font-size: 10pt; font-family: \'Tahoma\',\'sans-serif\';\"> 09-09-</span><span style=\"font-size: 10pt; font-family: \'Tahoma\',\'sans-serif\';\">2009</span></p>
</td>
</tr>
<tr style=\"height: 22.6pt;\">
<td style=\"width: 177.2pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 22.6pt;\" rowspan=\"2\" width=\"236\">
<p style=\"text-align: center;\" align=\"center\"><strong><span style=\"font-size: 11pt; font-family: \'Tahoma\',\'sans-serif\';\">PEMBERIAN IZIN </span></strong><strong><span style=\"font-size: 11pt; font-family: \'Tahoma\',\'sans-serif\';\">PENGAMBILAN DAN PENANGKAPAN TUMBUHAN DAN SATWA LIAR</span></strong></p>
</td>
<td style=\"width: 63.8pt; border-width: medium medium 1pt; border-style: none none solid; border-color: -moz-use-text-color -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 22.6pt;\" width=\"85\">
<p><span style=\"font-size: 10pt; font-family: \'Tahoma\',\'sans-serif\';\">Revisi/Tgl</span></p>
</td>
<td style=\"width: 14.2pt; border-width: medium medium 1pt; border-style: none none solid; border-color: -moz-use-text-color -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 22.6pt;\" width=\"19\">
<p style=\"margin-left: -0.15pt; text-align: center; text-indent: 0.15pt;\" align=\"center\"><span style=\"font-size: 10pt; font-family: \'Tahoma\',\'sans-serif\';\">:</span></p>
</td>
<td style=\"width: 113.35pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 22.6pt;\" width=\"151\">
<p><span style=\"font-size: 10pt; font-family: \'Tahoma\',\'sans-serif\';\">00</span><span style=\"font-size: 10pt; font-family: \'Tahoma\',\'sans-serif\';\">/ </span><span style=\"font-size: 10pt; font-family: \'Tahoma\',\'sans-serif\';\">-</span></p>
</td>
</tr>
<tr style=\"height: 18.7pt;\">
<td style=\"width: 63.8pt; border-width: medium medium 1pt; border-style: none none solid; border-color: -moz-use-text-color -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 18.7pt;\" width=\"85\">
<p><span style=\"font-size: 10pt; font-family: \'Tahoma\',\'sans-serif\';\">Halaman</span></p>
</td>
<td style=\"width: 14.2pt; border-width: medium medium 1pt; border-style: none none solid; border-color: -moz-use-text-color -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 18.7pt;\" width=\"19\">
<p style=\"margin-left: -0.15pt; text-align: center; text-indent: 0.15pt;\" align=\"center\"><span style=\"font-size: 10pt; font-family: \'Tahoma\',\'sans-serif\';\">:</span></p>
</td>
<td style=\"width: 113.35pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 18.7pt;\" width=\"151\">
<p><span style=\"font-size: 10pt; font-family: \'Tahoma\',\'sans-serif\';\">1</span><span style=\"font-size: 10pt; font-family: \'Tahoma\',\'sans-serif\';\"> dari </span><span style=\"font-size: 10pt; font-family: \'Tahoma\',\'sans-serif\';\">4</span></p>
</td>
</tr>
</tbody>
</table>
<table style=\"margin-left: 5.4pt; border-collapse: collapse; width: 605px;\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\">
<tbody>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-right: 1pt solid windowtext; border-width: medium 1pt 1pt; border-style: none solid solid; border-color: -moz-use-text-color windowtext windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><strong><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">1.</span></strong></p>
</td>
<td style=\"width: 418.85pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"7\" valign=\"top\" width=\"558\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><strong><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Dasar Pelaksanaan </span></strong></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium medium medium 1pt; border-style: none none none solid; border-color: -moz-use-text-color -moz-use-text-color -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span style=\"font-size: 4pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></p>
</td>
<td style=\"width: 418.85pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"7\" valign=\"top\" width=\"558\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span style=\"font-size: 4pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></p>
</td>
<td style=\"width: 36.15pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"48\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">1.1</span></p>
</td>
<td style=\"width: 382.7pt; border-width: 1pt 1pt 1pt medium; border-style: solid solid solid none; border-color: windowtext windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"6\" valign=\"top\" width=\"510\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Pasal 24, Pasal 25, Pasal 26, Pasal 27, Pasal 28, Pasl 29, Pasal 30, Pasal 31, dan Pasal 32 Keputusan Menteri Kehutanan Nomor : 447/Kpts-II/2003 Tentang Tata Usaha Pengambilan atau Penangkapan dan Peredaran Tumbuhan dan Satwa Liar </span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium medium 1pt 1pt; border-style: none none solid solid; border-color: -moz-use-text-color -moz-use-text-color windowtext windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 4pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 418.85pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"7\" valign=\"top\" width=\"558\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><span style=\"font-size: 4pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-right: 1pt solid windowtext; border-width: medium 1pt 1pt; border-style: none solid solid; border-color: -moz-use-text-color windowtext windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><strong><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">2.</span></strong></span></p>
</td>
<td style=\"width: 111.25pt; border-width: medium medium 1pt; border-style: none none solid; border-color: -moz-use-text-color -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"3\" valign=\"top\" width=\"148\">
<p style=\"line-height: 115%; page-break-after: avoid;\"><span><strong><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Tujuan Kegiatan </span></strong></span></p>
</td>
<td style=\"width: 197.3pt; border-width: medium medium 1pt; border-style: none none solid; border-color: -moz-use-text-color -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"3\" valign=\"top\" width=\"263\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><strong><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></strong></span></p>
</td>
<td style=\"width: 110.3pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"147\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><strong><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></strong></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium medium medium 1pt; border-style: none none none solid; border-color: -moz-use-text-color -moz-use-text-color -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 4pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 418.85pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"7\" valign=\"top\" width=\"558\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><span style=\"font-size: 4pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 36.15pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"48\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">2.1</span></span></p>
</td>
<td style=\"width: 382.7pt; border-width: 1pt 1pt 1pt medium; border-style: solid solid solid none; border-color: windowtext windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"6\" valign=\"top\" width=\"510\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Non Komersial</span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 36.15pt; border-width: medium 1pt medium medium; border-style: none solid none none; border-color: -moz-use-text-color windowtext -moz-use-text-color -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"48\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 42.55pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"57\">
<p style=\"line-height: 115%; page-break-after: avoid;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">2.1.1</span></span></p>
</td>
<td style=\"width: 340.15pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"5\" valign=\"top\" width=\"454\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Pengkajian</span></span><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">, penelitian dan pengembangan</span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 36.15pt; border-width: medium 1pt medium medium; border-style: none solid none none; border-color: -moz-use-text-color windowtext -moz-use-text-color -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"48\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 42.55pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"57\">
<p style=\"line-height: 115%;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">2.1.2</span></span></p>
</td>
<td style=\"width: 340.15pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"5\" valign=\"top\" width=\"454\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Peragaan non komersial </span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 36.15pt; border-width: medium 1pt medium medium; border-style: none solid none none; border-color: -moz-use-text-color windowtext -moz-use-text-color -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"48\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 42.55pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"57\">
<p style=\"line-height: 115%;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">2.1.3</span></span></p>
</td>
<td style=\"width: 340.15pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"5\" valign=\"top\" width=\"454\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Pertukaran </span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 36.15pt; border-width: medium 1pt medium medium; border-style: none solid none none; border-color: -moz-use-text-color windowtext -moz-use-text-color -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"48\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 42.55pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"57\">
<p style=\"line-height: 115%;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">2.1.4</span></span></p>
</td>
<td style=\"width: 340.15pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"5\" valign=\"top\" width=\"454\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Perburuan </span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 36.15pt; border-width: medium 1pt medium medium; border-style: none solid none none; border-color: -moz-use-text-color windowtext -moz-use-text-color -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"48\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 42.55pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"57\">
<p style=\"line-height: 115%;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">2.1.5</span></span></p>
</td>
<td style=\"width: 340.15pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"5\" valign=\"top\" width=\"454\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Pemeliharaan untuk kesenangan </span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 36.15pt; border-width: 1pt 1pt 1pt medium; border-style: solid solid solid none; border-color: windowtext windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"48\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">2.2</span></span></p>
</td>
<td style=\"width: 382.7pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"6\" valign=\"top\" width=\"510\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Komersial </span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 36.15pt; border-width: medium 1pt medium medium; border-style: none solid none none; border-color: -moz-use-text-color windowtext -moz-use-text-color -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"48\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 42.55pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"57\">
<p style=\"line-height: 115%; page-break-after: avoid;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">2.2.1</span></span></p>
</td>
<td style=\"width: 340.15pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"5\" valign=\"top\" width=\"454\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Penangkaran </span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 36.15pt; border-width: medium 1pt medium medium; border-style: none solid none none; border-color: -moz-use-text-color windowtext -moz-use-text-color -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"48\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 42.55pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"57\">
<p style=\"line-height: 115%;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">2.2.2</span></span></p>
</td>
<td style=\"width: 340.15pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"5\" valign=\"top\" width=\"454\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Perdagangan </span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 36.15pt; border-width: medium 1pt medium medium; border-style: none solid none none; border-color: -moz-use-text-color windowtext -moz-use-text-color -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"48\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 42.55pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"57\">
<p style=\"line-height: 115%;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">2.2.3</span></span></p>
</td>
<td style=\"width: 340.15pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"5\" valign=\"top\" width=\"454\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Peragaan Komersial </span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 36.15pt; border-width: medium 1pt medium medium; border-style: none solid none none; border-color: -moz-use-text-color windowtext -moz-use-text-color -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"48\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 42.55pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"57\">
<p style=\"line-height: 115%;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">2.2.4</span></span></p>
</td>
<td style=\"width: 340.15pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"5\" valign=\"top\" width=\"454\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Budidaya tanaman obat</span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium medium 1pt 1pt; border-style: none none solid solid; border-color: -moz-use-text-color -moz-use-text-color windowtext windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 4pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 418.85pt; border-width: 1pt 1pt 1pt medium; border-style: solid solid solid none; border-color: windowtext windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"7\" valign=\"top\" width=\"558\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><span style=\"font-size: 4pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-right: 1pt solid windowtext; border-width: medium 1pt 1pt; border-style: none solid solid; border-color: -moz-use-text-color windowtext windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><strong><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">3.</span></strong></span></p>
</td>
<td style=\"width: 111.25pt; border-width: medium medium 1pt; border-style: none none solid; border-color: -moz-use-text-color -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"3\" valign=\"top\" width=\"148\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><strong><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Ruang Lingkup </span></strong></span></p>
</td>
<td style=\"width: 197.3pt; border-width: medium medium 1pt; border-style: none none solid; border-color: -moz-use-text-color -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"3\" valign=\"top\" width=\"263\">
<p style=\"line-height: 115%;\"><span><strong><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></strong></span></p>
</td>
<td style=\"width: 110.3pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"147\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><strong><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></strong></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium medium medium 1pt; border-style: none none none solid; border-color: -moz-use-text-color -moz-use-text-color -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 4pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 418.85pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"7\" valign=\"top\" width=\"558\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><span style=\"font-size: 4pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 418.85pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"7\" valign=\"top\" width=\"558\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Izin dapat diberikan kepada : </span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium medium medium 1pt; border-style: none none none solid; border-color: -moz-use-text-color -moz-use-text-color -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 4pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 418.85pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"7\" valign=\"top\" width=\"558\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><span style=\"font-size: 4pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 36.15pt; border-width: medium 1pt medium medium; border-style: none solid none none; border-color: -moz-use-text-color windowtext -moz-use-text-color -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"48\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">3.1</span></span></p>
</td>
<td style=\"width: 382.7pt; border-width: 1pt 1pt 1pt medium; border-style: solid solid solid none; border-color: windowtext windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"6\" valign=\"top\" width=\"510\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Non Komersial </span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 36.15pt; border-width: medium 1pt medium medium; border-style: none solid none none; border-color: -moz-use-text-color windowtext -moz-use-text-color -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"48\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 42.55pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"57\">
<p style=\"line-height: 115%;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">3.1.1</span></span></p>
</td>
<td style=\"width: 340.15pt; border-width: 1pt 1pt 1pt medium; border-style: solid solid solid none; border-color: windowtext windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"5\" valign=\"top\" width=\"454\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Perorangan</span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 36.15pt; border-width: medium 1pt medium medium; border-style: none solid none none; border-color: -moz-use-text-color windowtext -moz-use-text-color -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"48\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 42.55pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"57\">
<p style=\"line-height: 115%;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">3.1.2</span></span></p>
</td>
<td style=\"width: 340.15pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"5\" valign=\"top\" width=\"454\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Koperasi</span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 36.15pt; border-width: medium 1pt medium medium; border-style: none solid none none; border-color: -moz-use-text-color windowtext -moz-use-text-color -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"48\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 42.55pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"57\">
<p style=\"line-height: 115%;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">3.1.3</span></span></p>
</td>
<td style=\"width: 340.15pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"5\" valign=\"top\" width=\"454\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Lembaga Konservasi</span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 36.15pt; border-width: medium 1pt medium medium; border-style: none solid none none; border-color: -moz-use-text-color windowtext -moz-use-text-color -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"48\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 42.55pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"57\">
<p style=\"line-height: 115%;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">3.1.4</span></span></p>
</td>
<td style=\"width: 340.15pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"5\" valign=\"top\" width=\"454\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Lembaga Penelitian</span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 36.15pt; border-width: medium 1pt medium medium; border-style: none solid none none; border-color: -moz-use-text-color windowtext -moz-use-text-color -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"48\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 42.55pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"57\">
<p style=\"line-height: 115%;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">3.1.5</span></span></p>
</td>
<td style=\"width: 340.15pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"5\" valign=\"top\" width=\"454\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Perguruan Tinggi</span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 36.15pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"48\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 42.55pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"57\">
<p style=\"line-height: 115%;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">3.1.6</span></span></p>
</td>
<td style=\"width: 340.15pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"5\" valign=\"top\" width=\"454\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Lembaga Swadaya Masyarakat (organisasi non pemerintah) yang bergerak di bidang konservasi kenekaragaman hayati</span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 36.15pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"48\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">3.2</span></span></p>
</td>
<td style=\"width: 382.7pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"6\" valign=\"top\" width=\"510\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Komersial </span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 36.15pt; border-width: medium 1pt medium medium; border-style: none solid none none; border-color: -moz-use-text-color windowtext -moz-use-text-color -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"48\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 42.55pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"57\">
<p style=\"line-height: 115%;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">3.2.1</span></span></p>
</td>
<td style=\"width: 340.15pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"5\" valign=\"top\" width=\"454\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Perusahaan Perorangan</span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 36.15pt; border-width: medium 1pt medium medium; border-style: none solid none none; border-color: -moz-use-text-color windowtext -moz-use-text-color -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"48\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 42.55pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"57\">
<p style=\"line-height: 115%;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">3.2.2</span></span></p>
</td>
<td style=\"width: 340.15pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"5\" valign=\"top\" width=\"454\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Koperasi</span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 36.15pt; border-width: medium 1pt medium medium; border-style: none solid none none; border-color: -moz-use-text-color windowtext -moz-use-text-color -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"48\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 42.55pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"57\">
<p style=\"line-height: 115%;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">3.2.3</span></span></p>
</td>
<td style=\"width: 340.15pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"5\" valign=\"top\" width=\"454\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Badan Usaha Milik Negara</span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 36.15pt; border-width: medium 1pt medium medium; border-style: none solid none none; border-color: -moz-use-text-color windowtext -moz-use-text-color -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"48\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 42.55pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"57\">
<p style=\"line-height: 115%;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">3.2.4</span></span></p>
</td>
<td style=\"width: 340.15pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"5\" valign=\"top\" width=\"454\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Badan Usaha Milik Daerah</span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 36.15pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"48\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 42.55pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"57\">
<p style=\"line-height: 115%;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">3.2.5</span></span></p>
</td>
<td style=\"width: 340.15pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"5\" valign=\"top\" width=\"454\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Badan Usaha Milik Swasta</span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium medium medium 1pt; border-style: none none none solid; border-color: -moz-use-text-color -moz-use-text-color -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 4pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 418.85pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"7\" valign=\"top\" width=\"558\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><span style=\"font-size: 4pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 418.85pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"7\" valign=\"top\" width=\"558\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Catatan : </span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 36.15pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"48\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">3.1</span></span></p>
</td>
<td style=\"width: 382.7pt; border-width: 1pt 1pt 1pt medium; border-style: solid solid solid none; border-color: windowtext windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"6\" valign=\"top\" width=\"510\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Izin pengambilan/penangkapan komersial, izin diberikan kepada Pengedar Dalam Negeri atau kepada Pengumpul tumbuhan dan satwa liar</span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium medium 1pt 1pt; border-style: none none solid solid; border-color: -moz-use-text-color -moz-use-text-color windowtext windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 4pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 418.85pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"7\" valign=\"top\" width=\"558\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><span style=\"font-size: 4pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 418.85pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"7\" valign=\"top\" width=\"558\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Status Satwa : </span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 36.15pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"48\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">3.1</span></span></p>
</td>
<td style=\"width: 382.7pt; border-width: 1pt 1pt 1pt medium; border-style: solid solid solid none; border-color: windowtext windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"6\" valign=\"top\" width=\"510\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Dapat diterbitkan untuk jenis yang tidak dilindungi dan dilindungi yang ditetapkan sebagai satwa buru dan telah ditetapkan dalam kuota pemanfaatan tumbuhan dan satwa liar</span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium medium 1pt 1pt; border-style: none none solid solid; border-color: -moz-use-text-color -moz-use-text-color windowtext windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 4pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 418.85pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"7\" valign=\"top\" width=\"558\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><span style=\"font-size: 4pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-right: 1pt solid windowtext; border-width: medium 1pt 1pt; border-style: none solid solid; border-color: -moz-use-text-color windowtext windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><strong><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">4.</span></strong></span></p>
</td>
<td style=\"width: 418.85pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"7\" valign=\"top\" width=\"558\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><strong><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Kelengkapan Proses </span></strong></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium medium medium 1pt; border-style: none none none solid; border-color: -moz-use-text-color -moz-use-text-color -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 4pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 418.85pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"7\" valign=\"top\" width=\"558\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><span style=\"font-size: 4pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 418.85pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"7\" valign=\"top\" width=\"558\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Dalam permohonan memuat informasi, diantaranya</span></span><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\"> : </span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 36.15pt; border-width: medium 1pt medium medium; border-style: none solid none none; border-color: -moz-use-text-color windowtext -moz-use-text-color -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"48\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">4.1</span></span></p>
</td>
<td style=\"width: 382.7pt; border-width: 1pt 1pt 1pt medium; border-style: solid solid solid none; border-color: windowtext windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"6\" valign=\"top\" width=\"510\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Jenis </span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 36.15pt; border-width: 1pt 1pt medium medium; border-style: solid solid none none; border-color: windowtext windowtext -moz-use-text-color -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"48\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">4.2</span></span></p>
</td>
<td style=\"width: 382.7pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"6\" valign=\"top\" width=\"510\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Jumlah </span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 36.15pt; border-width: 1pt 1pt 1pt medium; border-style: solid solid solid none; border-color: windowtext windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"48\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">4.3</span></span></p>
</td>
<td style=\"width: 382.7pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"6\" valign=\"top\" width=\"510\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Jenis Kelamin </span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 36.15pt; border-width: medium 1pt medium medium; border-style: none solid none none; border-color: -moz-use-text-color windowtext -moz-use-text-color -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"48\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">4.4</span></span></p>
</td>
<td style=\"width: 382.7pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"6\" valign=\"top\" width=\"510\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Umur atau ukuran </span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 36.15pt; border-width: 1pt 1pt medium medium; border-style: solid solid none none; border-color: windowtext windowtext -moz-use-text-color -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"48\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">4.5</span></span></p>
</td>
<td style=\"width: 382.7pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"6\" valign=\"top\" width=\"510\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Wilayah pengambilan </span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 36.15pt; border-width: 1pt 1pt medium medium; border-style: solid solid none none; border-color: windowtext windowtext -moz-use-text-color -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"48\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">4.6</span></span></p>
</td>
<td style=\"width: 382.7pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"6\" valign=\"top\" width=\"510\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Deskripsi rinci mengenai tujuan pengambilan atau penangkapan</span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium medium 1pt 1pt; border-style: none none solid solid; border-color: -moz-use-text-color -moz-use-text-color windowtext windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 4pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 418.85pt; border-width: 1pt 1pt 1pt medium; border-style: solid solid solid none; border-color: windowtext windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"7\" valign=\"top\" width=\"558\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><span style=\"font-size: 4pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
</tr>
<tr style=\"height: 7.45pt;\">
<td style=\"width: 34.75pt; border-right: 1pt solid windowtext; border-width: medium 1pt 1pt; border-style: none solid solid; border-color: -moz-use-text-color windowtext windowtext; padding: 0in 5.4pt; height: 7.45pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><strong><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">5.</span></strong></span></p>
</td>
<td style=\"width: 418.85pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 7.45pt;\" colspan=\"7\" valign=\"top\" width=\"558\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><strong><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Unit Kerja / Petugas Terkait </span></strong></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium medium medium 1pt; border-style: none none none solid; border-color: -moz-use-text-color -moz-use-text-color -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 4pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 418.85pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"7\" valign=\"top\" width=\"558\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><span style=\"font-size: 4pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
</tr>
<tr style=\"height: 7.45pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 7.45pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 36.15pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 7.45pt;\" valign=\"top\" width=\"48\">
<p style=\"line-height: 115%;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">5.1</span></span></p>
</td>
<td style=\"width: 272.4pt; border-width: 1pt medium; border-style: solid none; border-color: windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 7.45pt;\" colspan=\"5\" valign=\"top\" width=\"363\">
<p style=\"line-height: 115%;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Kepala Balai Besar KSDA </span></span></p>
</td>
<td style=\"width: 110.3pt; border-width: 1pt 1pt 1pt medium; border-style: solid solid solid none; border-color: windowtext windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 7.45pt;\" valign=\"top\" width=\"147\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
</tr>
<tr style=\"height: 7.45pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 7.45pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 36.15pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 7.45pt;\" valign=\"top\" width=\"48\">
<p style=\"line-height: 115%;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">5.2</span></span></p>
</td>
<td style=\"width: 272.4pt; border-width: medium medium 1pt; border-style: none none solid; border-color: -moz-use-text-color -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 7.45pt;\" colspan=\"5\" valign=\"top\" width=\"363\">
<p style=\"line-height: 115%;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Kepala Bidang Teknis KSDA </span></span></p>
</td>
<td style=\"width: 110.3pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 7.45pt;\" valign=\"top\" width=\"147\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
</tr>
<tr style=\"height: 7.45pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 7.45pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 36.15pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 7.45pt;\" valign=\"top\" width=\"48\">
<p style=\"line-height: 115%;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">5.3</span></span></p>
</td>
<td style=\"width: 272.4pt; border-width: medium medium 1pt; border-style: none none solid; border-color: -moz-use-text-color -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 7.45pt;\" colspan=\"5\" valign=\"top\" width=\"363\">
<p style=\"line-height: 115%;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Kepala Seksi Pemanfaatan dan Pelayanan </span></span></p>
</td>
<td style=\"width: 110.3pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 7.45pt;\" valign=\"top\" width=\"147\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
</tr>
<tr style=\"height: 7.45pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 7.45pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 36.15pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 7.45pt;\" valign=\"top\" width=\"48\">
<p style=\"line-height: 115%;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">5.4</span></span></p>
</td>
<td style=\"width: 272.4pt; border-width: medium medium 1pt; border-style: none none solid; border-color: -moz-use-text-color -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 7.45pt;\" colspan=\"5\" valign=\"top\" width=\"363\">
<p style=\"line-height: 115%;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Sub Bagian Umum </span></span></p>
</td>
<td style=\"width: 110.3pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 7.45pt;\" valign=\"top\" width=\"147\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
</tr>
<tr style=\"height: 7.45pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 7.45pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 36.15pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 7.45pt;\" valign=\"top\" width=\"48\">
<p style=\"line-height: 115%;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">5.5</span></span></p>
</td>
<td style=\"width: 272.4pt; border-width: medium medium 1pt; border-style: none none solid; border-color: -moz-use-text-color -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 7.45pt;\" colspan=\"5\" valign=\"top\" width=\"363\">
<p style=\"line-height: 115%;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Staf Teknis Seksi Pemanfaatan dan Pelayanan </span></span></p>
</td>
<td style=\"width: 110.3pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 7.45pt;\" valign=\"top\" width=\"147\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium medium 1pt 1pt; border-style: none none solid solid; border-color: -moz-use-text-color -moz-use-text-color windowtext windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 4pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 418.85pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"7\" valign=\"top\" width=\"558\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><span style=\"font-size: 4pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
</tr>
<tr style=\"height: 7.45pt;\">
<td style=\"width: 34.75pt; border-right: 1pt solid windowtext; border-width: medium 1pt 1pt; border-style: none solid solid; border-color: -moz-use-text-color windowtext windowtext; padding: 0in 5.4pt; height: 7.45pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><strong><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">6.</span></strong></span></p>
</td>
<td style=\"width: 418.85pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 7.45pt;\" colspan=\"7\" valign=\"top\" width=\"558\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><strong><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Tahapan Kerja </span></strong></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium medium medium 1pt; border-style: none none none solid; border-color: -moz-use-text-color -moz-use-text-color -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 4pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 418.85pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"7\" valign=\"top\" width=\"558\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><span style=\"font-size: 4pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
</tr>
<tr style=\"height: 7.45pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 7.45pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 36.15pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 7.45pt;\" valign=\"top\" width=\"48\">
<p style=\"line-height: 115%;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">6.1</span></span></p>
</td>
<td style=\"width: 382.7pt; border-width: 1pt 1pt 1pt medium; border-style: solid solid solid none; border-color: windowtext windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 7.45pt;\" colspan=\"6\" valign=\"top\" width=\"510\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Surat pemohonan oleh pemohon dengan memuat persyaratan sebagaimana tercantum pada nomor 4. </span></span></p>
</td>
</tr>
<tr style=\"height: 7.45pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 7.45pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 36.15pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 7.45pt;\" valign=\"top\" width=\"48\">
<p style=\"line-height: 115%;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">6.2</span></span></p>
</td>
<td style=\"width: 382.7pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 7.45pt;\" colspan=\"6\" valign=\"top\" width=\"510\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Permohonan diajukan kepada Kepala Balai Besar KSDA Jawa Timur </span></span></p>
</td>
</tr>
<tr style=\"height: 48pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 48pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 36.15pt; border-width: medium 1pt medium medium; border-style: none solid none none; border-color: -moz-use-text-color windowtext -moz-use-text-color -moz-use-text-color; padding: 0in 5.4pt; height: 48pt;\" valign=\"top\" width=\"48\">
<p style=\"line-height: 115%;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">6.3</span></span></p>
</td>
<td style=\"width: 382.7pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 48pt;\" colspan=\"6\" valign=\"top\" width=\"510\">
<p style=\"text-align: justify; line-height: 115%;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Staf seksi pemanfaatan dan pelayanan menerima pemohonan dan membuat dokumen serah terima dokumen permohonan serta melaksanakan <em>check list</em> dokumen permohonan.</span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 36.15pt; border-width: medium 1pt medium medium; border-style: none solid none none; border-color: -moz-use-text-color windowtext -moz-use-text-color -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"48\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 42.55pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"57\">
<p style=\"line-height: 115%;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">6.3.1</span></span></p>
</td>
<td style=\"width: 340.15pt; border-width: 1pt 1pt 1pt medium; border-style: solid solid solid none; border-color: windowtext windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"5\" valign=\"top\" width=\"454\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><em><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Apabila tidak lengkap</span></em></span><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">, Staf Seksi Pemanfaatan dan Pelayanan membuat surat pemberitahuan kekurangan Kelengkapan dokumen.</span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 36.15pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"48\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 42.55pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"57\">
<p style=\"line-height: 115%;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">6.3.2</span></span></p>
</td>
<td style=\"width: 340.15pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"5\" valign=\"top\" width=\"454\">
<p style=\"margin-left: 34.7pt; text-align: justify; text-indent: -34.7pt; line-height: 115%;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Apabila lengkap dilanjutkan ke tahap berikutnya</span></span></p>
</td>
</tr>
<tr style=\"height: 7.45pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 7.45pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 36.15pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 7.45pt;\" valign=\"top\" width=\"48\">
<p style=\"line-height: 115%;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">6.4</span></span></p>
</td>
<td style=\"width: 382.7pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 7.45pt;\" colspan=\"6\" valign=\"top\" width=\"510\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Staf subbag umum mengagenda permohonan dan memberikan lembar penerus berupa lembar disposisi internal untuk diserahkan kepada Kepala Seksi Pemanfaatan dan pelayanan</span></span></p>
</td>
</tr>
<tr style=\"height: 7.45pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 7.45pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 36.15pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 7.45pt;\" valign=\"top\" width=\"48\">
<p style=\"line-height: 115%;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">6.5</span></span></p>
</td>
<td style=\"width: 382.7pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 7.45pt;\" colspan=\"6\" valign=\"top\" width=\"510\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Kepala seksi pemanfaatan dan pelayanan melaksanakan telaahan dan memberikan arahan sesuai acuan normatif dan langkah penyelesaiaannya yang dicantumkan dalam lembar disposisi</span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-right: 1pt solid windowtext; border-width: medium 1pt 1pt; border-style: none solid solid; border-color: -moz-use-text-color windowtext windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 36.15pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"48\">
<p style=\"line-height: 115%; page-break-after: avoid;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">6.6</span></span></p>
</td>
<td style=\"width: 42.55pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"57\">
<p style=\"line-height: 115%;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">6.6.1</span></span></p>
</td>
<td style=\"width: 340.15pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"5\" valign=\"top\" width=\"454\">
<p style=\"text-align: justify; line-height: 115%;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Berdasarkan disposisi dari kepala seksi pemanfaatan dan pelayanan,&nbsp;&nbsp; staf seksi pemanfaatan dan pelayanan melaksanakan pengkajian permohonan sesuai dengan aspek teknis dan administrasi.</span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 36.15pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"48\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 42.55pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"57\">
<p style=\"line-height: 115%;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">6.6.2</span></span></p>
</td>
<td style=\"width: 340.15pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"5\" valign=\"top\" width=\"454\">
<p style=\"text-align: justify; line-height: 115%;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Berdasarkan hasil kajian, staf seksi pemanfaatan dan pelayanan menyusun draft Surat Keputusan/ Surat Izin / Surat Penolakan dan diserahkan kepada Kepala Seksi Pemanfaatan dan Pelayanan.</span></span></p>
</td>
</tr>
<tr style=\"height: 7.45pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 7.45pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 36.15pt; border-width: medium 1pt medium medium; border-style: none solid none none; border-color: -moz-use-text-color windowtext -moz-use-text-color -moz-use-text-color; padding: 0in 5.4pt; height: 7.45pt;\" valign=\"top\" width=\"48\">
<p style=\"line-height: 115%;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">6.7</span></span></p>
</td>
<td style=\"width: 382.7pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 7.45pt;\" colspan=\"6\" valign=\"top\" width=\"510\">
<p style=\"text-align: justify; line-height: 115%;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Kepala Seksi pemanfaatan dan pelayanan, memeriksa Kajian dan draft Surat Keputusan/ Surat Izin / Surat Penolakan terkait terkait acuan normatif.</span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 36.15pt; border-width: medium 1pt medium medium; border-style: none solid none none; border-color: -moz-use-text-color windowtext -moz-use-text-color -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"48\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 42.55pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"57\">
<p style=\"line-height: 115%;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">6.7.1</span></span></p>
</td>
<td style=\"width: 340.15pt; border-width: 1pt 1pt 1pt medium; border-style: solid solid solid none; border-color: windowtext windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"5\" valign=\"top\" width=\"454\">
<p style=\"text-align: justify; line-height: 115%;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Apabila ada perbaikan, dikembalikan kepada Staf Seksi Pemanfaatan dan Pelayanan</span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 36.15pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"48\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 42.55pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"57\">
<p style=\"line-height: 115%;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">6.7.2</span></span></p>
</td>
<td style=\"width: 340.15pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"5\" valign=\"top\" width=\"454\">
<p style=\"text-align: justify; line-height: 115%;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Apabila tidak ada perbaikan Kepala Seksi Pemanfaatan dan Pelayanan menandatangani kajian dan membubuhkan paraf persetujuan pada konsep Surat Keputusan/ Surat Izin/ Surat penolakan dan meneruskan kepada Kepala Bidang Teknis</span></span></p>
</td>
</tr>
<tr style=\"height: 7.45pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 7.45pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 36.15pt; border-width: medium 1pt medium medium; border-style: none solid none none; border-color: -moz-use-text-color windowtext -moz-use-text-color -moz-use-text-color; padding: 0in 5.4pt; height: 7.45pt;\" valign=\"top\" width=\"48\">
<p style=\"line-height: 115%;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">6.8</span></span></p>
</td>
<td style=\"width: 382.7pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 7.45pt;\" colspan=\"6\" valign=\"top\" width=\"510\">
<p style=\"text-align: justify; line-height: 115%;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Kepala Bidang Teknis KSDA, memeriksa K</span></span><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">ajian</span></span><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\"> dan konsep Surat Keputusan/ Surat Izin/ Surat Penolakan terkait dengan </span></span><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Penulisan dan penggunaan bahasa</span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 36.15pt; border-width: medium 1pt medium medium; border-style: none solid none none; border-color: -moz-use-text-color windowtext -moz-use-text-color -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"48\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 42.55pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"57\">
<p style=\"line-height: 115%;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">6.8.1</span></span></p>
</td>
<td style=\"width: 340.15pt; border-width: 1pt 1pt 1pt medium; border-style: solid solid solid none; border-color: windowtext windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"5\" valign=\"top\" width=\"454\">
<p style=\"text-align: justify; line-height: 115%;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Apabila ada perbaikan, dikembalikan kepada </span></span><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Kepala Seksi Pemanfaatan dan Pelayanan</span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 36.15pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"48\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 42.55pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"57\">
<p style=\"line-height: 115%;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">6.8.2</span></span></p>
</td>
<td style=\"width: 340.15pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"5\" valign=\"top\" width=\"454\">
<p style=\"text-align: justify; line-height: 115%;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Apabila tidak ada perbaikan Kepala Bidang Teknis menandatangani kajian dan membubuhkan paraf persetujuan pada konsep surat keputusan/surat izin/ surat penolakan dan meneruskan kepada Kepala Balai Besar KSDA Jawa Timur</span></span></p>
</td>
</tr>
<tr style=\"height: 7.45pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 7.45pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 36.15pt; border-width: medium 1pt medium medium; border-style: none solid none none; border-color: -moz-use-text-color windowtext -moz-use-text-color -moz-use-text-color; padding: 0in 5.4pt; height: 7.45pt;\" valign=\"top\" width=\"48\">
<p style=\"line-height: 115%;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">6.9</span></span></p>
</td>
<td style=\"width: 382.7pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 7.45pt;\" colspan=\"6\" valign=\"top\" width=\"510\">
<p style=\"text-align: justify; line-height: 115%;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Kepala Balai Besar melaksanakan pencermatan terhadap kajian teknis dan konsep surat keputusan/ surat izin/ surat penolakan</span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 36.15pt; border-width: medium 1pt medium medium; border-style: none solid none none; border-color: -moz-use-text-color windowtext -moz-use-text-color -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"48\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 42.55pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"57\">
<p style=\"line-height: 115%;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">6.9.1</span></span></p>
</td>
<td style=\"width: 340.15pt; border-width: 1pt 1pt 1pt medium; border-style: solid solid solid none; border-color: windowtext windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"5\" valign=\"top\" width=\"454\">
<p style=\"text-align: justify; line-height: 115%;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Apabila ada </span></span><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">saran atau </span></span><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">perbaikan, dikembalikan kepada </span></span><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Bidang Teknis KSDA</span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 36.15pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"48\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 42.55pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"57\">
<p style=\"line-height: 115%;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">6.9.2</span></span></p>
</td>
<td style=\"width: 340.15pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"5\" valign=\"top\" width=\"454\">
<p style=\"text-align: justify; line-height: 115%;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Apabila tidak ada perbaikan Kepala Balai Besar KSDA menandatangani Surat keputusan/ surat izin/ surat penolakan</span></span></p>
</td>
</tr>
<tr style=\"height: 7.45pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 7.45pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 36.15pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 7.45pt;\" valign=\"top\" width=\"48\">
<p style=\"line-height: 115%;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">6.10</span></span></p>
</td>
<td style=\"width: 382.7pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 7.45pt;\" colspan=\"6\" valign=\"top\" width=\"510\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Staf subbag umum memberikan nomor dan tanggal surat keputusan/ surat izin/ surat penolakan dan menyerahkan dokumen surat izin kepada pemohon serta pengarsipan </span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium medium 1pt 1pt; border-style: none none solid solid; border-color: -moz-use-text-color -moz-use-text-color windowtext windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 4pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 418.85pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"7\" valign=\"top\" width=\"558\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><span style=\"font-size: 4pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-right: 1pt solid windowtext; border-width: medium 1pt 1pt; border-style: none solid solid; border-color: -moz-use-text-color windowtext windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><strong><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">7.</span></strong></span></p>
</td>
<td style=\"width: 418.85pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"7\" valign=\"top\" width=\"558\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><strong><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Waktu Penyelesaian Proses </span></strong></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium medium medium 1pt; border-style: none none none solid; border-color: -moz-use-text-color -moz-use-text-color -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 4pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 418.85pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"7\" valign=\"top\" width=\"558\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><span style=\"font-size: 4pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 36.15pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"48\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">7.1</span></span></p>
</td>
<td style=\"width: 382.7pt; border-width: 1pt 1pt 1pt medium; border-style: solid solid solid none; border-color: windowtext windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"6\" valign=\"top\" width=\"510\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Selambat-lambatnya 14 (empat belas) hari kerja setelah permohonan diterima.</span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 36.15pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"48\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">7.2</span></span></p>
</td>
<td style=\"width: 382.7pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"6\" valign=\"top\" width=\"510\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Tata Waktu Pelaksanaan Kegiatan </span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 148.25pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"4\" valign=\"top\" width=\"198\">
<p style=\"text-align: center; line-height: 115%;\" align=\"center\"><span><strong><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Tahap</span></strong></span></p>
</td>
<td style=\"width: 148.3pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"198\">
<p style=\"text-align: center; line-height: 115%;\" align=\"center\"><span><strong><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Urutan Kegiatan</span></strong></span></p>
</td>
<td style=\"width: 122.3pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"2\" valign=\"top\" width=\"163\">
<p style=\"text-align: center; line-height: 115%;\" align=\"center\"><span><strong><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Waktu Penyelesaian</span></strong></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 148.25pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"4\" valign=\"top\" width=\"198\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">1</span></span></p>
</td>
<td style=\"width: 148.3pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"198\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">6.1 -6.4</span></span></p>
</td>
<td style=\"width: 122.3pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"2\" valign=\"top\" width=\"163\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">4 hari</span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 148.25pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"4\" valign=\"top\" width=\"198\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">2</span></span></p>
</td>
<td style=\"width: 148.3pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"198\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">6.5 &ndash; 6.9</span></span></p>
</td>
<td style=\"width: 122.3pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"2\" valign=\"top\" width=\"163\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">8 hari </span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 148.25pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"4\" valign=\"top\" width=\"198\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">3</span></span></p>
</td>
<td style=\"width: 148.3pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"198\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">6.10 </span></span></p>
</td>
<td style=\"width: 122.3pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"2\" valign=\"top\" width=\"163\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">2 hari </span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><strong><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></strong></span></p>
</td>
<td style=\"width: 148.25pt; border-width: medium medium 1pt; border-style: none none solid; border-color: -moz-use-text-color -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"4\" valign=\"top\" width=\"198\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><strong><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Total</span></strong></span></p>
</td>
<td style=\"width: 148.3pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"198\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><strong><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></strong></span></p>
</td>
<td style=\"width: 122.3pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"2\" valign=\"top\" width=\"163\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><strong><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">14 hari </span></strong></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium medium 1pt 1pt; border-style: none none solid solid; border-color: -moz-use-text-color -moz-use-text-color windowtext windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 4pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 418.85pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"7\" valign=\"top\" width=\"558\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><span style=\"font-size: 4pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-right: 1pt solid windowtext; border-width: medium 1pt 1pt; border-style: none solid solid; border-color: -moz-use-text-color windowtext windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><strong><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">8.</span></strong></span></p>
</td>
<td style=\"width: 418.85pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"7\" valign=\"top\" width=\"558\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><strong><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Masa Berlaku Izin </span></strong></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium medium medium 1pt; border-style: none none none solid; border-color: -moz-use-text-color -moz-use-text-color -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 4pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 418.85pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; border-color: -moz-use-text-color windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"7\" valign=\"top\" width=\"558\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><span style=\"font-size: 4pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium 1pt; border-style: none solid; border-color: -moz-use-text-color windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 36.15pt; border-width: medium 1pt medium medium; border-style: none solid none none; border-color: -moz-use-text-color windowtext -moz-use-text-color -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"48\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">8.1</span></span></p>
</td>
<td style=\"width: 382.7pt; border-width: 1pt 1pt 1pt medium; border-style: solid solid solid none; border-color: windowtext windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"6\" valign=\"top\" width=\"510\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><span style=\"font-size: 11pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">Izin berlaku maksimum selama 1 (satu) tahun </span></span></p>
</td>
</tr>
<tr style=\"height: 3.55pt;\">
<td style=\"width: 34.75pt; border-width: medium medium 1pt 1pt; border-style: none none solid solid; border-color: -moz-use-text-color -moz-use-text-color windowtext windowtext; padding: 0in 5.4pt; height: 3.55pt;\" valign=\"top\" width=\"46\">
<p style=\"text-align: center; line-height: 115%; page-break-after: avoid;\" align=\"center\"><span><span style=\"font-size: 4pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
<td style=\"width: 418.85pt; border-width: 1pt 1pt 1pt medium; border-style: solid solid solid none; border-color: windowtext windowtext windowtext -moz-use-text-color; padding: 0in 5.4pt; height: 3.55pt;\" colspan=\"7\" valign=\"top\" width=\"558\">
<p style=\"text-align: justify; line-height: 115%; page-break-after: avoid;\"><span><span style=\"font-size: 4pt; line-height: 115%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></span></p>
</td>
</tr>
</tbody>
</table>
<p style=\"margin-left: 153pt; text-align: justify; text-indent: -153pt; line-height: 150%;\"><span style=\"font-size: 11pt; line-height: 150%; font-family: \'Tahoma\',\'sans-serif\';\">&nbsp;</span></p>","15","page");
INSERT INTO pages VALUES("15","Perijinan","Perijinan","8","<p>Perijinan</p>","0","page");
INSERT INTO pages VALUES("16","Unit Penangkar","penangkar","11","<p>Penangkar</p>","0","page");
INSERT INTO pages VALUES("17","Peredaran TSL","peredaran","12","<p>peredaran</p>","0","page");



DROP TABLE periode;

CREATE TABLE `periode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` year(4) NOT NULL,
  `semester` tinyint(11) NOT NULL,
  `locked` varchar(2) NOT NULL,
  `active` varchar(2) NOT NULL,
  `created_by` varchar(25) CHARACTER SET latin1 NOT NULL,
  `modified_by` varchar(25) CHARACTER SET latin1 NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO periode VALUES("2","2014","1","T","Y","firmantok","firmantok","2014-03-13 17:06:10","2014-03-13 17:06:34");
INSERT INTO periode VALUES("3","2015","1","T","T","firmantok","firmantok","2014-03-13 16:49:08","2014-03-13 16:49:32");



DROP TABLE provinsi;

CREATE TABLE `provinsi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_provinsi_UNIQUE` (`id`),
  UNIQUE KEY `nama_UNIQUE` (`nama`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO provinsi VALUES("2","Jawa Barat");
INSERT INTO provinsi VALUES("3","Jawa Tengah");
INSERT INTO provinsi VALUES("1","Jawa Timur");



DROP TABLE slider;

CREATE TABLE `slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `images_link` varchar(255) NOT NULL,
  `caption` varchar(255) NOT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE users;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(128) NOT NULL,
  `username` varchar(45) NOT NULL,
  `id_group` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `fk_users_group_idx` (`id_group`),
  CONSTRAINT `fk_users_group` FOREIGN KEY (`id_group`) REFERENCES `users_group` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO users VALUES("1","admin@yahoo.com","20ff0e5362d014396deca7c20641d6c1643927a319e95a7f5433012a06a3183d1c0368b5a1265e9ea4427d39b67983502785cd34d0deb65c19db455f46885869","admin","1");
INSERT INTO users VALUES("2","fir_man_tok@yahoo.com","20ff0e5362d014396deca7c20641d6c1643927a319e95a7f5433012a06a3183d1c0368b5a1265e9ea4427d39b67983502785cd34d0deb65c19db455f46885869","firmantok","2");
INSERT INTO users VALUES("3","tes@yahoo.com","97e874cf6391c72c9db0c6276d4217aa77aa3b230cb79455698a8d14b8fb064e650cdeb888d60523b5b9e7aeaee6f7cde9013c07d85dbe0f23d988970cee5909","tes","3");



DROP TABLE users_group;

CREATE TABLE `users_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_group` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nama_group_UNIQUE` (`nama_group`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO users_group VALUES("2","Administrator");
INSERT INTO users_group VALUES("3","Perencanaan");
INSERT INTO users_group VALUES("1","Super Administrator");



