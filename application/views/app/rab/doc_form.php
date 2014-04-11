<div id="dialog-dokumen-usulan" class="easyui-dialog" style="width:auto; height:auto; padding: 10px 20px" 
     closed="true" buttons="#tahapan-dlg-buttons">
    <form id="fmdoc" method="post" enctype="multipart/form-data" novalidate>
    <table>
        <input type="hidden" name="id_usulan_detail" id="id_usulan_detail"/>
        <tr>
            <td>Keterangan</td>
            <td>:</td>
            <td><input name="keterangan" id="ket_dokumen" class="easyui-validatebox" required="true" size="13" /></td>
        </tr>
        <tr>
            <td>File</td>
            <td>:</td>
            <td><input type="file" name="file" class="easyui-validatebox"/></td>
        </tr>
    </table>
    </form>
    <div id="tahapan-dlg-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-save" onclick="saveDokumen();">Simpan</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dialog-dokumen-usulan').dialog('close');">Batal</a>
    </div>
</div>

<script>
/*-- Upload Dokumen Usulan Dialog--*/
    function addDokumen(id){
        document.getElementById("id_usulan_detail").value = id;
        $('#dialog-dokumen-usulan').dialog({
            title: 'Upload - Dokumen Usulan',
            closed: false, cache: false, modal: true,
            width: $('#div-reg-center').width() * (40/100),
            height: $(window).height() * (40/100)
        });
        url = '<?php echo site_url('app/dokumen_usulan/create'); ?>';
    }

    function edit_dokumen_usulan(id)
    {
        $('#dokumen_usulan').datagrid('selectRow', id);
        var row = $('#dokumen_usulan').datagrid('getSelected');
        $("#fmdoc").form("load", row);
        $('#dialog-dokumen-usulan').dialog({
            title: 'Upload - Dokumen Usulan',
            closed: false, cache: false, modal: true,
            width: $('#div-reg-center').width() * (40/100),
            height: $(window).height() * (40/100)
        });
        url = '<?php echo site_url('app/dokumen_usulan/update'); ?>/'+row.id;
    }

    function del_dokumen_usulan(id)
    {
        $('#dokumen_usulan').datagrid('selectRow',id);
        var row = $('#dokumen_usulan').datagrid('getSelected');
        if (row){
            $.messager.confirm('Confirm','You are about to delete a record. This cannot be undone. Are you sure?',function(r){
                if (r){
                    $.messager.progress({title:'Delete Progress',text:'Delete..',interval:5});
                    $.post('<?php echo site_url('app/dokumen_usulan/delete'); ?>',{id:row.id},function(result){
                        if (result.success){
                            $('#dokumen_usulan').datagrid('reload');
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

    function down_dokumen_usulan(id)
    {
        $('#dokumen_usulan').datagrid('selectRow',id);
        var row = $('#dokumen_usulan').datagrid('getSelected');
        window.location = '../asset/file/' + row.link;
    }

    function saveDokumen(){
        $.messager.progress({title:'Save Progress',text:'Save..',interval:5});
        $('#fmdoc').form('submit',{
            url: url,
            onSubmit: function(){ return $(this).form('validate'); },
            success: function(result){
                var result = eval('('+result+')');
                if(result.success){
                    $('#dialog-dokumen-usulan').dialog('close');
                    $('#dokumen_usulan').datagrid('reload');
                    $.messager.progress('close');
                } else {
                    $.messager.progress('close');
                    $.messager.alert('Error',result.msg,'error');
                }
            }
        });
    }
</script>