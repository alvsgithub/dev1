<div id="dlg" class="easyui-dialog" style="width:auto; height:auto; padding: 10px 20px" 
     closed="true" buttons="#dlgbtn">
    <form id="fm" method="post" novalidate>
    <table>
        <input id="id_periode_us" name="id_periode" class="easyui-validatebox" required="true" type="hidden"/>
	<tr>
            <td valign="top">Nama</td>
            <td valign="top">:</td>
            <td><textarea name="nama" class="easyui-validatebox" required="true" maxlength="250" style="width:400px; height:80px;"></textarea></td>
	</tr>
	<tr>
            <td valign="top">Lokasi</td>
            <td valign="top">:</td>
            <td><textarea name="lokasi" class="easyui-validatebox" required="true" maxlength="250" style="width:400px; height:80px;"></textarea></td>
	</tr>
    </table>
    </form>
    <div id="dlgbtn"> 
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-save" onclick="save();">Simpan</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close');">Batal</a>
    </div>
</div>
<script>
    function add(){
        $('#dlg').dialog({ 
            title: 'Add - RAB',
            closed: false, cache: false, modal: true, 
            width:550,height:325 
        });
        $('#fm').form('clear');
        document.getElementById('id_periode_us').value = $('#id_periode').combobox('getValue');
        url = '<?php echo site_url('app/rab/create'); ?>';
    }

    function edit(id){
        $('#datagrid').datagrid('selectRow',id);
        var row = $('#datagrid').datagrid('getSelected');
        $('#fm').form('load',row);
        $('#dlg').dialog({ 
            title:'Edit - '+row.kode,
            closed:false,cache:false,modal:true, 
            width:550,height:325 
        });
        url = '<?php echo site_url('app/rab/update'); ?>/'+row.kode;
    }
	
    function del(id){
        $('#datagrid').datagrid('selectRow',id);
        var row = $('#datagrid').datagrid('getSelected');
        if (row){
            $.messager.confirm('Confirm','You are about to delete a record. This cannot be undone. Are you sure?',function(r){
                if (r){
                    $.messager.progress({title:'Delete Progress',text:'Delete..',interval:5});
                    $.post('<?php echo site_url('app/rab/delete'); ?>',{id:row.kode},function(result){
                        if (result.success){
                            $('#datagrid').datagrid('reload');
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
	
    function save(){
        $.messager.progress({title:'Save Progress',text:'Save..',interval:5});
        $('#fm').form('submit',{
            url: url,
            onSubmit: function(){ return $(this).form('validate'); },
            success: function(result){
                var result = eval('('+result+')');
                if(result.success){
                    $.messager.progress('close');
                    $('#dlg').dialog('close');
                    $('#datagrid').datagrid('reload');
                } else {
                    $.messager.progress('close');
                    $.messager.alert('Error',result.msg,'error');
                }
            }
        });
    }
</script>