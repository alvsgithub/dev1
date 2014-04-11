<section_easyui>  

<table style="width: 100%;">
    <tr>
        <td style="width: 25%;"><table id="datagrid"></table></td>
        <td style="width: 65%;"><table id="ddatagrid"></table></td>
    </tr>
</table>

</section_easyui>

<script type="text/javascript">
    var url;
    var i;
	
    $(function (){
         $('#datagrid').datagrid({
            width: 'auto', height: $(window).height() * (68/100),
            title: 'Verifikasi', rownumbers:true, singleSelect:true, fitColumns:true, sortable:true,
            url: '<?php echo site_url('app/verifikasi'); ?>/?verifikasi=true', nowrap:false,
            pagination:true, pageSize:10, pageList:[10,20,50,100],
            columns:[[
                {field:'keterangan',title:'Keterangan',width:150,sortable:true},
                {field:'tabel',title:'Tabel',width:100}
            ]],
            onClickRow:function(rowIndex, rowData){
                $('#ddatagrid').datagrid({ 
                    width: 'auto', height: $(window).height() * (68/100),
                    url: '<?php echo site_url('app/verifikasi'); ?>/?detail_verifikasi='+rowData.id 
                }); 
            }
        });
        $('#ddatagrid').datagrid({
            width: 'auto', height: $(window).height() * (68/100),
            title: 'Detail Verifikasi', rownumbers:false, 
            singleSelect:true, fitColumns:true, sortable:true,
            nowrap:false, pagination:true, pageSize:10, pageList:[10,20,50,100],
            columns:[[
                {field:'level',title:'Level',width:50,sortable:true,align:'center'},
                {field:'username',title:'Username',width:80},
                {field:'nama',title:'Nama',width:90},
                {field:'jabatan',title:'Jabatan',width:110},
                {field:'bagian',title:'Bagian',width:100}
            ]]
        });
    });
    
    
</script>