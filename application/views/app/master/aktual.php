
<div id="dlg-import" class="easyui-dialog" style="width:auto; height:auto; padding: 10px 20px" 
     closed="true">
    <form id="form_import" method="post" action="<?php echo site_url('app/aktual/run_import') ?>" enctype="multipart/form-data" role="form">
        <input type="hidden" id="periode" name="periode">
        <input type="file" id="import_browse" name="aktual" class="easyui-linkbutton" onChange="document.getElementById('periode').value = document.getElementById('id_periode').value;this.form.submit();">
    </form>
</div>
<section_easyui>  
    
<div id="toolbar">
    <table cellpadding="0" cellspacing="0" style="width:100%">
        <tr>
            <td style="padding-left:2px">
                Periode (Tahun Semester) : 
                <select id="id_periode" name="id_periode" class="easyui-combobox" style="width: 80px;">
                <?php foreach($options_periode as $periode) { ?>
                        <option value="<?php echo $periode->id; ?>"><?php echo $periode->tahun.'0'.$periode->semester; ?></option>
                <?php } ?>
                </select>
                
                <!--<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add2" plain="true" onclick="add();">Add</a>-->	
                
            </td>
            <td style="text-align:right;padding-right:2px;padding-top: 3px;">
                <input id="sb" class="easyui-searchbox" 
                           data-options="prompt:'Please Input filter',menu:'#mfiltergrid',searcher:doSearch" 
                           style="width:300px;float:right;padding-top: 50px;">
                <div id="mfiltergrid" style="width:170px;">
                    <div data-options="name:'a.kode'">Kode</div>
                    <div data-options="name:'a.nama'">Nama</div>
                    <div data-options="name:'a.satuan'">Satuan</div>
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
        <input id="ip" name="id_periode" class="easyui-validatebox" required="true" readonly="true" type="hidden">
        <input id="jenis" name="jenis" class="easyui-validatebox" required="true" readonly="true" type="hidden">
	<tr>
            <td style="width: 15%;">Kode</td>
            <td>:</td>
            <td><input name="kode" class="easyui-validatebox" required="true" maxlength="10" style="width: 20%;"/></td>
	</tr>
	<tr>
            <td style="width: 15%;">Nama</td>
            <td>:</td>
            <td><input name="nama" class="easyui-validatebox" required="true" maxlength="150" style="width: 85%;"/></td>
	</tr>
	<tr>
            <td style="width: 15%;">Satuan</td>
            <td>:</td>
            <td><input name="satuan" class="easyui-validatebox" required="true" maxlength="10" style="width: 20%;"/></td>
	</tr>
        <tr>
            <td style="width: 15%;">Harga Pagu</td>
            <td>:</td>
            <td><input name="harga_pagu" class="easyui-numberbox" min="0" precision="2" decimalSeparator="," groupSeparator="." required="true" style="width: 40%;text-align:right;" readonly="true"/></td>
	</tr>
        <tr>
            <td style="width: 15%;">Harga OE</td>
            <td>:</td>
            <td><input name="harga_oe" class="easyui-numberbox" min="0" precision="2" decimalSeparator="," groupSeparator="." required="true" style="width: 40%;text-align:right;"/></td>
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
    var jenis = '<?php echo $jenis; ?>';
    var tipe = '<?php echo $tipe; ?>';
    var i;
    var p = document.getElementById('id_periode').value;
	
    $(function (){
         $('#datagrid').datagrid({ 
            width: 'auto', height: $(window).height() * (68/100),
            title: 'Item '+jenis+' - '+tipe, rownumbers:true, singleSelect:true, fitColumns:true, toolbar:'#toolbar', sortable:true,
            url: '<?php echo site_url('app/aktual/index'); ?>/?item='+jenis+'&periode='+p, nowrap:false,
            pagination:true, pageSize:10, pageList:[10,20,50,100],
            columns:[[
                {field:'kode',title:'Kode',width:30,sortable:true},
                {field:'action',title:'Action',width:30,align:'center',
                    formatter:function(value,row,index){
                        var strReturn = '';
                        strReturn += 
                        '<div style="text-align:center;">'+
                        '<a href="javascript:void(0)" class="icon-editb" onclick="edit('+index+');" title="Edit"></a>'+
                        '</div>';
                        return strReturn;
                    }
                },
                {field:'nama',title:'Nama',width:150,sortable:true},
                {field:'satuan',title:'Satuan',width:25,align:'center',sortable:true},
                {field:'harga_pagu',title:'Harga Pagu',width:55,align:'right',sortable:true},
                {field:'harga_oe',title:'Harga OE',width:55,align:'right',sortable:true}
            ]]
        });
    	
        $('#id_periode').combobox({
            onChange:function(newValue,oldValue){
                $('#datagrid').datagrid({
                    url: '<?php echo site_url('app/aktual/index'); ?>/?item='+jenis+'&periode='+newValue
                });
            }
        });
		
    });
    
    function doSearch(value,name){
        $('#datagrid').datagrid('load', {
            filter : $('#sb').searchbox('getName')+'|'+$('#sb').searchbox('getValue')
        });
    }

    function importdlg(){
        $('#dlg-import').dialog({
            title: 'Import Item',
            closed: false, cache: false, modal: true, 
            width: 300, height: 250
        });
    }
    
    function add(){
        $('#dlg').dialog({ 
            title: 'Add - Item '+jenis,
            closed: false, cache: false, modal: true, 
            width: 500, height: 250
        });
        $('#fm').form('clear');
        document.getElementById('ip').value = $('#id_periode').combobox('getValue');
        document.getElementById('jenis').value = jenis;
        url = '<?php echo site_url('app/aktual/create'); ?>';
    }

    function edit(id){
        $('#datagrid').datagrid('selectRow',id);
        var row = $('#datagrid').datagrid('getSelected');
        $('#fm').form('load',row);
        $('#dlg').dialog({ 
            title: 'Edit - Item - '+jenis+' : '+row.kode,
            closed: false, cache: false, modal: true, 
            width: 500, height: 250 
        });
        url = '<?php echo site_url('app/aktual/update'); ?>/'+row.id;
    }
	
    function del(id){
        $('#datagrid').datagrid('selectRow',id);
        var row = $('#datagrid').datagrid('getSelected');
        if (row){
            $.messager.confirm('Confirm','You are about to delete a record. This cannot be undone. Are you sure?',function(r){
                if (r){
                    $.messager.progress({title:'Delete Progress',text:'Delete..',interval:5});
                    $.post('<?php echo site_url('app/aktual/delete'); ?>',{id:row.id},function(result){
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
        }else
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