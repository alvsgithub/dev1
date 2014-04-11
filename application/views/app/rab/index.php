<div id="dlg-import" class="easyui-dialog" style="width:auto; height:auto; padding: 10px 20px" 
     closed="true">
    <form style='margin-left: 10px; margin-top: 10px; margin-bottom: -5px;' id="form_import" method="post" action="<?php echo site_url('app/rab/run_import') ?>" enctype="multipart/form-data" role="form">
        <input type="hidden" id="periode" name="periode">
        <input type="file" id="import_browse" name="rab" class="easyui-linkbutton" onChange="document.getElementById('periode').value = document.getElementById('id_periode').value;this.form.submit();">
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
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add2" plain="true" onclick="add();">Add</a>		
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-importe" plain="true" onclick="importdlg();">Import</a>	
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
</section_easyui>

<!-- Dialog Form -->
<?php echo $this->load->view('app/rab/usulan_form'); ?>

<!-- Dialog VERSI RAB -->
<div id="dlgd" class="easyui-dialog" style="width:auto; height:auto; padding: 10px 10px" 
     closed="true" buttons="#dlgdbtn">
    <div style="background: #ffffff;">
        <div class="easyui-tabs" style="width:auto;height:auto;border:1px solid black;">
            <div title="Rincian" style="padding:10px">
                <div id="mm" class="easyui-menu" style="width:150px;"></div>
                <table id="tg" style="width: auto;height:auto;"></table>
            </div>
            <div title="Dokumen" style="padding:10px">
                <table id="dokumen_usulan"></table>
            </div>
        </div>
    </div>
</div>

<!-- Dialog Add Dokumen Usulan -->
<?php echo $this->load->view('app/rab/doc_form'); ?>

<!-- Dialog RAB Tahapan Form -->
<?php echo $this->load->view('app/rab/tahapan_form'); ?>

<!-- Dialog Analisa/Item Tahapan Form -->
<?php echo $this->load->view('app/rab/analisa_item_form'); ?>

<!-- Dialog Verifikasi-->
<div id="dlg-verifikasi" class="easyui-dialog" closed="true" style="width:auto; height:auto; padding: 10px 10px;">
    <div id="dver"></div>
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
            width: 'auto', height: $(window).height() * (68/100),
            title: 'Usulan RAB', rownumbers:true, singleSelect:true, 
            fitColumns:false, toolbar:'#toolbar', sortable:true, nowrap:false,
            url: '<?php echo site_url('app/rab'); ?>/index?rab='+p, 
            pagination:true, pageSize:10, pageList:[10,20,50,100],
            columns:[[
                {field:'kode',title:'Kode',width:100,sortable:true,align:'center'},
                {field:'menu',title:'Action',width:100,align:'center',
                    formatter:function(value,row,index){
                        var strReturn = '';
                        strReturn += 
                        '<div style="text-align:center;">'+
                        '<a href="javascript:void(0)" class="icon-pencilb" onclick="edit(\''+index+'\');" title="Edit"></a>'+
                        '&nbsp;&nbsp;&nbsp;'+
                        '<a href="javascript:void(0)" class="icon-shareb" onclick="copy(\''+index+'\');" title="Copy"></a>'+
                        '&nbsp;&nbsp;&nbsp;'+
                        '<a href="javascript:void(0)" class="icon-trashb" onclick="del(\''+index+'\')" title="Delete"></a>';
                        
                        if(row.position == 0){
                            strReturn += '&nbsp;&nbsp;&nbsp;'+
                            '<a href="javascript:void(0)" class="icon-okb" onclick="usulkan(\''+index+'\');" title="Usulkan"></a>';
                        }else{
                            strReturn += '&nbsp;&nbsp;&nbsp;'+
                            '<a href="javascript:void(0)" class="icon-okb" onclick="verifikasi(\''+index+'\');" title="Verifikasi"></a>';                            
                        }
                        
                        strReturn += '</div>';
                        return strReturn;
                    }
                },
                {field:'nama',title:'Nama',width:450,sortable:true},
                {field:'lokasi',title:'Lokasi',width:300,sortable:true},
                {field:'status',title:'Status',width:175,sortable:true},
                {field:'anggaran',title:'Anggaran',width:100,sortable:true,align:'right'},
                {field:'oe',title:'HPS/OE',width:100,sortable:true,align:'right'}
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
                        {field:'menu',title:'Action',width:100,align:'center',
                            formatter:function(value2,row2,index2){
                                var strReturn = '';					
                                strReturn += 
                                '<div style="text-align:center;"><a href="javascript:void(0)" class="icon-pencilb" onclick="editDetail(\''+index2+'\',\''+index+'\');" title="Edit"></a>'+
                                '&nbsp;&nbsp;&nbsp;'+
                                '<a href="javascript:void(0)" class="icon-zoom-in" onclick="preview(\''+index+'\');" title="View"></a>'+
                                '&nbsp;&nbsp;&nbsp;'+
                                '<a href="javascript:void(0)" class="icon-shareb" onclick="copy(\''+index+'\');" title="Copy Versi"></a>'+
                                '&nbsp;&nbsp;&nbsp;'+
                                '<a href="javascript:void(0)" class="icon-trashb" onclick="delDetail(\''+index2+'\',\''+index+'\')" title="Delete"></a></div>';
                                return strReturn;                                    
                            }
                        },
                        {field:'created_time',title:'Waktu Pembuatan',width:150,sortable:true,align:'center'},
                        {field:'modified_time',title:'Waktu Perubahan',width:150,sortable:true,align:'center'},
                        {field:'anggaran',title:'Anggaran',width:150,sortable:true,align:'right'},
                        {field:'oe',title:'HPS/OE',width:150,sortable:true,align:'right'}
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
        
        $('#ai').combogrid({
            panelWidth: 500, panelHeight: 310,
            url:'<?php echo site_url('app/rab'); ?>?ai=true&idp='+p,
            idField:'id',textField:'kode',
            mode:'remote',fitColumns:false,sortable:true,nowrap:false,
            pagination:true, pageSize:5, pageList:[5,10,15,20],
            columns:[[
                {field:'kode',title:'Kode',width:80,sortable:true},
                {field:'nama',title:'Nama',width:150,sortable:true},
                {field:'satuan',title:'Satuan',width:70,sortable:true,align:'center'},
                {field:'harga_pagu',title:'Harga Pagu',width:100,sortable:true,align:'right'},
                {field:'harga_oe',title:'Harga OE',width:100,sortable:true,align:'right'}
            ]],
            onClickRow:function(index, row){
                document.getElementById('kode_ai').value = row.kode;
                document.getElementById('nama_ai').value = row.nama;
                document.getElementById('satuan_ai').value = row.satuan;
                document.getElementById('jenis_ai').value = row.tabel;
                document.getElementById('pd').value = row.harga_pagu;
                document.getElementById('od').value = row.harga_oe;
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
            title: 'Import Usulan RAB',
            closed: false, cache: false, modal: true, 
            width:300,height:150 
        });
    }
	
    // -- DETAIL -- //

    function editDetail(id2,id){
        $('#datagrid').datagrid('selectRow',id);
        $('#ddatagrid-'+id).datagrid('selectRow',id2);
        var row = $('#ddatagrid-'+id).datagrid('getSelected');
        var id_usulan_detail = row.id;
        $('#tg').treegrid({
            width: 'auto', height: $(window).height() * (78/100),
            idField: 'id', treeField: 'nama', showFooter:true, animate:true,
//            pagination:true, pageSize:10, pageList:[10,20,35,50],
            rownumbers:false, singleSelect:true, fitColumns:true, sortable:true,
            url: '<?php echo site_url('app/rab'); ?>/index?tahapan='+id_usulan_detail, nowrap:false,
            columns:[[
                {field:'id',title:'No.',width:30,sortable:true,align:'left'},
                {field:'nama',title:'Uraian',width:220,sortable:true},
                {field:'menu',title:'Action',width:50,align:'center',
                    formatter:function(value2,row2,index2){
                        if(row2.menu === 'FOOTER'){ return null; }
                        else{
                            var strReturn = '';
                            if(row2.kode === ''){
                                strReturn += '<div>'+
                                '<a href="javascript:void(0)" class="icon-pencilb" onclick="editTahapan(\''+row2.id+'\');" title="Edit"></a>'+
                                '&nbsp;&nbsp;&nbsp;'+
                                '<a href="javascript:void(0)" class="icon-trashb" onclick="delTahapan(\''+row2.id+'\');" title="Delete"></a>'+
                                '&nbsp;&nbsp;&nbsp;'+
                                '<a href="javascript:void(0)" class="icon-plus-sign" onclick="addSubTahapan(\''+row2.id_usulan_detail+'\',\''+row2.id+'\');" title="Add Sub Tahapan"></a>'+
                                '&nbsp;&nbsp;&nbsp;'+
                                '<a href="javascript:void(0)" class="icon-mini-add" onclick="addAnalisaItem(\''+row2.id_usulan_detail+'\',\''+row2.id+'\')" title="Add Analisa / Item"></a>'+
                                '</div>';
                            }else{
                                strReturn += '<div>'+
                                '<a href="javascript:void(0)" class="icon-pencilb" onclick="editAnalisaItem(\''+row2.id+'\');" title="Edit"></a>'+
                                '&nbsp;&nbsp;&nbsp;'+
                                '<a href="javascript:void(0)" class="icon-trashb" onclick="delTahapan(\''+row2.id+'\');" title="Delete"></a>'+
                                '</div>';
                            }
                            return strReturn;     
                        }
                    }
                },
                {field:'kode',title:'Kode',width:35,sortable:true},
                {field:'satuan',title:'Satuan',width:40,align:'center',sortable:true},
                {field:'volume',title:'Volume',width:40,sortable:true,align:'center'},
                {field:'harga_pagu',title:'Harga Pagu',width:70,sortable:true,align:'right'},
                {field:'harga_oe',title:'Harga OE',width:70,sortable:true,align:'right'}
            ]],
            toolbar: [{
                iconCls: 'icon-add2', text: 'Add Tahapan',
                handler: function(){ addTahapan(row.id); }
            }]
        });
        
        /*-- Upload Dokumen Usulan Datagrid--*/
        $('#dokumen_usulan').datagrid({
            width: 'auto', height: $(window).height() * (78/100),
            rownumbers:true, singleSelect:true, fitColumns:true, sortable:true,
            url: '<?php echo site_url('app/dokumen_usulan'); ?>/index?id_usulan_detail='+row.id, nowrap:false,
            pagination:true, pageSize:10, pageList:[10,20,50,100],
            columns:[[
                {field:'modified_time',title:'Tanggal Edit',width:80},
                {field:'link',title:'Nama File',width:55,sortable:true},
                {field:'keterangan',title:'Keterangan',width:80},
                {field:'action',title:'Action',width:40,align:'center',
                    formatter:function(value,row,index){
                        var strReturn = '';
                        strReturn += 
                        '<div style="text-align:center;">'+
                        '<a href="javascript:void(0)" class="icon-pencilb" onclick="edit_dokumen_usulan(\''+index+'\');" title="Edit"></a>'+
                        '&nbsp;&nbsp;&nbsp;'+
                        '<a href="javascript:void(0)" class="icon-trashb" onclick="del_dokumen_usulan(\''+index+'\')" title="Delete"></a>'+
                        '&nbsp;&nbsp;&nbsp;'+
                        '<a href="javascript:void(0)" class="icon-save" onclick="down_dokumen_usulan(\''+index+'\');" title="Download"></a>'+
                        '</div>';
                        return strReturn;
                    }
                }
            ]],
            toolbar: [{
                iconCls: 'icon-add2', text: 'Add Dokumen',
                handler: function(){ addDokumen(row.id); }
            }]
        });
        
        $('#dlgd').dialog({ 
            title: row.kode_usulan+' / Versi '+row.versi, 
            closed: false, cache: false, modal: true, 
            width: $(window).width() * (97/100), 
            height: $(window).height() * (95/100)
        });
        url = '<?php echo site_url('app/analisa_harga/updateDetail'); ?>/'+row.id;
    }
    
    function usulkan(id){
        $('#datagrid').datagrid('selectRow',id);
        var row = $('#datagrid').datagrid('getSelected');
        $.messager.confirm('Konfirmasi','Yakin mengusulkan '+row.kode+' ?',function(r){
            if (r){
                $.post('<?php echo site_url('app/rab/usulkan'); ?>',{kode:row.kode},function(result){
                    if (result.success){
                        $('#datagrid').datagrid('reload');
                        $.messager.show({ title: 'Info', timeout: 1000, msg: 'Success', style:{ right:'center', top:'center' } });
                    } else {
                        $.messager.show({ title: 'Error', msg: result.msg });
                    }
                },'json');
            }
        });
    }
    
    function verifikasi(id){
        $('#datagrid').datagrid('selectRow',id);
        var row = $('#datagrid').datagrid('getSelected');
        $('#dlg-verifikasi').dialog({
            title:'Verifikasi '+row.kode,cache:false, modal:true, closed:false,
            width:600,height:400 
        });
        $('#dver').load('<?php echo site_url('app/rab/verifikasi'); ?>?kode='+row.kode);
    }
    
    function showMenu(id){
        $('#mm').html('');
        $('#mm').menu('appendItem', { text: 'Edit Tahapan', iconCls: 'icon-th-list', onclick: function(){ editTahapan(id); } });
        $('#mm').menu('appendItem', { text: 'Delete Tahapan', iconCls: 'icon-pencilb', onclick: function(){ delTahapan(id); } });
        $('#mm').menu('appendItem', { text: 'Add Sub Tahapan', iconCls: 'icon-edi2', onclick: function(){ addSubTahapan(); } });
        $('#mm').menu('appendItem', { text: 'Add Analisa / Item', iconCls: 'icon-edi2', onclick: function(){ addKomponen(); } });
        $('#mm').menu('show', { left: currentMousePos.x, top: currentMousePos.y });
    }
</script>
