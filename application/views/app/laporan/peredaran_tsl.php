<div class="modal-header">
    <h4>Laporan Peredaran TSL</h4>
</div>
<section_custom>
    <table class="table table-condensed">
        <tr>
            <td style="width: 10%;">Nama Perusahaan</td>
            <td>:</td>
            <td>
                <?php 
                    echo form_input('id_pengedar', set_value('id_pengedar'), 
                    'id="combo-pengedar", required="true", style="width:600px;"'); 
                ?>
                <?php 
                    echo form_dropdown('year', $options_years, date('Y'), 
                    'id="year", class="easyui-combobox", onChange="changeYear();" style="width: 125px;"'); 
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

</section_custom>

<script>
    $(function(){
       $('#combo-pengedar').combogrid({
            panelWidth:600, url: '<?php site_url('app/laporan/peredaran_tsl/'); ?>?pengedar=true',  
            idField:'id', textField:'textview', mode:'remote', fitColumns:false,  
            columns:[[   
                    {field:'nama_perusahaan',title:'Nama Perusahaan',width:250},  
                    {field:'ijin',title:'SK Perijinan',width:180},
                    {field:'tgl_sk2',title:'Akhir Berlaku',width:90,align:'center'}
                ]]
        }); 
    });
    
    function pdf(){
        var param = $('#combo-pengedar').combogrid('grid').datagrid('getSelected');
        if(param){
            window.open('<?php echo site_url('app/laporan/pdf_pengedar') ?>?id='+param.id+'&tahun='+document.getElementById('year').value, 'Print Out Pengedar','scrollbars=yes,width=800,height=600,left=50,top=50,toolbar=0,status=0');
        }else{
            $.messager.show({ title: 'Pesan', timeout: 1000, msg: 'Pilih salah satu pengedar dulu..', style:{ right:'center', top:'center' } });
        }
    }
    
    function xls(){
        var param = $('#combo-pengedar').combogrid('grid').datagrid('getSelected');
        if(param){
            window.open('<?php echo site_url('app/laporan/xls_pengedar') ?>?id='+param.id+'&tahun='+document.getElementById('year').value);
        }else{
            $.messager.show({ title: 'Pesan', timeout: 1000, msg: 'Pilih salah satu pengedar dulu..', style:{ right:'center', top:'center' } });
        }
    }
</script>