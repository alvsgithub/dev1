<div id="mp-layout" class="easyui-layout" data-options="fit:true">
    <div data-options="region:'center',border:true" style="width: auto;">
        <section_easyui>
            <div class="alert alert-info">Click one row Group to setting menu privilige and then check 'Menu'</div>
            <table id="datagrid" title="Group" class="easyui-datagrid" style="width:auto; height: auto;" >
            </table>
        </section_easyui>
    </div>
    <div data-options="region:'east',border:true,maxWidth:800,minWidth:300,collapsible:false"
         style="width: 700px;border: 1px solid #ccc;">
        <section_easyui>
            <table id="tr" style="width:auto;height:auto;" >       
            </table>
        </section_easyui>
    </div>
</div>    
<script type="text/javascript">
    $(function(){
        var rdgi;
        $('#datagrid').datagrid({
            pagination:true, rownumbers:false, fitColumns:true, singleSelect:true, nowrap:false, collapsible:false, sortable:true, 
            width: $('#div-reg-center').width() * (38/100), height: $(window).height() * (60/100),
            url:'<?php echo site_url('app/group/access/'); ?>?group=true',
            columns:[[ 
//            {field:'id',title:'ID',width:70,sortable:true}, 
            {field:'nama_group',title:'Nama Group',width:125,sortable:true} ]],
            onClickRow:function(value,row,index){                
                rdgi = row.id;
                $('#tr').treegrid({ 
                    title:'Menu & Privilige - Group : '+row.nama_group, url:'<?php echo site_url('app/group/access/'); ?>?menu=true',
                    idField: 'id_menu', treeField: 'nama_menu', fitColumns:true, animate:true, lines:true, rownumbers:false,
                    width: $('#div-reg-center').width() * (55/100), height: $(window).height() * (65/100),
                    columns:[[ 
                        {field:'nama_menu',title:'Nama Menu',width:300,
                            formatter:function(value,row,index){
                                if(row.menu_allowed.match(rdgi) == rdgi) return " <input id='nm' type='checkbox' checked='true'> " + row.nama_menu;
                                else return " <input id='nm' type='checkbox'> " + row.nama_menu;
                            }
                        }//, 
//                        {field:'id_parent',title:'Add',width:80,align:'center', formatter:function(value,row,index){ return " <input id='ad' type='checkbox'> "; } }, 
//                        {field:'level',title:'Edit',width:80,align:'center', formatter:function(value,row,index){ return " <input id='ed' type='checkbox'> "; } },
//                        {field:'level',title:'Delete',width:80,align:'center', formatter:function(value,row,index){ return " <input id='de' type='checkbox'> "; } }
                    ]],
                    onClickCell: function (field,row){ updatePrivilege(rdgi,row.id_menu,row.menu_allowed,row.id_parent); }
                });
            }
        }); 
        //var idList = ""; $("input:checked").each(function(){ var id = $(this).attr("id"); if(id.indexOf("ceshi_")>-1) idList += id.replace("ceshi_",'')+','; }); alert(idList);
    });
    
    function updatePrivilege(idg,idm,ma,idp){ $.post('<?php echo site_url('app/group/privilege'); ?>',{idg:idg,idm:idm,ma:ma,idp:idp},function(result){ 
    if (result.success){ $('#tr').treegrid('reload'); } 
    else { $.messager.show({ title: 'Error', msg: result.errorMsg }); } },'json'); }

</script>


