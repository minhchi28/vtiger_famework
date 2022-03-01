<?php /* Smarty version Smarty-3.1.7, created on 2020-10-14 01:34:43
         compiled from "/home/onlinecrm/domains/vtiger710.giaiphapcrm.vn/public_html/includes/runtime/../../layouts/v7/modules/BoruElastic/SearchViewResults.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6299350355f8655b3725b01-38231341%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6b41c10b94431ace2d91b5e26636352a45eb5102' => 
    array (
      0 => '/home/onlinecrm/domains/vtiger710.giaiphapcrm.vn/public_html/includes/runtime/../../layouts/v7/modules/BoruElastic/SearchViewResults.tpl',
      1 => 1602639275,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6299350355f8655b3725b01-38231341',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'ENABLED_MODULES' => 0,
    'MOD' => 0,
    'MODULE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5f8655b374509',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f8655b374509')) {function content_5f8655b374509($_smarty_tpl) {?><?php  $_smarty_tpl->tpl_vars['MOD'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['MOD']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ENABLED_MODULES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['MOD']->key => $_smarty_tpl->tpl_vars['MOD']->value){
$_smarty_tpl->tpl_vars['MOD']->_loop = true;
?><?php if ($_smarty_tpl->tpl_vars['MOD']->value['count']>0){?><div class="fieldBlockContainer block"><div class="bottomscroll-div"><?php $_smarty_tpl->tpl_vars['MODSELECTED'] = new Smarty_variable($_smarty_tpl->tpl_vars['MOD']->value['name'], null, 0);?><h4 class="fieldBlockHeader" style="padding-top: 15px;"><?php echo $_smarty_tpl->tpl_vars['MOD']->value['tablabel'];?>
 (<?php echo $_smarty_tpl->tpl_vars['MOD']->value['count'];?>
)</h4><hr><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("SearchViewResultsEntries.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</div></div><br><?php }?><?php } ?></div><?php }} ?>