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
            <td valign="top">Nama</td>
            <td valign="top">:</td>
            <td><textarea name="nama" class="easyui-validatebox" required="true" maxlength="255" style="width:400px; height:80px;"></textarea></td>
	</tr>
	<tr>
            <td valign="top">Lokasi</td>
            <td valign="top">:</td>
            <td><textarea name="lokasi" class="easyui-validatebox" required="true" maxlength="255" style="width:350px; height:50px;"></textarea></td>
	</tr>
    </table>
    </form>
</div>
<div id="dialog-buttons"> 
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-save" onclick="save();">Simpan</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dialog-form').dialog('close');">Batal</a>
</div>
</section_easyui>


<!-- Dialog VERSI RAB -->
<div id="dialog-dform" class="easyui-dialog" style="width:auto; height:auto; padding: 10px 10px" 
     closed="true" buttons="#dialog-dbuttons">
    <div style="background: #ffffff;">
        <div class="easyui-tabs" style="width:auto;height:auto;border:1px solid black;">
            <div title="Rincian" style="padding:10px">
                <div id="mm" class="easyui-menu" style="width:150px;"></div>
                <table id="tg" style="width: auto;height:auto;"></table>
            </div>
            <div title="Dokumen" style="padding:10px">
                    Upload Document.
            </div>
        </div>
    </div>
</div>

<!-- Dialog RAB Tahapan Form -->
<div id="dialog-tahapan" class="easyui-dialog" style="width:auto; height:auto; padding: 10px 20px" 
     closed="true" buttons="#tahapan-dlg-buttons">
    <form id="fmd" method="post" novalidate>
    <table>
        <input name="id_parent" class="easyui-validatebox" required="true" type="hidden"/>
	<tr>
            <td>No Urut</td>
            <td>:</td>
            <td><input name="no_urut" class="easyui-numberbox" precision="0" min="1" max="50" size="13" /></td>
	</tr>
	<tr>
            <td>Nama</td>
            <td>:</td>
            <td><input name="nama" class="easyui-validatebox" size="13" maxlength="50" /></td>
	</tr>
    </table>
    </form>
    <div id="tahapan-dlg-buttons"> 
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-save" onclick="saveTahapan();">Simpan</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dialog-tahapan').dialog('close');">Batal</a>
    </div>
</div>

<!-- Dialog Analisa/Item Tahapan Form -->
<div id="dialog-aitahapan" class="easyui-dialog" style="width:auto; height:auto; padding: 10px 20px" 
     closed="true" buttons="#aitahapan-dlg-buttons">
    <form id="fmai" method="post" novalidate>
    <table>
	<tr>
            <td>No Urut</td>
            <td>:</td>
            <td><input name="no_urut" class="easyui-numberbox" precision="0" min="1" max="50" size="13" /></td>
	</tr>
	<tr>
            <td>Analisa / Item</td>
            <td>:</td>
            <td><input id="ai" name="ai" size="50"/></td>
	</tr>
    </table>
    </form>
    <div id="aitahapan-dlg-buttons"> 
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-save" onclick="saveAITahapan();">Simpan</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dialog-aitahapan').dialog('close');">Batal</a>
    </div>
</div>

<script type="text/javascript">
    var url;
    var i;
    var p = document.getElementById('id_periode').value;
    var currentMousePos = { x: -1, y: -1 };  
    var cmenu;
	
    $(function (){
        $(document).mousemove(function(event) {
            currentMousePos.x = event.pageX;
            currentMousePos.y = event.pageY;
        });
		
        $('#datagrid').datagrid({
            width: 'auto', height: $(window).height() * (62/100),
            title: 'Usulan RAB', rownumbers:true, singleSelect:true, fitColumns:true, toolbar:'#toolbar', sortable:true,
            url: '<?php echo site_url('app/rab'); ?>/index?rab='+p, nowrap:false,
            pagination:true, pageSize:10, pageList:[10,20,50,100],
            columns:[[
                {field:'kode',title:'Kode',width:50,sortable:true,align:'center'},
                {field:'menu',title:'',width:40,align:'center',
                    formatter:function(value,row,index){
                        var strReturn = '';
                        strReturn += 
                        '<div style="text-align:center;">'+
                        '<a href="javascript:void(0)" class="icon-edit2" onclick="edit('+index+');" title="Edit"></a>'+
                        '&nbsp;&nbsp;&nbsp;'+
                        '<a href="javascript:void(0)" class="icon-trash" onclick="del('+index+')" title="Delete"></a>'+
                        '</div>';
                        return strReturn;
                    }
                },
                {field:'nama',title:'Nama',width:150,sortable:true},
                {field:'lokasi',title:'Lokasi',width:80,align:'center',sortable:true},
                {field:'status',title:'Status',width:55,sortable:true}
            ]],
            view: detailview,
            detailFormatter:function(index,row){
                return '<div style="padding:2px"><table id="ddatagrid-'+index+'"></table></div>';
            },
            onExpandRow: function(index,row){
                $('#ddatagrid-'+index).datagrid({
                    url: '<?php echo site_url('app/rab'); ?>?rab_detail='+row.kode,
                    fitColumns:false, singleSelect:true, nowrap:false, sortable:true,
                    pagination:true, pageSize:5, pageList:[5,10, 20, 50],
                    loadMsg:'Please Wait', height:'auto',
                    columns:[[
                        {field:'versi',title:'Versi',width:50,sortable:true,align:'center'},
                        {field:'menu',title:'',width:70,align:'center',
                            formatter:function(value2,row2,index2){
                                var strReturn = '';					
                                strReturn += 
                                '<div style="text-align:center;"><a href="javascript:void(0)" class="icon-edit2" onclick="editDetail('+index2+","+index+');" title="Edit"></a>'+
                                '&nbsp;&nbsp;&nbsp;'+
                                '<a href="javascript:void(0)" class="icon-trash" onclick="delDetail('+index2+","+index+')" title="Delete"></a></div>';
                                return strReturn;                                    
                            }
                        },
                        {field:'created_time',title:'Waktu Pembuatan',width:150,sortable:true,align:'center'},
                        {field:'modified_time',title:'Waktu Perubahan',width:150,sortable:true,align:'center'}
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
	
    // -- DETAIL -- //
    function addDetail(id){
        $('#dialog-dform').dialog({ closed: false, cache: false, modal: true, width: $('#div-reg-center').width() * (60/100), height: $(window).height() * (70/100) }).dialog('setTitle','Add - Komponen Analisa Harga');
        $('#fmd').form('clear');
        url = '<?php echo site_url('app/analisa_harga/createDetail'); ?>/'+id;
    }

    function editDetail(id2,id){
        $('#datagrid').datagrid('selectRow',id);
        $('#ddatagrid-'+id).datagrid('selectRow',id2);
        var row = $('#ddatagrid-'+id).datagrid('getSelected');
        $('#tg').treegrid({
            width: 'auto', height: $(window).height() * (70/100),
            idField: 'id', treeField: 'nama',
            rownumbers:false, singleSelect:true, fitColumns:true, sortable:true,
            url: '<?php echo site_url('app/rab'); ?>/index?tahapan='+row.id, nowrap:false,
            onBeforeLoad: function(row,param){
                if (!row) { // load top level rows
                    param.id = 0; // set id=0, indicate to load new page rows
                }
            },
            columns:[[
                {field:'no_urut',title:'No.',width:50,sortable:true,align:'center'},
                {field:'nama',title:'Uraian',width:220,sortable:true},
                {field:'menu',title:'Action',width:80,align:'center',
                    formatter:function(value,row,index){
                        var strReturn = value;					
                        strReturn += 
                        '<div>'+
                        '<a href="javascript:void(0)" class="icon-edit2" onclick="editTahapan('+row.id+');" title="Edit"></a>'+
                        '&nbsp;&nbsp;&nbsp;'+
                        '<a href="javascript:void(0)" class="icon-trash" onclick="delTahapan('+row.id+');" title="Delete"></a>'+
                        '&nbsp;&nbsp;&nbsp;';
                        if(row.kode === null){
                            strReturn += 
                            '<a href="javascript:void(0)" class="icon-add2" onclick="addSubTahapan('+row.id_usulan_detail+","+row.id+');" title="Add Sub Tahapan"></a>'+
                            '&nbsp;&nbsp;&nbsp;'+
                            '<a href="javascript:void(0)" class="icon-mini-add" onclick="addDetail()" title="Add Analisa / Item"></a>';
                        }
                        strReturn += '</div>';
                        return strReturn;                                    
                    }
                },
                {field:'kode',title:'Kode',width:80,sortable:true},
                {field:'satuan',title:'Satuan',width:70,align:'center',sortable:true},
                {field:'volume',title:'Volume',width:60,sortable:true,align:'center'},
                {field:'harga_pagu',title:'Harga Pagu',width:100,sortable:true,align:'right'},
                {field:'harga_oe',title:'Harga OE',width:100,sortable:true,align:'right'}
            ]],
            toolbar: [{
                iconCls: 'icon-add2', text: 'Add Tahapan',
                handler: function(){ addTahapan(row.id); }
            }]
        });
        
        $('#dialog-dform').dialog({ 
            title: row.kode_usulan+' / Versi '+row.versi, 
            closed: false, cache: false, modal: true, 
            width: $(window).width() * (90/100), 
            height: $(window).height() * (85/100)
        });
        url = '<?php echo site_url('app/analisa_harga/updateDetail'); ?>/'+row.id;
    }
	
    // TAHAPAN //
    function addTahapan(id){
        $('#dialog-tahapan').dialog({ 
            title: 'Add - Tahapan',
            closed: false, cache: false, modal: true, 
            width: $('#div-reg-center').width() * (60/100), 
            height: $(window).height() * (70/100) 
        });
        $('#fmd').form('clear');
        document.getElementsByName('id_parent')[0].value = 0;
        url = '<?php echo site_url('app/rab/createTahapan'); ?>/'+id;		
    }
    
    function addSubTahapan(idud,idp){
        $('#dialog-tahapan').dialog({ 
            title: 'Add - Sub Tahapan',
            closed: false, cache: false, modal: true, 
            width: $('#div-reg-center').width() * (60/100), 
            height: $(window).height() * (70/100) 
        });
        $('#fmd').form('clear');
        document.getElementsByName('id_parent')[0].value = idp;
        url = '<?php echo site_url('app/rab/createTahapan'); ?>/'+idud;		
    }
    
    function addAnalisaItem(idud,idp){
        $('#dialog-tahapan').dialog({ 
            title: 'Add - Sub Tahapan',
            closed: false, cache: false, modal: true, 
            width: $('#div-reg-center').width() * (60/100), 
            height: $(window).height() * (70/100) 
        });
        $('#fmd').form('clear');
        document.getElementsByName('id_parent')[0].value = idp;
        url = '<?php echo site_url('app/rab/createTahapan'); ?>/'+idud;		
    }
    
    function editTahapan(id){
        var tg = $('#tg');
        var opts = tg.treegrid('options');
        var row = tg.treegrid('find', id);
        $('#dialog-tahapan').dialog({ 
            title: 'Edit - Tahapan',
            closed: false, cache: false, modal: true, 
            width: $('#div-reg-center').width() * (60/100), 
            height: $(window).height() * (70/100) 
        });
        document.getElementsByName('id_parent')[0].value = 0;
        $('#fmd').form('load',row);
        url = '<?php echo site_url('app/rab/editTahapan'); ?>/'+id;
    }
	
    function delTahapan(id){
        var tg = $('#tg');
        var opts = tg.treegrid('options');
        var row = tg.treegrid('find', id);
        if (row){
            $.messager.confirm('Confirm','You are about to delete a record. This cannot be undone. Are you sure?',function(r){
                if (r){
                    $.post('<?php echo site_url('app/rab/deleteTahapan'); ?>',{id:row.id},function(result){
                        if (result.success){
                            $('#tg').treegrid('reload');
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
    
    function saveTahapan(){
        $('#fmd').form('submit',{
            url: url,
            onSubmit: function(){ return $(this).form('validate'); },
            success: function(result){
                var result = eval('('+result+')');
                if(result.success){
                    $('#dialog-tahapan').dialog('close');
                    $('#tg').treegrid('reload');
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
    
    function showMenu(id){
        $('#mm').html('');
        $('#mm').menu('appendItem', { text: 'Edit Tahapan', iconCls: 'icon-th-list', onclick: function(){ editTahapan(); } });
        $('#mm').menu('appendItem', { text: 'Delete Tahapan', iconCls: 'icon-edit2', onclick: function(){ delTahapan(id); } });
        $('#mm').menu('appendItem', { text: 'Add Sub Tahapan', iconCls: 'icon-edi2', onclick: function(){ addSubTahapan(); } });
        $('#mm').menu('appendItem', { text: 'Add Analisa / Item', iconCls: 'icon-edi2', onclick: function(){ addKomponen(); } });
        $('#mm').menu('show', { left: currentMousePos.x, top: currentMousePos.y });
    }
    
    function vAnalisaItem(){
        $('#ai').combogrid({
            panelWidth: 500, panelHeight: 310,
            url:'<?php echo site_url('app/rab'); ?>?ai=true',
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
            ]]/*,
            onClickRow:function(index, row){
                document.getElementById('nd').value = row.nama;
                document.getElementById('sd').value = row.satuan;
                $('#pd').numberbox('setValue', row.harga_pagu);
                $('#od').numberbox('setValue', row.harga_oe);
            }*/
        });
    }
</script>
