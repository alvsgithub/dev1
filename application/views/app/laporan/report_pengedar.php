<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PENGEDAR</title>
<!--<link href="<?php // echo $site_url.'asset/fonts/stylesheet.css'; ?>" rel="stylesheet">-->
<style>
body{ font-family:"Helvetica Neue",Helvetica,Arial,sans-serif; font-size:9pt; margin:0; padding:0; }
.data{ border:1px solid #000; }
.data th, .data td{ border:1px solid #000; padding:5px; }
thead { display: table-header-group; }  
h1{ font-size: 10pt; }
</style>
</head>
<body>
    
<table width="100%" border="0" cellpadding="0">
    <tr>
        <td width="20%" align="center">

        </td>
        <td width="60%">
            <h1 align='center'>
                LAPORAN BULANAN PERKEMBANGAN KEADAAN TSL DAN BAGIAN-BAGIANNYA
            </h1>
        </td>
        <td width="20%" align='right'></td>
    </tr>
</table>
<br>

<table>
    <tr>
        <td>Nama Perusahaan</td>
        <td>:</td>
        <td><?php echo $pengedar[0]->nama_perusahaan; ?></td>
    </tr>
    <tr>
        <td>SK Perijinan</td>
        <td>:</td>
        <td><?php echo $pengedar[0]->ijin.' ( '.$pengedar[0]->tgl_sk.' S/D '.$pengedar[0]->tgl_sk2.' )'; ?></td>
    </tr>
    <tr>
        <td>Alamat Perusahaan</td>
        <td>:</td>
        <td><?php echo $pengedar[0]->alamat_anggota; ?></td>
    </tr>
</table>
    
<br>
    
<table style="font-size: 8pt;" width="100%" border="0" cellpadding="0" cellspacing="0" class='data' align="center">
<thead>
    <tr>
        <th style="width: 7.5%;">Quota Rencana</th>
        
        <th style="width: 7.5%;">Januari</th>
        <th style="width: 7.5%;">Februari</th>
        <th style="width: 7.5%;">Maret</th>
        <th style="width: 7.5%;">April</th>
        <th style="width: 7.5%;">Mei</th>
        <th style="width: 7.5%;">Juni</th>
        
        <th style="width: 7.5%;">Juli</th>
        <th style="width: 7.5%;">Agustus</th>
        <th style="width: 7.5%;">September</th>
        <th style="width: 7.5%;">Oktober</th>
        <th style="width: 7.5%;">Nopember</th>
        <th style="width: 7.5%;">Desember</th>
    </tr>
</thead>
<tbody>
    <tr>
        <td style="width: 7.5%;text-align: right;"><?php echo $pengedar[0]->qty_rencana; ?></td>
        
        <td style="width: 7.5%;text-align: right;"><?php echo $pengedar[0]->januari; ?></td>
        <td style="width: 7.5%;text-align: right;"><?php echo $pengedar[0]->februari; ?></td>
        <td style="width: 7.5%;text-align: right;"><?php echo $pengedar[0]->maret; ?></td>
        <td style="width: 7.5%;text-align: right;"><?php echo $pengedar[0]->april; ?></td>
        <td style="width: 7.5%;text-align: right;"><?php echo $pengedar[0]->mei; ?></td>
        <td style="width: 7.5%;text-align: right;"><?php echo $pengedar[0]->juni; ?></td>
        
        <td style="width: 7.5%;text-align: right;"><?php echo $pengedar[0]->juli; ?></td>
        <td style="width: 7.5%;text-align: right;"><?php echo $pengedar[0]->agustus; ?></td>
        <td style="width: 7.5%;text-align: right;"><?php echo $pengedar[0]->september; ?></td>
        <td style="width: 7.5%;text-align: right;"><?php echo $pengedar[0]->oktober; ?></td>
        <td style="width: 7.5%;text-align: right;"><?php echo $pengedar[0]->nopember; ?></td>
        <td style="width: 7.5%;text-align: right;"><?php echo $pengedar[0]->desember; ?></td>
    </tr>
</tbody>
</table>

<br>

Rencana<br><br>
<table style="font-size: 8pt;" width="100%" border="0" cellpadding="0" cellspacing="0" class='data' align="center">
    <thead>
        <tr>
            <th>Tumbuhan & Satwa Liar</th>
            <th>Satuan</th>
            <th>Qty</th>
            <th>Jenis Kelamin</th>
            <th>Jenis Gen</th>
            <th>Status</th>
            <th>Cites</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($rencana_detail as $row_drencana){
        ?>
        <tr>
            <td><?php echo $row_drencana->nama_indo.' / '.$row_drencana->nama_latin; ?></td>
            <td><?php echo $row_drencana->kode_satuan; ?></td>
            <td style="text-align: right;"><?php echo $row_drencana->qty; ?></td>
            <td style="text-align: center;"><?php echo $row_drencana->jenis_kelamin; ?></td>
            <td style="text-align: center;"><?php echo $row_drencana->jenis_gen; ?></td>
            <td><?php echo $row_drencana->status; ?></td>
            <td><?php echo $row_drencana->cites; ?></td>
        </tr>
        <?php 
        }
        ?>
    </tbody>
</table>    
<br>
Realisasi<br><br>
<table style="font-size: 8pt;" width="100%" border="0" cellpadding="0" cellspacing="0" class='data' align="center">
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Tumbuhan & Satwa Liar</th>
            <th>Satuan</th>
            <th>Qty</th>
            <th>Jenis Kelamin</th>
            <th>Jenis Gen</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($realisasi as $row_realisasi){
        ?>
        <tr>
            <td><?php echo $row_realisasi->tgl; ?></td>
            <td><?php echo $row_realisasi->nama_indo.' / '.$row_realisasi->nama_latin; ?></td>
            <td><?php echo $row_realisasi->kode; ?></td>
            <td style="text-align: right;"><?php echo $row_realisasi->quota; ?></td>
            <td style="text-align: center;"><?php echo $row_realisasi->jenis_kelamin; ?></td>
            <td style="text-align: center;"><?php echo $row_realisasi->jenis_gen; ?></td>
        </tr>
        <?php 
        }
        ?>
    </tbody>
</table>    

</body>
</html>
