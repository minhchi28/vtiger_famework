<?php /* Smarty version Smarty-3.1.7, created on 2022-03-01 13:51:07
         compiled from "C:\xampp\htdocs\vtiger\includes\runtime/../../layouts/v7\modules\Leads\ModuleSummaryView.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2020893191621e24cb7b8dc0-66482443%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0fab486f866f88dd005596930506ef26be0d1f73' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtiger\\includes\\runtime/../../layouts/v7\\modules\\Leads\\ModuleSummaryView.tpl',
      1 => 1520586669,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2020893191621e24cb7b8dc0-66482443',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODULE_NAME' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_621e24cb7be43',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_621e24cb7be43')) {function content_621e24cb7be43($_smarty_tpl) {?>
<div class="recordDetails"><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('SummaryViewContents.tpl',$_smarty_tpl->tpl_vars['MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</div><?php }} ?>