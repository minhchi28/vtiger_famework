<?php /* Smarty version Smarty-3.1.7, created on 2022-03-01 13:49:08
         compiled from "C:\xampp\htdocs\vtiger\includes\runtime/../../layouts/v7\modules\Vtiger\ModalHeader.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1690569602621e2454c13971-84707834%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dcda59a1ec0a91d32f898018980910069a332fda' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtiger\\includes\\runtime/../../layouts/v7\\modules\\Vtiger\\ModalHeader.tpl',
      1 => 1520586669,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1690569602621e2454c13971-84707834',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'TITLE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_621e2454c169a',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_621e2454c169a')) {function content_621e2454c169a($_smarty_tpl) {?>
<div class="modal-header"><div class="clearfix"><div class="pull-right " ><button type="button" class="close" aria-label="Close" data-dismiss="modal"><span aria-hidden="true" class='fa fa-close'></span></button></div><h4 class="pull-left"><?php echo $_smarty_tpl->tpl_vars['TITLE']->value;?>
</h4></div></div>    <?php }} ?>