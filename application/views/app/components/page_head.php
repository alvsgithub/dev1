<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $meta_title; ?></title>
	
    <link href="<?php echo site_url('asset/css/bootstrap/easyui.css');?>" rel="stylesheet">
    <link href="<?php echo site_url('asset/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo site_url('asset/css/admin.css'); ?>" rel="stylesheet">
    <link href="<?php echo site_url('asset/css/datepicker.css'); ?>" rel="stylesheet">
    <link href="<?php echo site_url('asset/css/icon.css');?>" rel="stylesheet">
    
    <script src="<?php echo site_url('asset/js/jquery-1.8.3.min.js'); ?>"></script>
    <script src="<?php echo site_url('asset/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo site_url('asset/js/jquery.easyui.min.js'); ?>"></script>
    <script src="<?php echo site_url('asset/js/datagrid-detailview.js'); ?>"></script>
    
    <script src="<?php echo site_url('asset/js/jloader.js'); ?>"></script>
    
    <?php if(isset($edatagrid) && $edatagrid === TRUE): ?>
       <script src="<?php echo site_url('asset/js/jquery.edatagrid.js'); ?>"></script>
    <?php endif; ?>
	
    <?php if(isset($datatables) && $datatables === TRUE): ?>
        <link href="<?php echo site_url('asset/css/DT_bootstrap.css');?>" rel="stylesheet">
        <script src="<?php echo site_url('asset/js/jquery.dataTables.js'); ?>"></script>
        <script src="<?php echo site_url('asset/js/DT_bootstrap.js'); ?>"></script>
    <?php endif; ?>
    
    <?php if(isset($sortable) && $sortable === TRUE): ?>
        <script src="<?php echo site_url('asset/js/jquery-ui-1.9.1.custom.min.js'); ?>"></script>
        <script src="<?php echo site_url('asset/js/jquery.mjs.nestedSortable.js'); ?>"></script>
    <?php endif; ?>
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    
</head>

