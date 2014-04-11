
<div id="dlg-import" class="easyui-dialog" style="width:auto; height:auto; padding: 10px 20px" 
     closed="true">
    <form id="form_import" method="post" action="<?php echo site_url('app/analisa_harga/run_import') ?>" enctype="multipart/form-data" role="form">
    <input type="hidden" id="periode" name="periode">
    <input type="file" id="import_browse" name="analisa_harga" class="easyui-linkbutton" onChange="document.getElementById('periode').value = document.getElementById('id_periode').value;this.form.submit();">
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
                <?php if($jenis == 'Anggaran') { ?>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add2" plain="true" onclick="add();">Add</a>	
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-importe" plain="true" onclick="importdlg();">Import</a>	
                <?php } ?>
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

<!-- Dialog -->
<div id="dlg" class="easyui-dialog" style="width:auto; height:auto; padding: 10px 20px" 
     closed="true" buttons="#dbtn">
    <form id="fm" method="post" novalidate>
    <table style="width: 100%;">
        <input id="ip" name="id_periode" class="easyui-validatebox" required="true" readonly="true">
	<tr>
            <td style="width: 10%;">Kode</td>
            <td>:</td>
            <td><input name="kode" class="easyui-validatebox" required="true" maxlength="10" style="width: 20%;"/></td>
	</tr>
	<tr>
            <td style="width: 10%;vertical-align: top;">Nama</td>
            <td valign="top">:</td>
            <td><textarea name="nama" class="easyui-validatebox" required="true" maxlength="150" style="width: 85%;height: 70px;"></textarea></td>
	</tr>
	<tr>
            <td style="width: 10%;">Satuan</td>
            <td>:</td>
            <td><input name="satuan" class="easyui-validatebox" required="true" maxlength="10" style="width: 20%;"/></td>
	</tr>
    </table>
    </form>
    <div id="dbtn"> 
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-save" onclick="save();">Simpan</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close');">Batal</a>
    </div>
</div>

<!-- Dialog Detail -->
<div id="dlgd" class="easyui-dialog" style="width:auto; height:auto; padding: 10px 20px" 
     closed="true" buttons="#dialog-dbuttons">
    <form id="fmd" method="post" novalidate>
    <table>
        <input id="ia" name="id_analisa" class="easyui-validatebox" required="true" readonly="true">
	<tr>
            <td style="width: 20%;">No Urut</td>
            <td>:</td>
            <td><input name="no_urut" class="easyui-numberspinner" required="true" min="1" max="30" style="width: 50px;" /></td>
	</tr>
        <tr>
            <td style="width: 20%;">Kode</td>
            <td>:</td>
            <td><input id="id_item" name="id_item" required="true" style="width: 300px;" /></td>
	</tr>
	<tr>
            <td style="width: 20%;">Nama</td>
            <td>:</td>
            <td><input id="nd" name="nama" class="easyui-validatebox" readonly="true" style="width: 300px;" /></td>
	</tr>
	<tr>
            <td style="width: 20%;">Satuan</td>
            <td>:</td>
            <td><input id="sd" name="satuan" class="easyui-validatebox" readonly="true" style="width: 100px;"  /></td>
	</tr>
	<?php if($jenis == 'Anggaran') { ?>
	<tr>
            <td style="width: 20%;">Harga Pagu</td>
            <td>:</td>
            <td><input id="pd" name="harga_pagu" class="easyui-numberbox" required="true" precision="2" decimalSeparator="," groupSeparator="." style="text-align:right;width: 150px;" /> </td>
	</tr>
	<?php } else { ?>
	<tr>
            <td style="width: 20%;">Harga OE</td>
            <td>:</td>
            <td><input id="od" name="harga_oe" class="easyui-numberbox" required="true" precision="2" decimalSeparator="," groupSeparator="." style="text-align:right;width: 150px;"/> </td>
	</tr>
	<?php } ?>
	<tr>
            <td style="width: 20%;">Kuantitas</td>
            <td>:</td>
            <td><input name="volume" class="easyui-numberbox" required="true" min="0" precision="5" decimalSeparator="," groupSeparator="." style="text-align:right;width: 150px;" /> ( Decimal : 5 angka di belakang koma )</td>
	</tr>
    </table>
    </form>
    <div id="dialog-dbuttons"> 
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-save" onclick="saveDetail();">Simpan</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgd').dialog('close');">Batal</a>
    </div>
</div>

</section_easyui>

<script type="text/javascript">
    var url;
    var jenis = '<?php echo $jenis; ?>';
    var i;
    var p = document.getElementById('id_periode').value;
	
    $(function (){
         $('#datagrid').datagrid({ 
            width: 'auto', height: $(window).height() * (68/100),
            title: 'Analisa Harga '+jenis, rownumbers:true, singleSelect:true, fitColumns:true, toolbar:'#toolbar', sortable:true,
            url: '<?php echo site_url('app/analisa_harga'); ?>/'+jenis+'?analisa_harga='+p, nowrap:false,
            pagination:true, pageSize:10, pageList:[10,20,50,100],
            columns:[[
                {field:'kode',title:'Kode',width:30,sortable:true},
                {field:'action',title:'Action',width:40,align:'center',
                    formatter:function(value,row,index){
                        var strReturn = '';
                        if(jenis == 'Anggaran'){
                            strReturn += 
                            '<div style="text-align:center;">'+
                            '<a href="javascript:void(0)" class="icon-plus-sign" onclick="addDetail(\''+index+'\');" title="Add Komponen"></a>'+
                            '&nbsp;&nbsp;&nbsp;'+
                            '<a href="javascript:void(0)" class="icon-editb" onclick="edit(\''+index+'\');" title="Edit"></a>'+
                            '&nbsp;&nbsp;&nbsp;'+
                            '<a href="javascript:void(0)" class="icon-trashb" onclick="del(\''+index+'\')" title="Delete"></a>'+
                            '</div>';
                            return strReturn;
                        }else{
                            strReturn += 
                            '<div style="text-align:center;">'+
                            '<a href="javascript:void(0)" class="icon-editb" onclick="edit(\''+index+'\');" title="Edit"></a>'+
                            '</div>';
                            return strReturn;
                        }
                    }
                },
                {field:'nama',title:'Nama',width:150,sortable:true},
                {field:'satuan',title:'Satuan',width:25,align:'center',sortable:true},
                {field:'harga_pagu',title:'Harga Pagu',width:55,align:'right',sortable:true},
                {field:'harga_oe',title:'Harga OE',width:55,align:'right',sortable:true}
            ]],
            view: detailview,
            detailFormatter:function(index,row){
                return '<div style="padding:2px"><table id="ddatagrid-'+index+'"></table></div>';
            },
            onExpandRow:function(index,row){
                $('#ddatagrid-'+index).treegrid({
                    url: '<?php echo site_url('app/analisa_harga'); ?>/'+jenis+'?analisa_harga_detail='+row.id,
                    fitColumns:true, singleSelect:true, nowrap:false, sortable:false,
                    idField:'id', treeField:'nama',
                    loadMsg:'Please Wait', height:'auto',
                    columns:[[
                        {field:'no_urut',title:'No.',width:20,sortable:false},
                        {field:'nama',title:'Nama',width:150,sortable:false},
                        {field:'action',title:'Action',width:50,align:'center',
                            formatter:function(value2,row2,index2){
                                var strReturn = '';
                                if(jenis == 'Anggaran' && row2.nama != '' && row2.kode != null){									
                                    strReturn += 
                                    '<div style="text-align:center;"><a href="javascript:void(0)" class="icon-editb" onclick="editDetail(\''+row2.id+'\',\''+index+'\');" title="Edit"></a>'+
                                    '&nbsp;&nbsp;&nbsp;'+
                                    '<a href="javascript:void(0)" class="icon-trashb" onclick="delDetail(\''+row2.id+'\',\''+index+'\')" title="Delete"></a></div>';
                                    return strReturn;
                                }else if (jenis == 'Aktual' && row2.nama != '' && row2.kode != null){
                                    strReturn += '<div style="text-align:center;"><a href="javascript:void(0)" class="icon-editb" onclick="editDetail(\''+index2+'\',\''+index+'\');" title="Edit"></a></div>';
                                    return strReturn;
                                }else{
                                    return strReturn;
                                }
                            }
                        },
                        {field:'kode',title:'Kode',width:70,sortable:false,align:'center'},
                        {field:'satuan',title:'Satuan',width:70,sortable:false,align:'center'},
                        {field:'volume',title:'Volume',width:75,align:'right',sortable:false},
                        {field:'harga_pagu',title:'Harga Pagu',width:100,align:'right',sortable:false},
                        {field:'total_harga_pagu',title:'Total Harga Pagu',width:100,align:'right',sortable:false},
                        {field:'harga_oe',title:'Harga OE',width:100,align:'right',sortable:false},
                        {field:'total_harga_oe',title:'Total Harga OE',width:100,align:'right',sortable:false}
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
        
        $('#id_item').combogrid({
            panelWidth: 500, panelHeight: 250,
            url:'<?php echo site_url('app/analisa_harga/anggaran'); ?>?item=true&idp='+p,
            idField:'id',textField:'kode',
            mode:'remote',fitColumns:false,sortable:true,nowrap:false,
            pagination:true, pageSize:5, pageList:[5,10,15,20],
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
		
    });
    
    function doSearch(value,name){
        $('#datagrid').datagrid('load', {
            filter : $('#sb').searchbox('getName')+'|'+$('#sb').searchbox('getValue')
        });
    }

    function importdlg(){
        $('#dlg-import').dialog({
            title: 'Import Analisa Harga',
            closed: false, cache: false, modal: true, 
            width: $('#div-reg-center').width() * (30/100), 
            height: $(window).height() * (25/100) 
        });
    }
    
    function add(){
        $('#dlg').dialog({ 
            title:'Add - Analisa Harga',
            closed:false,cache:false,modal:true, 
            width: 500,height:260
        });
        $('#fm').form('clear');
        document.getElementById('ip').value = $('#id_periode').combobox('getValue');
        url = '<?php echo site_url('app/analisa_harga/create'); ?>?id_periode='+$('#id_periode').combobox('getValue');
    }

    function edit(id){
        $('#datagrid').datagrid('selectRow',id);
        var row = $('#datagrid').datagrid('getSelected');
        $('#fm').form('load',row);
        $('#dlg').dialog({ 
            title:'Edit - Analisa Harga : '+row.kode,
            closed:false,cache:false,modal:true, 
            width:500,height:260 
        });
        url = '<?php echo site_url('app/analisa_harga/update'); ?>/'+row.id;
    }
	
    function del(id){
        $('#datagrid').datagrid('selectRow',id);
        var row = $('#datagrid').datagrid('getSelected');
        if (row){
            $.messager.confirm('Confirm','You are about to delete a record. This cannot be undone. Are you sure?',function(r){
                if (r){
                    $.messager.progress({title:'Delete Progress',text:'Delete..',interval:5});
                    $.post('<?php echo site_url('app/analisa_harga/delete'); ?>',{id:row.id},function(result){
                        if (result.success){
                            $('#datagrid').datagrid('reload');
                            $.messager.progress('close');
                        } else {
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
                }
            }
        });
    }
	
    // -- DETAIL -- //
	
    function addDetail(id){
        $('#datagrid').datagrid('selectRow',id);
        var row = $('#datagrid').datagrid('getSelected');
        $('#dlgd').dialog({ 
            title:'Add - Komponen Analisa Harga : '+row.kode,
            closed:false,cache:false,modal:true,
            width: 600,height:320 
        });
        $('#fmd').form('clear');
        document.getElementById('ia').value = row.id;
        url = '<?php echo site_url('app/analisa_harga/createDetail'); ?>';
    }

    function editDetail(id2,id){
        $('#datagrid').datagrid('selectRow',id);
        var tg = $('#ddatagrid-'+id);
        var opts = tg.treegrid('options');
        var row = tg.treegrid('find', id2);
        $('#id_item').combogrid('grid').datagrid('load', { q: row.kode });
        $('#fmd').form('load',row);
        $('#dlgd').dialog({ 
            title:'Edit - Detail Analisa Harga',
            closed:false,cache:false,modal:true,
            width: 600,height:320 
        });
        url = '<?php echo site_url('app/analisa_harga/updateDetail'); ?>/'+row.id;
    }
	
    function delDetail(id2,id){
        $('#datagrid').datagrid('selectRow',id);
        var tg = $('#ddatagrid-'+id);
        var opts = tg.treegrid('options');
        var row = tg.treegrid('find', id2);
        if (row){
            $.messager.confirm('Confirm','You are about to delete a record. This cannot be undone. Are you sure?',function(r){
                if (r){
                    $.messager.progress({title:'Delete Progress',text:'Delete..',interval:5});
                    $.post('<?php echo site_url('app/analisa_harga/deleteDetail'); ?>',{id:row.id},function(result){
                        if (result.success){
                            $.messager.progress('close');
                            $('#ddatagrid-'+id).treegrid('reload');
                        } else {
                            $.messager.progress('close');
                        }
                    },'json');
                }
            });
        }else{
            $.messager.alert({ title: 'Warning', timeout: 1000, msg: 'Select one row..', style:{ right:'center', top:'center' } });
        }
    }
	
    function saveDetail(){
        $.messager.progress({title:'Save Progress',text:'Save..',interval:5});
        $('#fmd').form('submit',{
            url: url,
            onSubmit: function(){ return $(this).form('validate'); },
            success: function(result){
                var result = eval('('+result+')');
                if(result.success){
                    $.messager.progress('close');
                    $('#dlgd').dialog('close');
                    $('#datagrid').datagrid('reload');
                } else {
                    $.messager.progress('close');
                }
            }
        });
    }
    
</script>