<?php /* Smarty version Smarty-3.1.7, created on 2020-10-14 08:43:22
         compiled from "/home/onlinecrm/domains/vtiger710.giaiphapcrm.vn/public_html/includes/runtime/../../layouts/v7/modules/BoruElastic/SearchResultsQuick.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2017969465f86ba2acbf969-72679402%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '21e1b301ac1d9c2a7ddc8127f57d41cbe779d2b3' => 
    array (
      0 => '/home/onlinecrm/domains/vtiger710.giaiphapcrm.vn/public_html/includes/runtime/../../layouts/v7/modules/BoruElastic/SearchResultsQuick.tpl',
      1 => 1602639275,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2017969465f86ba2acbf969-72679402',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MATCHING_RECORDS' => 0,
    'searchRecords' => 0,
    'totalCount' => 0,
    'modulesCount' => 0,
    'MODULE' => 0,
    'TOTAL' => 0,
    'QUERY' => 0,
    'SEARCH_MODULE' => 0,
    'module' => 0,
    'COUNTS' => 0,
    'recordObject' => 0,
    'ID' => 0,
    'DETAILVIEW_URL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5f86ba2b074a2',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f86ba2b074a2')) {function content_5f86ba2b074a2($_smarty_tpl) {?>
<?php $_smarty_tpl->tpl_vars["totalCount"] = new Smarty_variable(0, null, 0);?><?php $_smarty_tpl->tpl_vars["totalModulesSearched"] = new Smarty_variable(count($_smarty_tpl->tpl_vars['MATCHING_RECORDS']->value), null, 0);?><?php  $_smarty_tpl->tpl_vars['searchRecords'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['searchRecords']->_loop = false;
 $_smarty_tpl->tpl_vars['module'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['MATCHING_RECORDS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['searchRecords']->key => $_smarty_tpl->tpl_vars['searchRecords']->value){
$_smarty_tpl->tpl_vars['searchRecords']->_loop = true;
 $_smarty_tpl->tpl_vars['module']->value = $_smarty_tpl->tpl_vars['searchRecords']->key;
?><?php $_smarty_tpl->tpl_vars['modulesCount'] = new Smarty_variable(count($_smarty_tpl->tpl_vars['searchRecords']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["totalCount"] = new Smarty_variable($_smarty_tpl->tpl_vars['totalCount']->value+$_smarty_tpl->tpl_vars['modulesCount']->value, null, 0);?><?php } ?><div class="content-search-quick"><div class="globalSearchResults"><div class="row-fluid"><div class="header highlightedHeader padding1per"><div class="row-fluid"><span class="span6"><strong><?php echo vtranslate('LBL_SEARCH_RESULTS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;(<?php echo $_smarty_tpl->tpl_vars['TOTAL']->value;?>
)</strong></span><span class="span6"><span class="pull-right"><a href="index.php?module=BoruElastic&view=List&query=<?php echo $_smarty_tpl->tpl_vars['QUERY']->value;?>
"><?php echo vtranslate('List All',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></span></span></div></div><div class="contents"><?php if ($_smarty_tpl->tpl_vars['totalCount']->value==100){?><div class='alert alert-block'><button type=button class="close" data-dismiss="alert">&times;</button><?php if ($_smarty_tpl->tpl_vars['SEARCH_MODULE']->value){?><?php echo vtranslate('LBL_GLOBAL_SEARCH_MAX_MESSAGE_FOR_MODULE','Vtiger');?>
<?php }else{ ?><?php echo vtranslate('LBL_GLOBAL_SEARCH_MAX_MESSAGE','Vtiger');?>
<?php }?></div><?php }?><?php  $_smarty_tpl->tpl_vars['searchRecords'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['searchRecords']->_loop = false;
 $_smarty_tpl->tpl_vars['module'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['MATCHING_RECORDS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['matchingRecords']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['searchRecords']->key => $_smarty_tpl->tpl_vars['searchRecords']->value){
$_smarty_tpl->tpl_vars['searchRecords']->_loop = true;
 $_smarty_tpl->tpl_vars['module']->value = $_smarty_tpl->tpl_vars['searchRecords']->key;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['matchingRecords']['index']++;
?><?php $_smarty_tpl->tpl_vars["modulesCount"] = new Smarty_variable(count($_smarty_tpl->tpl_vars['searchRecords']->value), null, 0);?><label class="clearfix"><strong><a href="index.php?module=BoruElastic&view=List&relmod=<?php echo $_smarty_tpl->tpl_vars['module']->value;?>
&query=<?php echo $_smarty_tpl->tpl_vars['QUERY']->value;?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['module']->value);?>
&nbsp;(<?php echo $_smarty_tpl->tpl_vars['modulesCount']->value;?>
 of <?php echo $_smarty_tpl->tpl_vars['COUNTS']->value[$_smarty_tpl->tpl_vars['module']->value];?>
)</a></strong><?php ob_start();?><?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['matchingRecords']['index']+1;?>
<?php $_tmp1=ob_get_clean();?><?php if ($_tmp1==1){?><span class="pull-right"><p class="muted"><?php echo vtranslate('LBL_CREATED_ON',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</small></p></span><?php }?></label><ul class="nav"><?php  $_smarty_tpl->tpl_vars['recordObject'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['recordObject']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['searchRecords']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['globalSearch']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['recordObject']->key => $_smarty_tpl->tpl_vars['recordObject']->value){
$_smarty_tpl->tpl_vars['recordObject']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['globalSearch']['index']++;
?><?php $_smarty_tpl->tpl_vars["ID"] = new Smarty_variable(($_smarty_tpl->tpl_vars['module']->value)."_globalSearch_row_".(($_smarty_tpl->getVariable('smarty')->value['foreach']['globalSearch']['index']+1)), null, 0);?><?php $_smarty_tpl->tpl_vars['DETAILVIEW_URL'] = new Smarty_variable($_smarty_tpl->tpl_vars['recordObject']->value->getDetailViewUrl(), null, 0);?><li id="<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
"><a target="_blank" id="<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
_link" class="cursorPointer" <?php if (stripos($_smarty_tpl->tpl_vars['DETAILVIEW_URL']->value,'javascript:')===0){?>onclick='<?php echo substr($_smarty_tpl->tpl_vars['DETAILVIEW_URL']->value,strlen("javascript:"));?>
' <?php }else{ ?> onclick='window.location.href="<?php echo $_smarty_tpl->tpl_vars['DETAILVIEW_URL']->value;?>
"' <?php }?>><?php echo $_smarty_tpl->tpl_vars['recordObject']->value->getName();?>
<span id="<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
_time" class="pull-right" title="<?php echo Vtiger_Util_Helper::formatDateTimeIntoDayString($_smarty_tpl->tpl_vars['recordObject']->value->get('createdtime'));?>
"><?php echo Vtiger_Util_Helper::formatDateDiffInStrings($_smarty_tpl->tpl_vars['recordObject']->value->get('createdtime'));?>
</span></a></li><?php }
if (!$_smarty_tpl->tpl_vars['recordObject']->_loop) {
?><li><?php echo vtranslate('LBL_NO_RECORDS',$_smarty_tpl->tpl_vars['module']->value);?>
</li><?php } ?></ul><?php } ?></div></div></div></div>
<style type="text/css">
.content-search-quick {
	z-index: 10001;
    position: fixed;
    padding: 0px;
    margin: 0px;
    width: 23%;
    top: 40px;
    left: 491px;
    text-align: left;
    color: rgb(0, 0, 0);
    background-color: rgb(255, 255, 255);
    cursor: default;
    border-radius: 2px !important;
    border: 0 !important;
}
.globalSearchResults {
  background: #ffffff;
  border: 1px solid #dddddd;
  border: 1px solid #c4c4c4;
  -webkit-box-shadow: 0 0 3px -1px #dddddd;
  -moz-box-shadow: 0 0 3px -1px #dddddd;
  box-shadow: 0 0 3px -1px #dddddd;
  min-width: 280px;
  min-height: 500px;
}
.globalSearchResults .highlightedHeader {
  background-color: #f5f5f5;
  background-image: -moz-linear-gradient(top, #f6f6f6, #f3f3f4);
  background-image: -ms-linear-gradient(top, #f6f6f6, #f3f3f4);
  background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#f6f6f6), to(#f3f3f4));
  background-image: -webkit-linear-gradient(top, #f6f6f6, #f3f3f4);
  background-image: -o-linear-gradient(top, #f6f6f6, #f3f3f4);
  background-image: linear-gradient(top, #f6f6f6, #f3f3f4);
  background-repeat: repeat-x;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f6f6f6', endColorstr='#f3f3f4', GradientType=0);
  border-color: #f3f3f4 #f3f3f4 #cbcbcf;
  border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
  text-shadow: 0px 1px #ffffff;
  border-bottom: 1px solid #dddddd;
  color: #444444;
  padding: 8px 5px;
}
.globalSearchResults #showFilter {
  color: #666666;
}
.globalSearchResults .contents {
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  word-wrap: break-word;
  padding: 5% 5% 10% 3%;
  max-height: 500px;
  min-width: 280px;
}
.globalSearchResults .contents > label {
  padding: 5px;
  border-bottom: 1px solid #dddddd;
}
.globalSearchResults .contents ul li a {
  margin: 5px 0;
  padding: 7px;
}
.globalSearchResults .contents ul li a span {
  color: #666666;
  opacity: 0.5;
  font-size: 0.8em;
}
.globalSearchResults .contents ul li a span p {
  margin: 0 !important;
}

</style><?php }} ?>