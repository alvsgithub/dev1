<table class="table-bordered table-striped table-condensed" style="width: 100%;text-align: center;">
    <thead>
        <tr style="background-color: #6699ff;">
        <th>Versi</th>
        <th>Anggaran</th>
        <th>HPS</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach($detail as $row){
    ?>
    <tr>
        <td><?php echo $row->versi; ?></td>
        <td style="text-align:right;"><?php echo number_format($row->anggaran, 2, ',', '.'); ?></td>
        <td style="text-align:right;"><?php echo number_format($row->oe, 2, ',', '.'); ?></td>
    </tr> 
    <?php
    }
    ?>
    </tbody>
</table>
<br>
<table align="center" cellpadding="1" cellspacing="2">
    <tr>
        <?php
        foreach ($role as $row) {
        ?>
        <td align="center" style="border: 2px #022bfc solid; background-color: #CAD6EC; padding: 0px; width: 150px; vertical-align: top; font-family: Arial; font-size: 10px;margin: 5px;padding: 5px;">
            <?php 
                echo $row['jabatan'].'<br>';
                echo $row['nama'].'<br><br><br>';
                
                if($row['level'] == $position && $row['nopeg'] == $nopeg_user){
                ?>
                    <button class="btn btn-small btn-primary" type="button" onclick="setuju()"><i class="icon-okb icon-white"></i> Setujui</button>
                    <button class="btn btn-small btn-primary" type="button"><i class="icon-removeb icon-white"></i> Tolak</button>
                <?php
                }
            ?>
        </td>
        <?php
        } 
        ?>
    </tr>    
</table> 
<script>
    var kode = '<?php echo $kode; ?>';
    function setuju(){
        $.messager.confirm('Konfirmasi','Yakin mengusulkan '+kode+' ?',function(r){
            if (r){
                $.post('<?php echo site_url('app/rab/setujui'); ?>',{kode:kode},function(result){
                    if (result.success){
//                        $.messager.alert('Sukses',result.msg,'error');
//                        $(this).load('<?php echo site_url('app/rab/verifikasi'); ?>?kode='+kode);
                        header('<?php echo site_url('app/rab/verifikasi'); ?>?kode='+kode);
                    } else {
                        $.messager.alert('Error',result.msg,'error');
                    }
                },'json');
            }
        });
    }
</script>


