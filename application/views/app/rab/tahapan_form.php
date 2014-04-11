<div id="dlgth" class="easyui-dialog" style="width:auto; height:auto; padding: 10px 20px" 
     closed="true" buttons="#dbtnth">
    <form id="fmd" method="post" novalidate>
    <table>
        <input id="iud_th" name="id_usulan_detail" class="easyui-validatebox" required="true"  />
        <input id="id_parent_th" name="id_parent" class="easyui-validatebox" required="true" />
	<tr>
            <td>No Urut</td>
            <td>:</td>
            <td><input name="no_urut" class="easyui-numberspinner" required="true" min="1" max="9" style="width: 70px;" /></td>
	</tr>
	<tr>
            <td>Nama</td>
            <td>:</td>
            <td><input name="nama" class="easyui-validatebox" required="true" maxlength="50" style="width: 350px;"/></td>
	</tr>
    </table>
    </form>
    <div id="dbtnth"> 
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-save" onclick="saveTahapan();">Simpan</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgth').dialog('close');">Batal</a>
    </div>
</div>
<script>
    // TAHAPAN //
    function addTahapan(id){
        $('#dlgth').dialog({ 
            title: 'Add - Tahapan',
            closed:false,cache:false,modal:true, 
            width:550,height:250 
        });
        $('#fmd').form('clear');
        document.getElementById('id_parent_th').value = 0;
        document.getElementById('iud_th').value = id;
        url = '<?php echo site_url('app/rab/createTahapan'); ?>/'+id;		
    }
    
    function addSubTahapan(iud,idp){
        $('#fmd').form('clear');
        document.getElementById('id_parent_th').value = idp;
        document.getElementById('iud_th').value = iud;
        $('#dlgth').dialog({ 
            title: 'Add - Sub Tahapan',
            closed: false, cache: false, modal: true, 
            width:550,height:200
        });
        url = '<?php echo site_url('app/rab/createTahapan'); ?>/'+iud;		
    }
    
    function editTahapan(id){
        var tg = $('#tg');
        var opts = tg.treegrid('options');
        var row = tg.treegrid('find', id);
        $('#fmd').form('load',row);
        $('#dialog-tahapan').dialog({ 
            title: 'Edit - Tahapan',
            closed: false, cache: false, modal: true, 
            width: $('#div-reg-center').width() * (40/100), 
            height: 200 
        });
        url = '<?php echo site_url('app/rab/updateTahapan'); ?>/'+id;
    }
    
    function delTahapan(id){
        var tg = $('#tg');
        var opts = tg.treegrid('options');
        var row = tg.treegrid('find', id);
        if (row){
            $.messager.confirm('Confirm','You are about to delete a record. This cannot be undone. Are you sure?',function(r){
                if (r){
                    $.messager.progress({title:'Delete Progress',text:'Delete..',interval:5});
                    $.post('<?php echo site_url('app/rab/deleteTahapan'); ?>',{id:row.id,iud:row.id_usulan_detail},function(result){
                        if (result.success){
                            $('#tg').treegrid('reload');
                            $.messager.progress('close');
                        } else {
                            $.messager.alert('Error',result.msg,'error');
                            $.messager.progress('close');
                        }
                    },'json');
                }
            });
        }
    }
    
    function saveTahapan(){
        $.messager.progress({title:'Save Progress',text:'Save..',interval:5});
        $('#fmd').form('submit',{
            url: url,
            onSubmit: function(){ return $(this).form('validate'); },
            success: function(result){
                var result = eval('('+result+')');
                if(result.success){
                    $.messager.progress('close');
                    $('#dlgth').dialog('close');
                    $('#tg').treegrid('reload');
                } else {
                    $.messager.progress('close');
                    $.messager.alert('Error',result.msg,'error');
                }
            }
        });
    }
</script>