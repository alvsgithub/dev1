
<section_easyui>  
    
<div id="toolbar">
    <table cellpadding="0" cellspacing="0" style="width:100%">
        <tr>
            <td style="padding-left:2px">
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add2" plain="true" onclick="add();">Add</a>	
            </td>
            <td style="text-align:right;padding-right:2px;padding-top: 3px;">
                <input id="sb" class="easyui-searchbox" 
                           data-options="prompt:'Please Input filter',menu:'#mfiltergrid',searcher:doSearch" 
                           style="width:300px;float:right;padding-top: 50px;">
                <div id="mfiltergrid" style="width:170px;">
                    <div data-options="name:'a.nopeg'">NPP</div>
                    <div data-options="name:'a.nama'">Nama</div>
                    <div data-options="name:'a.jabatan'">Jabatan</div>
                </div>
            </td>
        </tr>
    </table>
</div>
    
<table id="datagrid"></table>

</section_easyui>

<!-- Dialog Form -->
<div id="dlg" class="easyui-dialog" style="width:auto; height:auto; padding: 10px 10px;" 
     closed="true" buttons="#dbtn">
    <form id="fm" method="post" novalidate>
    <table style="width: 100%;">
	<tr>
            <td style="width: 15%;">NPP</td>
            <td>:</td>
            <td><input name="nopeg" class="easyui-validatebox" required="true" maxlength="11" style="width: 20%;"/></td>
	</tr>
	<tr>
            <td style="width: 15%;">Nama</td>
            <td>:</td>
            <td><input name="nama" class="easyui-validatebox" required="true" maxlength="200" style="width: 85%;"/></td>
	</tr>
	<tr>
            <td style="width: 15%;">Jabatan</td>
            <td>:</td>
            <td><input name="jabatan" class="easyui-validatebox" required="true" maxlength="100" style="width: 80%;"/></td>
	</tr>
        <tr>
            <td style="width: 15%;">Kode Bagian</td>
            <td>:</td>
            <td><input id="kdbag" name="kode_bagian" required="true"/></td>
	</tr>
    </table>
    </form>
    <div id="dbtn"> 
        <a id="bsv" href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-save" onclick="save();">Simpan</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close');">Batal</a>
    </div>
</div>


<script type="text/javascript">
    var url;
	
    $(function (){
         $('#datagrid').datagrid({ 
            width: 'auto', height: $(window).height() * (68/100),
            title: 'Pegawai', rownumbers:true, singleSelect:true, fitColumns:true, toolbar:'#toolbar', sortable:true,
            url: '<?php echo site_url('app/pegawai'); ?>?pegawai=true', nowrap:false,
            pagination:true, pageSize:10, pageList:[10,20,50,100],
            columns:[[
                {field:'username',title:'Username',width:50,sortable:true},
                {field:'action',title:'Action',width:40,align:'center',
                    formatter:function(value,row,index){
                        var strReturn = '';
                        strReturn += 
                        '<div style="text-align:center;">'+
                        '<a href="javascript:void(0)" class="icon-editb" onclick="edit('+index+');" title="Edit"></a>'+
                        '&nbsp;&nbsp;&nbsp;'+
                        '<a href="javascript:void(0)" class="icon-trashb" onclick="del('+index+')" title="Delete"></a>'+
                        '</div>';
                        return strReturn;
                    }
                },
                {field:'nopeg',title:'NPP',width:40,sortable:true},
                {field:'nama',title:'Nama',width:125,sortable:true},
                {field:'jabatan',title:'Jabatan',width:100,sortable:true},
                {field:'bagian',title:'Bagian',width:100,sortable:true}
            ]]
        });
		
    });
    
    function doSearch(value,name){
        $('#datagrid').datagrid('load', {
            filter : $('#sb').searchbox('getName')+'|'+$('#sb').searchbox('getValue')
        });
    }

    function importdlg(){
        $('#dlg-import').dialog({
            title: 'Import Pegawai',
            closed: false, cache: false, modal: true, 
            width: 300, height: 250
        });
    }
    
    function add(){
        $('#dlg').dialog({ 
            title: 'Add - Pegawai ',
            closed: false, cache: false, modal: true, 
            width: 600, height: 300
        });
        $('#fm').form('clear');
        url = '<?php echo site_url('app/pegawai/create'); ?>';
    }

    function edit(id){
        $('#datagrid').datagrid('selectRow',id);
        var row = $('#datagrid').datagrid('getSelected');
        $('#fm').form('load',row);
        $('#dlg').dialog({ 
            title: 'Edit - Pegawai : '+row.nama,
            closed: false, cache: false, modal: true, 
            width: 600, height: 300 
        });
        url = '<?php echo site_url('app/pegawai/update'); ?>/'+row.id;
    }
	
    function del(id){
        $('#datagrid').datagrid('selectRow',id);
        var row = $('#datagrid').datagrid('getSelected');
        if (row){
            $.messager.confirm('Confirm','You are about to delete a record. This cannot be undone. Are you sure?',function(r){
                if (r){
                    $.messager.progress({title:'Delete Progress',text:'Delete..',interval:5});
                    $.post('<?php echo site_url('app/pegawai/delete'); ?>',{id:row.id},function(result){
                        if (result.success){
                            $('#datagrid').datagrid('reload');
                            $.messager.progress('close');
                        } else {
                            $.messager.progress('close');
                            $.messager.alert('Error',result.msg,'error');
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