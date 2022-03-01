<?php /* Smarty version Smarty-3.1.7, created on 2020-10-14 01:34:19
         compiled from "/home/onlinecrm/domains/vtiger710.giaiphapcrm.vn/public_html/includes/runtime/../../layouts/v7/modules/BoruElastic/Uninstall.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3665230745f85db19bb0c57-14762343%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e6edbb041402d4191080bb5f1e012893361a6193' => 
    array (
      0 => '/home/onlinecrm/domains/vtiger710.giaiphapcrm.vn/public_html/includes/runtime/../../layouts/v7/modules/BoruElastic/Uninstall.tpl',
      1 => 1602607919,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3665230745f85db19bb0c57-14762343',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5f85db19bc5c6',
  'variables' => 
  array (
    'MODULE' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f85db19bc5c6')) {function content_5f85db19bc5c6($_smarty_tpl) {?>
<div align="center">
    <h2>Boru Elastic Search</h2>
    <br/><br/><br/>

    <div>
        <strong>Are you sure you want to delete this module?</strong><br><br>
        <a onclick="history.back(1);">
            <input type="button" class="btn btn-default btm-sm" value="Back"></a>&nbsp;&nbsp;&nbsp;
        <a href="index.php?module=<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
&action=Uninstall"><input type="button" class="btn btn-success btm-sm"
                                                                     value="Yes"></a>
    </div>
</div>
<?php }} ?>