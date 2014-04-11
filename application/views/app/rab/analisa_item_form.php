<div id="dlgai" class="easyui-dialog" style="width:auto; height:auto; padding: 10px 20px" 
     closed="true" buttons="#dbtnai">
    <form id="fmai" method="post" novalidate>
    <table>
        <input id="id_parent_ai" name="id_parent" class="easyui-validatebox" required="true"/>
        <input id="iud_ai" name="id_usulan_detail" class="easyui-validatebox" required="true"/>
        <input id="jenis_ai" name="jenis_ai" class="easyui-validatebox" required="true" readonly="true"/>
	<tr>
            <td>No Urut</td>
            <td>:</td>
            <td><input name="no_urut" class="easyui-numberspinner" required="true" min="1" max="9" style="width: 70px;"/></td>
	</tr>
	<tr>
            <td>Analisa / Item</td>
            <td>:</td>
            <td><input id="ai" name="ai" required="true" size="100"/></td>
	</tr>
        <tr>
            <td>Kode</td>
            <td>:</td>
            <td><input id="kode_ai" name="kode" class="easyui-validatebox" required="true" readonly="true"/></td>
	</tr>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td><input id="nama_ai" name="nama" class="easyui-validatebox" required="true" readonly="true" style="width: 350px;"/></td>
	</tr>
        <tr>
            <td>Satuan</td>
            <td>:</td>
            <td><input id="satuan_ai" name="satuan" class="easyui-validatebox" required="true" readonly="true"/></td>
	</tr>
        <tr>
            <td>Harga Pagu</td>
            <td>:</td>
            <td><input id="pd" name="harga_pagu" class="easyui-validatebox" required="true" readonly="true" style="text-align:right;"/></td>
	</tr>
        <tr>
            <td>Harga OE</td>
            <td>:</td>
            <td><input id="od" name="harga_oe" class="easyui-validatebox" required="true" readonly="true" style="text-align:right;"/></td>
	</tr>
        <tr>
            <td>Volume</td>
            <td>:</td>
            <td><input name="volume" class="easyui-numberbox" required="true" precision="5" decimalSeparator="," groupSeparator="." style="text-align: right; width: 100px;"/></td>
	</tr>
    </table>
    </form>
    <div id="dbtnai"> 
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-save" onclick="saveAnalisaItem();">Simpan</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgai').dialog('close');">Batal</a>
    </div>
</div>
<script>
    function addAnalisaItem(idud,idp){
        $('#fmai').form('clear');
        document.getElementById('id_parent_ai').value = idp;
        document.getElementById('iud_ai').value = idud;
        $('#dlgai').dialog({ 
            title: 'Add - Analisa / Item',
            closed: false, cache: false, modal: true, 
            width: 600, height: 400
        });
        url = '<?php echo site_url('app/rab/createAnalisaItem'); ?>/'+idud;		
    }
    
    function editAnalisaItem(id){
        var tg = $('#tg');
        var opts = tg.treegrid('options');
        var row = tg.treegrid('find', id);
        $('#ai').combogrid('grid').datagrid('load', { q: row.kode });
        $('#fmai').form('load',row);
        $('#dialog-aitahapan').dialog({ 
            title: 'Edit - Analisa / Item',
            closed: false, cache: false, modal: true, 
            width: 600, height: 400 
        });
        url = '<?php echo site_url('app/rab/updateTahapan'); ?>/'+id;
    }
    
    function saveAnalisaItem(){
        $.messager.progress({title:'Save Progress',text:'Save..',interval:5});
        $('#fmai').form('submit',{
            url: url,
            onSubmit: function(){ return $(this).form('validate'); },
            success: function(result){
                var result = eval('('+result+')');
                if(result.success){
                    $.messager.progress('close');
                    $('#dlgai').dialog('close');
                    $('#tg').treegrid('reload');
                } else {
                    $.messager.progress('close');
                    $.messager.alert('Error',result.msg,'error');
                }
            }
        });
    }
</script>    