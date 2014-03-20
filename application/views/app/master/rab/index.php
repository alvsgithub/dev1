<form style='margin-left: 10px; margin-top: 10px; margin-bottom: -5px;' id="form_import" method="post" action="<?php echo site_url('app/rab/run_import') ?>" enctype="multipart/form-data" role="form">
    <input type="hidden" id="periode" name="periode">
    <input type="file" id="import_browse" name="rab" class="easyui-linkbutton" onChange="document.getElementById('periode').value = document.getElementById('id_periode').value;this.form.submit();">
</form>

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
				
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add2" plain="true" onclick="add();">Add</a>
				
			</td>
			<td style="text-align:right;padding-right:2px;padding-top: 3px;">
				<input id="sb" class="easyui-searchbox" 
					   data-options="prompt:'Please Input filter',menu:'#mfiltergrid',searcher:doSearch" 
					   style="width:300px;float:right;padding-top: 50px;">
				<div id="mfiltergrid" style="width:170px;">
					<div data-options="name:'a.kode'">Kode</div>
					<div data-options="name:'a.nama'">Nama</div>
					<div data-options="name:'a.lokasi'">Lokasi</div>
				</div>
			</td>
        </tr>
    </table>
</div>
<table id="datagrid"></table>

<!-- Dialog Form -->
<div id="dialog-form" class="easyui-dialog" style="width:auto; height:auto; padding: 10px 20px" 
     closed="true" buttons="#dialog-buttons">
    <form id="fm" method="post" novalidate>
    <table>
	<tr>
            <td>Kode</td>
			<td>:</td>
            <td><input name="kode" class="easyui-validatebox" required="true" size="13" maxlength="10" /></td>
	</tr>
	<tr>
            <td>Nama</td>
			<td>:</td>
            <td><input name="nama" class="easyui-validatebox" required="true" size="13" maxlength="20" /></td>
	</tr>
	<tr>
            <td>Lokasi</td>
			<td>:</td>
            <td><input name="lokasi" class="easyui-validatebox" required="true" size="13" maxlength="15" /></td>
	</tr>
    </table>
    </form>
</div>
<div id="dialog-buttons"> 
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-save" onclick="save();">Simpan</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dialog-form').dialog('close');">Batal</a>
</div>
</section_easyui>

<script type="text/javascript">
    var url;
    var jenis = '<?php echo $jenis; ?>';
	var i;
	var p = document.getElementById('id_periode').value;
	
	$(function (){
		$('#datagrid').datagrid({
			width: 'auto', height: 'auto',
			title: jenis, rownumbers:true, singleSelect:true, fitColumns:true, toolbar:'#toolbar', sortable:true,
			url: '<?php echo site_url('app/rab'); ?>/index?rab='+p, nowrap:false,
			pagination:true, pageSize:10, pageList:[10,20,50,100],
			columns:[[
				{field:'kode',title:'Kode',width:80,sortable:true,
					formatter:function(value,row,index){
						var strReturn = value;
						if(jenis == 'Rab'){
							strReturn += 
							'<div style="float:right;">'+
							'<a href="javascript:void(0)" class="icon-add2" onclick="addDetail('+row.kode+');" title="Add Komponen"></a>'+
							'&nbsp;&nbsp;&nbsp;'+
							'<a href="javascript:void(0)" class="icon-edit2" onclick="edit('+index+');" title="Edit"></a>'+
							'&nbsp;&nbsp;&nbsp;'+
							'<a href="javascript:void(0)" class="icon-trash" onclick="del('+index+')" title="Delete"></a>'+
							'</div>';
							return strReturn;
						}
					}
				},
				{field:'nama',title:'Nama',width:150,sortable:true},
				{field:'lokasi',title:'Lokasi',width:80,align:'center',sortable:true},
				{field:'status',title:'Status',width:100,sortable:true}
			]],
			view: detailview,
			detailFormatter:function(index,row){
				return '<div style="padding:2px"><table id="ddatagrid-'+index+'"></table></div>';
			},
		});
		
		$('#id_periode').combobox({
			onChange:function(newValue,oldValue){
				$('#datagrid').datagrid({
					url: '<?php echo site_url('app/rab'); ?>/index?rab='+newValue
				});
			}
		});
		
	});
	
    function doSearch(value,name){
        $('#datagrid').datagrid('load', {
            filter : $('#sb').searchbox('getName')+'|'+$('#sb').searchbox('getValue')
        });
    }
    
    function add(){
        $('#dialog-form').dialog({ closed: false, cache: false, modal: true, width: $('#div-reg-center').width() * (60/100), height: $(window).height() * (70/100) }).dialog('setTitle','Add - RAB');
        $('#fm').form('clear');
        url = '<?php echo site_url('app/rab/create'); ?>?id_periode='+$('#id_periode').combobox('getValue');
    }

    function edit(id){
		$('#datagrid').datagrid('selectRow',id);
		var row = $('#datagrid').datagrid('getSelected');
		$('#fm').form('load',row);
		$('#dialog-form').dialog({ closed: false, cache: false, modal: true, width: $('#div-reg-center').width() * (60/100), height: $(window).height() * (70/100) }).dialog('setTitle','Edit - RAB');
		url = '<?php echo site_url('app/rab/update'); ?>/'+row.kode;
    }
	
	function del(id){
		$('#datagrid').datagrid('selectRow',id);
        var row = $('#datagrid').datagrid('getSelected');
        if (row){
            $.messager.confirm('Confirm','You are about to delete a record. This cannot be undone. Are you sure?',function(r){
                if (r){
                    $.post('<?php echo site_url('app/rab/delete'); ?>',{id:row.kode},function(result){
                        if (result.success){
                            $('#datagrid').datagrid('reload');
                            $.messager.show({ title: 'Info', timeout: 1000, msg: 'Success', style:{ right:'center', top:'center' } });
                        } else {
                            $.messager.alert({ title: 'Error', msg: result.msg });
                        }
                    },'json');
                }
            });
        }else{
            $.messager.alert({ title: 'Warning', timeout: 1000, msg: 'Select one row..', style:{ right:'center', top:'center' } });
        }
    }
	
    function save(){
        $('#fm').form('submit',{
            url: url,
            onSubmit: function(){ return $(this).form('validate'); },
            success: function(result){
                var result = eval('('+result+')');
                if(result.success){
                    $('#dialog-form').dialog('close');
                    $('#datagrid').datagrid('reload');
                    $.messager.show({
                        title: 'Info', timeout: 1000, msg: 'Success', 
                        style:{ right:'center', top:'center' } 
                    });
                } else {
                    $.messager.alert({ title: 'Error', msg: result.msg });
                }
            }
        });
    }
		
</script>
