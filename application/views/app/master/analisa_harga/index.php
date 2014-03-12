<section_easyui>  

<div id="toolbar">
    <table cellpadding="0" cellspacing="0" style="width:100%">
        <tr>
            <td style="padding-left:2px">
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="create();">Add</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edi" plain="false" onclick="edit();">Edit</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remov" plain="false" onclick="del();">Delete</a>
            </td>
        <td style="text-align:right;padding-right:2px;padding-top: 3px;">
            <input id="sb" class="easyui-searchbox" 
                   data-options="prompt:'Please Input filter',menu:'#mfiltergrid',searcher:doSearch" 
                   style="width:300px;float:right;padding-top: 50px;">
            <div id="mfiltergrid" style="width:170px;">
                <div data-options="name:'a.nama',iconCls:'icon-kepala'">Nama Pemilik</div>
                <div data-options="name:'a.nama_perusahaan',iconCls:'icon-building'">Nama Perusahaan</div>
                <div data-options="name:'a.alamat',iconCls:'icon-address'">Alamat</div>
                <div data-options="name:'b.jenis',iconCls:'icon-categories'">Jenis</div>
                <div data-options="name:'c.nama',iconCls:'icon-city'">Kabupaten/Kota</div>
                <div data-options="name:'username'">Username</div>
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
            <td style="width: 40%">Periode (Tahun Semester)</td>
            <td><input type="text" name="id_periode" class="easyui-validatebox" required="true" size="13" maxlength="10"></td>
	</tr>
	<tr>
            <td>Kode</td>
            <td><input type="text" name="kode" class="easyui-validatebox" required="true" size="13" maxlength="10" /></td>
	</tr>
	<tr>
            <td>Nama</td>
            <td><input type="text" name="nama" class="easyui-validatebox" required="true" size="13" maxlength="10" /></td>
	</tr>
	<tr>
            <td>Satuan</td>
            <td><input type="text" name="satuan" class="easyui-validatebox" required="true" size="13" maxlength="10" /></td>
	</tr>
    </table>
    </form>
</div>
<div id="dialog-buttons"> 
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="save();">Simpan</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dialog-form').dialog('close');">Batal</a>
</div>
</section_easyui>
<script>
    var url;
    var jenis = '<?php echo $jenis; ?>';
    $('#datagrid').datagrid({ 
        width: $('#div-reg-center').width() * (83/100), height: $(window).height() * (68/100),
        title: 'Analisa Harga '+jenis, rownumbers:true, singleSelect:true, fitColumns:true, toolbar:'#toolbar'
    });
    
    
    function doSearch(value,name){
        $('#datagrid').datagrid('load', {
            filter : $('#sb').searchbox('getName')+'|'+$('#sb').searchbox('getValue')
        });
    }
    
    function create(){
        $('#dialog-form').dialog({ closed: false, cache: false, modal: true, width: $('#div-reg-center').width() * (60/100), height: $(window).height() * (70/100) }).dialog('setTitle','Add - Analisa Harga');
        $('#fm').form('clear');
        url = '<?php echo site_url('app/analisa_harga/create'); ?>';
    }

    function update(){
        var row = $('#datagrid-fungsi-kawasan').datagrid('getSelected');
        if(row){
            $('#dialog-form').dialog({ closed: false, cache: false, modal: true }).dialog('setTitle','Edit Kawasan');
            $('#form').form('load',row);
            url = '<?php echo site_url('app/analisa_harga/update'); ?>/' + row.kode_fungsi_kawasan;
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
                        title: 'Pesan', timeout: 1000, msg: 'Data berhasil disimpan', 
                        style:{ right:'center', top:'center' } 
                    });
                }else{
                    $('#dialog-form').dialog('close');
                    $('#datagrid').datagrid('reload');
                    $.messager.show({
                        title: 'Error', msg: result.msg,
                        style:{ right:'center', top:'center' } 
                    });
                }
            }
        });
    }
    
</script>

