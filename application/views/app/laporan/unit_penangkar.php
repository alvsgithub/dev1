<div class="modal-header">
    <h4>Laporan Unit Penangkar</h4>
</div>
<section_custom>
<?php // echo form_open(); ?>
<table class="table table-condensed">
    <tr>
        <td style="width: 10%;">Nama Perusahaan</td>
        <td>:</td>
        <td>
            <?php 
                echo form_input('id_penangkar', set_value('id_penangkar'), 
                    'id="combo-penangkar", required="true", style="width:600px;"'); 
            ?>
        </td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td>
            <a href="javascript:void(0)" class="btn btn-primary" type="button" onclick="pdf();"><i class="icon-pdf"></i>  PDF</a>
            <a href="javascript:void(0)" class="btn btn-primary" type="button" onclick="xls();"><i class="icon-xls"></i>  XLS</a>
        </td>
    </tr>
</table>
<?php // echo form_close();?>
</section_custom>

<script>
    $(function(){
       $('#combo-penangkar').combogrid({
            panelWidth:600, url: '<?php site_url('app/laporan/unit_penangkar/'); ?>?penangkar=true',  
            idField:'id', textField:'textview', mode:'remote', fitColumns:false,  
            columns:[[   
                    {field:'nama_perusahaan',title:'Nama Perusahaan',width:250},  
                    {field:'sk_perijinan',title:'SK Perijinan',width:180},
                    {field:'tgl_sk2',title:'Akhir Berlaku',width:90,align:'center'}
                ]]
        }); 
    });
    function pdf(){
        var param = $('#combo-penangkar').combogrid('grid').datagrid('getSelected');
        if(param){
            window.open('<?php echo site_url('app/laporan/pdf_penangkar') ?>?id='+param.id, 'Print Out Cek Pal Batas','scrollbars=yes,width=800,height=600,left=50,top=50,toolbar=0,status=0');
        }else{
            $.messager.show({ title: 'Pesan', timeout: 1000, msg: 'Pilih salah satu penangkar dulu..', style:{ right:'center', top:'center' } });
        }
    }
    
    function xls(){
        var param = $('#combo-penangkar').combogrid('grid').datagrid('getSelected');
        if(param){
            window.open('<?php echo site_url('app/laporan/xls_penangkar') ?>?id='+param.id);
        }else{
            $.messager.show({ title: 'Pesan', timeout: 1000, msg: 'Pilih salah satu penangkar dulu..', style:{ right:'center', top:'center' } });
        }
    }
</script>
    