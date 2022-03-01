<?php /* Smarty version Smarty-3.1.7, created on 2020-10-14 01:34:43
         compiled from "/home/onlinecrm/domains/vtiger710.giaiphapcrm.vn/public_html/includes/runtime/../../layouts/v7/modules/BoruElastic/SearchView.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16440159695f8655b36dc3d2-41761810%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cdbbd773ed1bb06c28711df07972d5e11de65399' => 
    array (
      0 => '/home/onlinecrm/domains/vtiger710.giaiphapcrm.vn/public_html/includes/runtime/../../layouts/v7/modules/BoruElastic/SearchView.tpl',
      1 => 1602639275,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16440159695f8655b36dc3d2-41761810',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODULE' => 0,
    'QUERY' => 0,
    'MODSELECTED' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5f8655b37169e',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f8655b37169e')) {function content_5f8655b37169e($_smarty_tpl) {?><style type="text/css">
.content-area-boru {
    padding-left: 70px;
    width: 98%;
    min-height: 768px;
}
.block{
	background: #ffffff;
    border: 1px solid #F3F3F3;
    padding-left: 15px;
    padding-right: 15px;
}
</style>
<div class="main-container main-container-<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
"><div id="modnavigator" class="module-nav"><div class="hidden-xs hidden-sm mod-switcher-container"><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("partials/Menubar.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</div></div><div class="listViewPageDiv"><div class="listViewContentDiv" id="listViewContents" style="background: #f9f9f9;"><span class="btn-toolbar span8"><div align="center" ><h4 class="fieldBlockHeader" style="margin: 0px"><strong>Results For: <?php echo $_smarty_tpl->tpl_vars['QUERY']->value;?>
</strong></h4></div></span><span ><div class="clearfix"></div><input type="hidden" id="recordsCount" value=""/><input type="hidden" id="selectedIds" name="selectedIds" /><input type="hidden" id="excludedIds" name="excludedIds" /></span><div class="padding-left1per content-area-boru" style="width: 94%; "><div class="listViewTopMenuDiv noprint"><div class="row-fluid listViewActionsDiv"><div class="content-area-boru"><?php if ($_smarty_tpl->tpl_vars['MODSELECTED']->value=='none'){?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("SearchViewResults.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }else{ ?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("SearchViewResultsModule.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }?></div></div></div></div></div></div><?php }} ?>