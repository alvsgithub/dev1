<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PENANGKAR</title>
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
        <td><?php echo $penangkar[0]->nama_perusahaan; ?></td>
    </tr>
    <tr>
        <td>SK Perijinan</td>
        <td>:</td>
        <td><?php echo $penangkar[0]->sk_perijinan.' ( '.$penangkar[0]->tgl_sk.' S/D '.$penangkar[0]->tgl_sk2.' )'; ?></td>
    </tr>
    <tr>
        <td>Alamat Perusahaan</td>
        <td>:</td>
        <td><?php echo $penangkar[0]->alamat_anggota; ?></td>
    </tr>
    <tr>
        <td>Alamat Penangkaran</td>
        <td>:</td>
        <td><?php echo $penangkar[0]->alamat_penangkaran; ?></td>
    </tr>
</table>
    
<br>
    
<table style="font-size: 8pt;" width="100%" border="0" cellpadding="0" cellspacing="0" class='data' align="center">
<thead>
    <tr>
        <th rowspan="2" style="width: 30%;">Jenis (Indonesia/Ilmiah)</th>
        <th colspan="4" style="width: 20%;">Jumlah Bulan Lalu</th>
        <th colspan="4" style="width: 20%;">Mutasi</th>
        <th colspan="4" style="width: 20%;">Jumlah Bulan ini</th>
    </tr>
    <tr>
        
        <th style="width: 4.7%;">
            <p style="font-family: firefly, DejaVu Sans, sans-serif;">&#9794;</p>
        </th>
        <th style="width: 4.7%;">
            <p style="font-family: firefly, DejaVu Sans, sans-serif;">&#9792;</p>
        </th>
        <th style="width: 4.7%;">
            <p style="font-family: firefly, DejaVu Sans, sans-serif;">?</p>
        </th>
        <th style="width: 5.9%;">
            <p style="font-family: firefly, DejaVu Sans, sans-serif;">&sum;</p>
        </th>
        
        <th style="width: 4.7%;">
            <p style="font-family: firefly, DejaVu Sans, sans-serif;">&#9794;</p>
        </th>
        <th style="width: 4.7%;">
            <p style="font-family: firefly, DejaVu Sans, sans-serif;">&#9792;</p>
        </th>
        <th style="width: 4.7%;">
            <p style="font-family: firefly, DejaVu Sans, sans-serif;">?</p>
        </th>
        <th style="width: 5.9%;">
            <p style="font-family: firefly, DejaVu Sans, sans-serif;">&sum;</p>
        </th>
        
        <th style="width: 4.7%;">
            <p style="font-family: firefly, DejaVu Sans, sans-serif;">&#9794;</p>
        </th>
        <th style="width: 4.7%;">
            <p style="font-family: firefly, DejaVu Sans, sans-serif;">&#9792;</p>
        </th>
        <th style="width: 4.7%;">
            <p style="font-family: firefly, DejaVu Sans, sans-serif;">?</p>
        </th>
        <th style="width: 5.9%;">
            <p style="font-family: firefly, DejaVu Sans, sans-serif;">&sum;</p>
        </th>
        
    </tr>
</thead>
<tbody>
    <?php
    foreach($komoditi as $row_komoditi){
    ?>
    <tr>
        
        <td style="font-weight: bold;"><?php echo $row_komoditi->nama_komoditi; ?></td>
        
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    
        <?php
        foreach($tsl as $row_tsl){
            if($row_tsl->id_komoditi == $row_komoditi->id_komoditi){
        ?>
        <tr>

            <td>&nbsp;&nbsp;&nbsp;<?php echo $row_tsl->nama_tsl; ?></td>

            <td></td>
            <td></td>
            <td></td>
            <td></td>

            <td></td>
            <td></td>
            <td></td>
            <td></td>

            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    
        <!-- F0 -->
        <tr>

            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;F<sub>0</sub></td>

            <td style="text-align: right;"><?php echo $row_tsl->F0jantan_bulan_lalu; ?></td>
            <td style="text-align: right;"><?php echo $row_tsl->F0betina_bulan_lalu; ?></td>
            <td style="text-align: right;"><?php echo $row_tsl->F0_tanda_tanya_bulan_lalu; ?></td>
            <td style="text-align: right;"><?php echo $row_tsl->F0_total_bulan_lalu; ?></td>

            <td style="text-align: right;"><?php echo $row_tsl->F0jantan - $row_tsl->F0jantan_bulan_lalu; ?></td>
            <td style="text-align: right;"><?php echo $row_tsl->F0betina - $row_tsl->F0betina_bulan_lalu; ?></td>
            <td style="text-align: right;"><?php echo $row_tsl->F0_tanda_tanya - $row_tsl->F0_tanda_tanya_bulan_lalu; ?></td>
            <td style="text-align: right;"><?php echo $row_tsl->F0_total - $row_tsl->F0_total_bulan_lalu; ?></td>

            <td style="text-align: right;"><?php echo $row_tsl->F0jantan; ?></td>
            <td style="text-align: right;"><?php echo $row_tsl->F0betina; ?></td>
            <td style="text-align: right;"><?php echo $row_tsl->F0_tanda_tanya; ?></td>
            <td style="text-align: right;"><?php echo $row_tsl->F0_total; ?></td>

        </tr>
    
        <!-- F1 -->
        <tr>

            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;F<sub>1</sub></td>

            <td style="text-align: right;"><?php echo $row_tsl->F1jantan_bulan_lalu; ?></td>
            <td style="text-align: right;"><?php echo $row_tsl->F1betina_bulan_lalu; ?></td>
            <td style="text-align: right;"><?php echo $row_tsl->F1_tanda_tanya_bulan_lalu; ?></td>
            <td style="text-align: right;"><?php echo $row_tsl->F1_total_bulan_lalu; ?></td>

            <td style="text-align: right;"><?php echo $row_tsl->F1jantan - $row_tsl->F1jantan_bulan_lalu; ?></td>
            <td style="text-align: right;"><?php echo $row_tsl->F1betina - $row_tsl->F1betina_bulan_lalu; ?></td>
            <td style="text-align: right;"><?php echo $row_tsl->F1_tanda_tanya - $row_tsl->F1_tanda_tanya_bulan_lalu; ?></td>
            <td style="text-align: right;"><?php echo $row_tsl->F1_total - $row_tsl->F1_total_bulan_lalu; ?></td>

            <td style="text-align: right;"><?php echo $row_tsl->F1jantan; ?></td>
            <td style="text-align: right;"><?php echo $row_tsl->F1betina; ?></td>
            <td style="text-align: right;"><?php echo $row_tsl->F1_tanda_tanya; ?></td>
            <td style="text-align: right;"><?php echo $row_tsl->F1_total; ?></td>
        </tr>
    
        <!-- F2dst -->
        <tr>

            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;F<sub>2dst</sub></td>

            <td style="text-align: right;"><?php echo $row_tsl->F2jantan_bulan_lalu; ?></td>
            <td style="text-align: right;"><?php echo $row_tsl->F2betina_bulan_lalu; ?></td>
            <td style="text-align: right;"><?php echo $row_tsl->F2_tanda_tanya_bulan_lalu; ?></td>
            <td style="text-align: right;"><?php echo $row_tsl->F2_total_bulan_lalu; ?></td>

            <td style="text-align: right;"><?php echo $row_tsl->F2jantan - $row_tsl->F2jantan_bulan_lalu; ?></td>
            <td style="text-align: right;"><?php echo $row_tsl->F2betina - $row_tsl->F2betina_bulan_lalu; ?></td>
            <td style="text-align: right;"><?php echo $row_tsl->F2_tanda_tanya - $row_tsl->F2_tanda_tanya_bulan_lalu; ?></td>
            <td style="text-align: right;"><?php echo $row_tsl->F2_total - $row_tsl->F2_total_bulan_lalu; ?></td>

            <td style="text-align: right;"><?php echo $row_tsl->F2jantan; ?></td>
            <td style="text-align: right;"><?php echo $row_tsl->F2betina; ?></td>
            <td style="text-align: right;"><?php echo $row_tsl->F2_tanda_tanya; ?></td>
            <td style="text-align: right;"><?php echo $row_tsl->F2_total; ?></td>
        </tr>
        <?php
            }
        }
    }
    ?>
</tbody>
</table>
   
</body>
</html>
