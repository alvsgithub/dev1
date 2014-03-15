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
					<div data-options="name:'a.satuan'">Satuan</div>
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
            <td><input name="nama" class="easyui-validatebox" required="true" size="13" maxlength="10" /></td>
	</tr>
	<tr>
            <td>Satuan</td>
			<td>:</td>
            <td><input name="satuan" class="easyui-validatebox" required="true" size="13" maxlength="15" /></td>
	</tr>
    </table>
    </form>
</div>
<div id="dialog-buttons"> 
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-save" onclick="save();">Simpan</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dialog-form').dialog('close');">Batal</a>
</div>

<!-- Dialog Detail Form -->
<div id="dialog-dform" class="easyui-dialog" style="width:auto; height:auto; padding: 10px 20px" 
     closed="true" buttons="#dialog-dbuttons">
    <form id="fmd" method="post" novalidate>
    <table>
	<tr>
		<td>Kode</td>
		<td>:</td>
		<td><input id="id_item" name="id_item" required="true"style="width: 500px;" /></td>
	</tr>
	<tr>
		<td>Nama</td>
		<td>:</td>
		<td><input id="nd" name="nama" class="easyui-validatebox" readonly="true" size="13" /></td>
	</tr>
	<tr>
		<td>Satuan</td>
		<td>:</td>
		<td><input id="sd" name="satuan" class="easyui-validatebox" readonly="true" size="13" /></td>
	</tr>
	<?php if($jenis == 'Anggaran') { ?>
	<tr>
		<td>Harga Pagu</td>
		<td>:</td>
		<td><input id="pd" name="harga_pagu" class="easyui-numberbox" precision="2" decimalSeparator="." groupSeparator="," size="13" style="text-align:right;" /></td>
	</tr>
	<?php } else { ?>
	<tr>
		<td>Harga OE</td>
		<td>:</td>
		<td><input id="od" name="harga_oe" class="easyui-numberbox" precision="2" decimalSeparator="." groupSeparator="," size="13" style="text-align:right;"/></td>
	</tr>
	<?php } ?>
	<tr>
		<td>Volume</td>
		<td>:</td>
		<td><input name="volume" class="easyui-numberbox" required="true" precision="3" decimalSeparator="." groupSeparator="," min="0" size="13" style="text-align:right;" /></td>
	</tr>
    </table>
    </form>
</div>
<div id="dialog-dbuttons"> 
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-save" onclick="saveDetail();">Simpan</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dialog-dform').dialog('close');">Batal</a>
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
			title: 'Analisa Harga '+jenis, rownumbers:true, singleSelect:true, fitColumns:true, toolbar:'#toolbar', sortable:true,
			url: '<?php echo site_url('app/analisa_harga'); ?>/'+jenis+'?analisa_harga='+p, nowrap:false,
			pagination:true, pageSize:10, pageList:[10,20,50,100],
			columns:[[
				{field:'kode',title:'Kode',width:80,sortable:true,
					formatter:function(value,row,index){
						var strReturn = value;
						if(jenis == 'Anggaran'){
							strReturn += 
							'<div style="float:right;">'+
							'<a href="javascript:void(0)" class="icon-add2" onclick="addDetail('+row.id+');" title="Add Komponen"></a>'+
							'&nbsp;&nbsp;&nbsp;'+
							'<a href="javascript:void(0)" class="icon-edit2" onclick="edit('+index+');" title="Edit"></a>'+
							'&nbsp;&nbsp;&nbsp;'+
							'<a href="javascript:void(0)" class="icon-trash" onclick="del('+index+')" title="Delete"></a>'+
							'</div>';
							return strReturn;
						}else{
							strReturn += 
							'<div style="float:right;">'+
							'<a href="javascript:void(0)" class="icon-edit2" onclick="edit('+index+');" title="Edit"></a>'+
							'</div>';
							return strReturn;
						}
					}
				},
				{field:'nama',title:'Nama',width:150,sortable:true},
				{field:'satuan',title:'Satuan',width:80,align:'center',sortable:true},
				{field:'harga_pagu',title:'Harga Pagu',width:100,align:'right',sortable:true},
				{field:'harga_oe',title:'Harga OE',width:100,align:'right',sortable:true}
			]],
			view: detailview,
			detailFormatter:function(index,row){
				return '<div style="padding:2px"><table id="ddatagrid-'+index+'"></table></div>';
			},
			onExpandRow: function(index,row){
				$('#ddatagrid-'+index).datagrid({
					url: '<?php echo site_url('app/analisa_harga'); ?>/'+jenis+'?analisa_harga_detail='+row.id,
					fitColumns:true, singleSelect:true, nowrap:false, sortable:true,
					pagination:true, pageSize:5, pageList:[5,10, 20, 50],
					loadMsg:'Please Wait', height:'auto',
					columns:[[
						{field:'kode',title:'Kode',width:80, sortable:true,
							formatter:function(value2,row2,index2){
								var strReturn = value2;
								if(jenis == 'Anggaran' && row2.nama != ''){									
									strReturn += 
									'<div style="float:right;"><a href="javascript:void(0)" class="icon-edit2" onclick="editDetail('+index2+","+index+');" title="Edit"></a>'+
									'&nbsp;&nbsp;&nbsp;'+
									'<a href="javascript:void(0)" class="icon-trash" onclick="delDetail('+index2+","+index+')" title="Delete"></a></div>';
									return strReturn;
								}else if (jenis == 'Aktual' && row2.nama != ''){
									strReturn += '<div style="float:right;"><a href="javascript:void(0)" class="icon-edit2" onclick="editDetail('+index2+","+index+');" title="Edit"></a></div>';
									return strReturn;
								}else{
									return strReturn;
								}
							}
						},
						{field:'nama',title:'Nama',width:150,sortable:true},
						{field:'satuan',title:'Satuan',width:70,sortable:true,align:'center'},
						{field:'volume',title:'Volume',width:75,align:'center',sortable:true},
						{field:'harga_pagu',title:'Harga Pagu',width:100,align:'right',sortable:true},
						{field:'total_harga_pagu',title:'Total Harga Pagu',width:100,align:'right',sortable:true},
						{field:'harga_oe',title:'Harga OE',width:100,align:'right',sortable:true},
						{field:'total_harga_oe',title:'Total Harga OE',width:100,align:'right',sortable:true}
					]],
					onResize:function(){
						$('#datagrid').datagrid('fixDetailRowHeight',index);
					},
					onLoadSuccess:function(){
						setTimeout(function(){
							$('#datagrid').datagrid('fixDetailRowHeight',index);
						},0);
					}
				});
				$('#datagrid').datagrid('fixDetailRowHeight',index);
			}
		});
    
		
		
		$('#id_periode').combobox({
			onChange:function(newValue,oldValue){
				$('#datagrid').datagrid({
					url: '<?php echo site_url('app/analisa_harga'); ?>/'+jenis+'?analisa_harga='+newValue
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
        $('#dialog-form').dialog({ closed: false, cache: false, modal: true, width: $('#div-reg-center').width() * (60/100), height: $(window).height() * (70/100) }).dialog('setTitle','Add - Analisa Harga');
        $('#fm').form('clear');
        url = '<?php echo site_url('app/analisa_harga/create'); ?>?id_periode='+$('#id_periode').combobox('getValue');
    }

    function edit(id){
		$('#datagrid').datagrid('selectRow',id);
		var row = $('#datagrid').datagrid('getSelected');
		$('#fm').form('load',row);
		$('#dialog-form').dialog({ closed: false, cache: false, modal: true, width: $('#div-reg-center').width() * (60/100), height: $(window).height() * (70/100) }).dialog('setTitle','Edit - Analisa Harga');
		url = '<?php echo site_url('app/analisa_harga/update'); ?>/'+row.id;
    }
	
	function del(id){
		$('#datagrid').datagrid('selectRow',id);
        var row = $('#datagrid').datagrid('getSelected');
        if (row){
            $.messager.confirm('Confirm','You are about to delete a record. This cannot be undone. Are you sure?',function(r){
                if (r){
                    $.post('<?php echo site_url('app/analisa_harga/delete'); ?>',{id:row.id},function(result){
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
	
	// -- DETAIL -- //
	
	function addDetail(id){
		loadCombogridItem();
        $('#dialog-dform').dialog({ closed: false, cache: false, modal: true, width: $('#div-reg-center').width() * (60/100), height: $(window).height() * (70/100) }).dialog('setTitle','Add - Komponen Analisa Harga');
        $('#fmd').form('clear');
        url = '<?php echo site_url('app/analisa_harga/createDetail'); ?>/'+id;
		
    }

    function editDetail(id2,id){
		loadCombogridItem();
		$('#datagrid').datagrid('selectRow',id);
		$('#ddatagrid-'+id).datagrid('selectRow',id2);
		var row = $('#ddatagrid-'+id).datagrid('getSelected');
		$('#fmd').form('load',row);
		$('#dialog-dform').dialog({ closed: false, cache: false, modal: true, width: $('#div-reg-center').width() * (60/100), height: $(window).height() * (70/100) }).dialog('setTitle','Edit - Komponen Analisa Harga');
		url = '<?php echo site_url('app/analisa_harga/updateDetail'); ?>/'+row.id;
    }
	
	function delDetail(id2,id){
		$('#datagrid').datagrid('selectRow',id);
		$('#ddatagrid-'+id).datagrid('selectRow',id2);
        var row = $('#ddatagrid-'+id).datagrid('getSelected');
        if (row){
            $.messager.confirm('Confirm','You are about to delete a record. This cannot be undone. Are you sure?',function(r){
                if (r){
                    $.post('<?php echo site_url('app/analisa_harga/deleteDetail'); ?>',{id:row.id},function(result){
                        if (result.success){
                            $('#ddatagrid-'+id).datagrid('reload');
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
	
    function saveDetail(){
        $('#fmd').form('submit',{
            url: url,
            onSubmit: function(){ return $(this).form('validate'); },
            success: function(result){
                var result = eval('('+result+')');
                if(result.success){
                    $('#dialog-dform').dialog('close');
					// var selected = $('#datagrid').datagrid('getSelected');
                    // var index = $('#datagrid').datagrid('getRowIndex', selected);
					// var selected2 = $('#ddatagrid-'+index).datagrid('getSelected');
                    // var index2 = $('#ddatagrid-'+index).datagrid('getRowIndex', selected2);
					// $('#datagrid').datagrid('reload', index);
					// $('#ddatagrid-'+index).datagrid('reload', index2);
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
    
	function loadCombogridItem(){
		$('#id_item').combogrid({
			panelWidth: 500, panelHeight: 310,
			url:'<?php echo site_url('app/analisa_harga/anggaran'); ?>?item=true',
			idField:'id',textField:'kode',
			mode:'remote',fitColumns:false,sortable:true,nowrap:false,
			pagination:true, pageSize:'5', pageList:'[5,10,15,20]',
			columns:[[
				{field:'kode',title:'Kode',width:80,sortable:true},
				{field:'nama',title:'Nama',width:150,sortable:true},
				{field:'satuan',title:'Satuan',width:70,sortable:true,align:'center'},
				{field:'harga_pagu',title:'Harga Pagu',width:100,sortable:true,align:'right'},
				{field:'harga_oe',title:'Harga OE',width:100,sortable:true,align:'right'},
				{field:'jenis',title:'Jenis',width:80,sortable:true}
			]],
			onClickRow:function(index, row){
				document.getElementById('nd').value = row.nama;
				document.getElementById('sd').value = row.satuan;
				$('#pd').numberbox('setValue', row.harga_pagu);
				$('#od').numberbox('setValue', row.harga_oe);
			}
		});
	}
	
</script>
