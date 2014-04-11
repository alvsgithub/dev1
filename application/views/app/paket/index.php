<section_easyui>  
<div id="toolbar">
    <table cellpadding="0" cellspacing="0" style="width:100%">
        <tr>
            <td style="padding-left:2px;">
                Tahun :
                <select id="id_periode" name="id_periode" class="easyui-combobox" style="width: 80px;">
                <?php foreach($options_tahun as $tahun) { ?>
                        <option value="<?php echo $tahun->tahun; ?>"><?php echo $tahun->tahun; ?></option>
                <?php } ?>
                </select>
				
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add2" plain="true" onclick="add();">Add</a>
                <!--<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-importe" plain="true" onclick="importdlg();">Import</a>-->		
            </td>
            <td style="text-align:right;padding-right:2px;padding-top: 3px;">
                <input id="sb" class="easyui-searchbox" 
                           data-options="prompt:'Please Input filter',menu:'#mfiltergrid',searcher:doSearch" 
                           style="width:300px;float:right;padding-top: 50px;">
                <div id="mfiltergrid" style="width:170px;">
                    <div data-options="name:'a.kode'">Kode</div>
                    <div data-options="name:'a.nama'">Nama</div>
                    <div data-options="name:'a.swakelola'">Swakelola</div>
                </div>
            </td>
        </tr>
    </table>
</div>
<table id="datagrid"></table>
</section_easyui>

<!-- Dialog Form -->
<div id="dialog-form" class="easyui-dialog" style="width:auto; height:auto; padding: 10px 20px" 
     closed="true" buttons="#dialog-buttons">
    <form id="fm" method="post" novalidate>
    <table border='0'>
	<tr>
            <td valign='top'>Nama</td>
            <td valign='top' align='center' width='30px'>:</td>
            <td>
            	<input type='text' name="nama" class="easyui-validatebox" required="true" size="13" maxlength="50"/>
            	<br><br>
            </td>
	</tr>
	<tr>
            <td valign='top'>Tahun</td>
            <td valign='top' align='center' width='30px'>:</td>
            <td>
                <select name="tahun" class="easyui-combobox" style="width: 80px;">
                    <?php foreach($options_tahun as $tahun) { ?>
                            <option value="<?php echo $tahun->tahun; ?>"><?php echo $tahun->tahun; ?></option>
                    <?php } ?>
            	</select><br><br>
            </td>
	</tr>
	<tr>
            <td valign='top'>Swakelola</td>
            <td valign='top' align='center' width='30px'>:</td>
            <td>
            	 Ya <input type="radio" name="swakelola" value="Y">
            	 Tidak <input type="radio" name="swakelola" value="T">
            </td>
	</tr>
    </table>
    </form>
    <div id="dialog-buttons"> 
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-save" onclick="save();">Simpan</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dialog-form').dialog('close');">Batal</a>
    </div>
</div>

<!-- Dialog Add Rincian Paket -->
<div id="dialog-rincian" class="easyui-dialog" style="width:auto; height:auto; padding: 5px 5px" 
     closed="true" >
    <div id="tb-rab">
        <table cellpadding="0" cellspacing="0" style="width:100%">
            <tr>
                <td style="text-align:right;padding-right:2px;padding-top: 3px;">
                    <input id="sb" class="easyui-searchbox" 
                               data-options="prompt:'Please Input filter',menu:'#mfiltergrid',searcher:doSearch" 
                               style="width:300px;float:right;padding-top: 50px;">
                    <div id="mfiltergrid" style="width:170px;">
                        <div data-options="name:'a.ck'"></div>
                        <div data-options="name:'a.kode'">Kode</div>
                        <div data-options="name:'a.nama'">Nama</div>
                        <div data-options="name:'a.lokasi'">Lokasi</div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <table id="datagrid-rab"></table>
    <table id="datagrid-paket-detail"></table>
</div>
<script type="text/javascript">
    var url;
    var i;
    var p = document.getElementById('id_periode').value;
	
    $(function (){
        $('#datagrid').datagrid({ 
            width: 'auto', height: $(window).height() * (68/100),
            title: 'Paket', rownumbers:true, singleSelect:true, fitColumns:true, toolbar:'#toolbar', sortable:true,
            url: '<?php echo site_url('app/paket'); ?>/index?paket='+p, nowrap:false,
            pagination:true, pageSize:10, pageList:[10,20,50,100],
            columns:[[
                {field:'kode',title:'Kode',width:40,sortable:true},
                {field:'menu',title:'Action',width:30,sortable:false,align:'center',
                    formatter:function(value,row,index){
                        var strReturn = '';
                        strReturn += 
                        '<div style="text-align:center;">'+
                        '<a href="javascript:void(0)" class="icon-plus-sign" onclick="addDetail('+index+');" title="Rincian Paket"></a>'+
                        '&nbsp;&nbsp;&nbsp;'+
                        '<a href="javascript:void(0)" class="icon-editb" onclick="edit('+index+');" title="Edit"></a>'+
                        '&nbsp;&nbsp;&nbsp;'+
                        '<a href="javascript:void(0)" class="icon-trashb" onclick="del('+index+')" title="Delete"></a>'+
                        '</div>';
                        return strReturn;
                    }
                },
                {field:'nama',title:'Nama',width:150,sortable:true},
                {field:'swakelola',title:'Swakelola',width:80,align:'center',sortable:true}
            ]],
            view: detailview,
            detailFormatter:function(index,row){
                return '<div style="padding:2px"><table id="ddatagrid-'+index+'"></table></div>';
            },
            onExpandRow: function(index,row){
                $('#ddatagrid-'+index).datagrid({
                    url: '<?php echo site_url('app/paket'); ?>/?paket_detail='+row.kode,
                    fitColumns:true, singleSelect:true, nowrap:false, sortable:true,
                    pagination:true, pageSize:5, pageList:[5,10, 20, 50],
                    loadMsg:'Please Wait', height:'auto',
                    columns:[[
                        {field:'kode_rab',title:'Kode',width:80, sortable:true},
//                        {field:'nama',title:'Nama',width:150,sortable:true},
//                        {field:'satuan',title:'Satuan',width:70,sortable:true,align:'center'},
//                        {field:'volume',title:'Volume',width:75,align:'right',sortable:true},
//                        {field:'harga_pagu',title:'Harga Pagu',width:100,align:'right',sortable:true},
//                        {field:'harga_oe',title:'Harga OE',width:100,align:'right',sortable:true}
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
                    url: '<?php echo site_url('app/paket'); ?>/index?paket='+newValue
                });
            }
        });
        
        
        
        $.extend($.fn.datagrid.methods, {
            getChecked: function(jq){
		var rr = [];
		var rows = jq.datagrid('getRows');
		jq.datagrid('getPanel').find('div.datagrid-cell-check input:checked').each(function(){
                    var index = $(this).parents('tr:first').attr('datagrid-row-index');
                    rr.push(rows[index]);
		});
		return rr;
            }
        });
    });
	
        
    function doSearch(value,name){
        $('#datagrid').datagrid('load', {
            filter : $('#sb').searchbox('getName')+'|'+$('#sb').searchbox('getValue')
        });
    }
    
    function add(){
        $('#dialog-form').dialog({ 
            title: 'Add - Paket',
            closed: false, cache: false, modal: true, 
            width: $('#div-reg-center').width() * (40/100), 
            height: $(window).height() * (70/100) 
        });
        $('#fm').form('clear');
        url = '<?php echo site_url('app/paket/create'); ?>';
    }

    function edit(id){
        $('#datagrid').datagrid('selectRow',id);
        var row = $('#datagrid').datagrid('getSelected');
        $('#fm').form('load',row);
        $('#dialog-form').dialog({ 
            title: 'Edit - Paket',
            closed: false, cache: false, modal: true, 
            width: $('#div-reg-center').width() * (40/100), 
            height: $(window).height() * (70/100) 
        });
        url = '<?php echo site_url('app/paket/update'); ?>/'+row.kode;
    }
	
    function del(id){
        $('#datagrid').datagrid('selectRow',id);
        var row = $('#datagrid').datagrid('getSelected');
        if (row){
            $.messager.confirm('Confirm','You are about to delete a record. This cannot be undone. Are you sure?',function(r){
                if (r){
                    $.post('<?php echo site_url('app/paket/delete'); ?>',{id:row.kode},function(result){
                        if (result.success){
                            $('#datagrid').datagrid('reload');
                            $.messager.show({ title: 'Info', timeout: 1000, msg: 'Success', style:{ right:'center', top:'center' } });
                        } else {
                            $.messager.alert('Error',result.msg,'error');
                        }
                    },'json');
                }
            });
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
                    $.messager.show({ title: 'Error', msg: result.msg });
                }
            }
        });
    }

    /*-- Rincian Paket--*/
    function addDetail(id){
        $('#datagrid').datagrid('selectRow',id);
        var row = $('#datagrid').datagrid('getSelected');
        var kode_paket = row.kode;
        $('#dialog-rincian').dialog({ 
            title: 'Rincian Paket : '+kode_paket, 
            closed: false, cache: false, modal: true, 
            width: $(window).width() * (97/100), 
            height: $(window).height() * (96/100),
            
            
//            buttons:[{
//                text:'Save',
//                iconCls:'icon-save',
//                handler:function(){ 
//                    alert('Save'); 
//                    var ids=[];
//                    var rows = $('#datagrid-rab').datagrid('getChecked');  
//                    for(var i=0; i<rows.length; i++){  
//                       $.post('<?php // echo site_url('app/paket/checked'); ?>',{koder:rows[i].kode,kodep:kode_paket},function(result){
//                            if (result.success){
//                                $('#datagrid-rab').datagrid('reload');
//                                $.messager.show({ title: 'Info', timeout: 1000, msg: 'Success', style:{ right:'center', top:'center' } });
//                            } else {
//                                $.messager.show({ title: 'Error', msg: result.msg });
//                            }
//                       },'json');
//
//                    }
//                    
//                }
//            },{
//                text:'Close',
//                iconCls:'icon-cancel',
//                handler:function(){ $('#dialog-rincian').dialog({closed:true}); }
//            }]
        });
        
        $('#datagrid-rab').datagrid({
            title:'RAB yang telah disetujui',
            width: 'auto', height: $(window).height() * (43/100), singleSelect:true,
            rownumbers:true, fitColumns:true, toolbar:'#tb-rab', sortable:true, 
            url: '<?php echo site_url('app/paket'); ?>/index?rincian_paket='+p, nowrap:false,
            pagination:true, pageSize:10, pageList:[10,20,50,100],
            idField:'id',
            columns:[[
                // {field:'ck',width:100,checkbox:true},
                {field:'kode',title:'Kode',width:40},
                {field:'nama',title:'Nama',width:100,sortable:true},
                {field:'lokasi',title:'Lokasi',width:80,sortable:true},
                {field:'anggaran',title:'Anggaran',width:80,align:'right',sortable:true},
                {field:'hps_oe',title:'HPS/OE',width:80,align:'right',sortable:true}
            ]],
            onClickRow:function(rowIndex, rowData){
//                alert(rowData.kode);
//                alert(kode_paket);
                $.post('<?php echo site_url('app/paket/checked'); ?>',{koder:rowData.kode,kodep:kode_paket},function(result){
                    if (result.success){
                        $('#datagrid-rab').datagrid('reload');
                        $('#datagrid-paket-detail').datagrid('reload');
//                        $.messager.show({ title: 'Info', timeout: 1000, msg: 'Success', style:{ right:'center', top:'center' } });
                    } else {
                        $.messager.show({ title: 'Error', msg: result.msg });
                    }
                },'json');
            }
        });
        
        $('#datagrid-paket-detail').datagrid({
            title:'Rincian Paket',
            width:'auto',height:$(window).height() * (43/100), singleSelect:true,
            rownumbers:true, fitColumns:true, toolbar:'#tb-paket-detail', sortable:true, 
            url: '<?php echo site_url('app/paket'); ?>/index?paket_detail='+kode_paket, nowrap:false,
            pagination:true, pageSize:10, pageList:[10,20,50,100],
            idField:'id',
            columns:[[
                //{field:'ck',width:100,checkbox:true},
                {field:'kode_rab',title:'Kode',width:40},
                {field:'nama',title:'Nama',width:100,sortable:true},
                {field:'lokasi',title:'Lokasi',width:80,sortable:true},
                {field:'anggaran',title:'Anggaran',width:80,align:'right',sortable:true},
                {field:'hps_oe',title:'HPS/OE',width:80,align:'right',sortable:true}
            ]],
            onClickRow:function(rowIndex, rowData){
//                alert(rowData.kode);
                $.post('<?php echo site_url('app/paket/uncheck'); ?>',{id:rowData.id},function(result){
                    if (result.success){
                        $('#datagrid-rab').datagrid('reload');
                        $('#datagrid-paket-detail').datagrid('reload');
//                        $.messager.show({ title: 'Info', timeout: 1000, msg: 'Success', style:{ right:'center', top:'center' } });
                    } else {
                        $.messager.show({ title: 'Error', msg: result.msg });
                    }
                },'json');
            }
        });
    
    }
    
    function saveDetail(){
    
    }

    
	
</script>
