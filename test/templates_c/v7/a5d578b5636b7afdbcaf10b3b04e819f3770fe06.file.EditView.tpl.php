<?php /* Smarty version Smarty-3.1.7, created on 2020-09-29 03:02:42
         compiled from "/home/onlinecrm/domains/vtiger710.giaiphapcrm.vn/public_html/includes/runtime/../../layouts/v7/modules/Portal/EditView.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2407688565f72a3d2e10e32-62172800%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a5d578b5636b7afdbcaf10b3b04e819f3770fe06' => 
    array (
      0 => '/home/onlinecrm/domains/vtiger710.giaiphapcrm.vn/public_html/includes/runtime/../../layouts/v7/modules/Portal/EditView.tpl',
      1 => 1520586669,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2407688565f72a3d2e10e32-62172800',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'RECORD' => 0,
    'MODULE' => 0,
    'TITLE' => 0,
    'BOOKMARK_NAME' => 0,
    'BOOKMARK_URL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5f72a3d2eff52',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f72a3d2eff52')) {function content_5f72a3d2eff52($_smarty_tpl) {?>



<div class="modal-dialog"><div class="modal-content"><form class="form-horizontal" id="saveBookmark" method="POST" action="index.php"><input type="hidden" name="record" value="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value;?>
" /><input type="hidden" name="module" value="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
" /><input type="hidden" name="action" value="SaveAjax" /><?php if ($_smarty_tpl->tpl_vars['RECORD']->value){?><?php ob_start();?><?php echo vtranslate('LBL_EDIT_BOOKMARK',$_smarty_tpl->tpl_vars['MODULE']->value);?>
<?php $_tmp1=ob_get_clean();?><?php $_smarty_tpl->tpl_vars["TITLE"] = new Smarty_variable($_tmp1, null, 0);?><?php }else{ ?><?php ob_start();?><?php echo vtranslate('LBL_ADD_NEW_BOOKMARK',$_smarty_tpl->tpl_vars['MODULE']->value);?>
<?php $_tmp2=ob_get_clean();?><?php $_smarty_tpl->tpl_vars["TITLE"] = new Smarty_variable($_tmp2, null, 0);?><?php }?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("ModalHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('TITLE'=>$_smarty_tpl->tpl_vars['TITLE']->value), 0);?>
<div class="modal-body"><div class="block nameBlock row"><div class="col-lg-1"></div><div class="col-lg-4"><label class="pull-right"><?php echo vtranslate('LBL_BOOKMARK_NAME',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;<span class="redColor">*</span></label></div><div class="col-lg-5"><input type="text" name="bookmarkName" id="bookmarkName" class="col-lg-6 inputElement" <?php if ($_smarty_tpl->tpl_vars['RECORD']->value){?> value="<?php echo $_smarty_tpl->tpl_vars['BOOKMARK_NAME']->value;?>
" <?php }?> placeholder="<?php echo vtranslate('LBL_ENTER_BOOKMARK_NAME',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" data-rule-required="true"/></div><div class="col-lg-2"></div></div><br><div class="block nameBlock row"><div class="col-lg-1"></div><div class="col-lg-4"><label class="pull-right"><?php echo vtranslate('LBL_BOOKMARK_URL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;<span class="redColor">*</span></label></div><div class="col-lg-5"><input type="text" class="inputElement" name="bookmarkUrl" id="bookmarkUrl" <?php if ($_smarty_tpl->tpl_vars['RECORD']->value){?> value="<?php echo $_smarty_tpl->tpl_vars['BOOKMARK_URL']->value;?>
" <?php }?> placeholder="<?php echo vtranslate('LBL_ENTER_URL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" data-rule-required="true" data-rule-url="true"/></div><div class="col-lg-2"></div></div></div><br><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('ModalFooter.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</form></div></div>
<?php }} ?>