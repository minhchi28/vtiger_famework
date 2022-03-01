<?php /* Smarty version Smarty-3.1.7, created on 2020-10-14 01:34:47
         compiled from "/home/onlinecrm/domains/vtiger710.giaiphapcrm.vn/public_html/includes/runtime/../../layouts/v7/modules/BoruElastic/Settings.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20753468985f8655b70e58b9-14939678%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '899b01c581d8d0e15708abcdfbe0707230c47a7a' => 
    array (
      0 => '/home/onlinecrm/domains/vtiger710.giaiphapcrm.vn/public_html/includes/runtime/../../layouts/v7/modules/BoruElastic/Settings.tpl',
      1 => 1602639275,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20753468985f8655b70e58b9-14939678',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'CURRENT_USER_MODEL' => 0,
    'MODULE' => 0,
    'WIDTHTYPE' => 0,
    'BES_HOST' => 0,
    'BES_PORT' => 0,
    'BES_PREFIX' => 0,
    'QUALIFIED_MODULE' => 0,
    'MODULES_ALL' => 0,
    'TABID' => 0,
    'ENABLED_MODULES' => 0,
    'BESMODULE' => 0,
    'FIELD_MODEL' => 0,
    'COUNTER' => 0,
    'FIELD_ID' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5f8655b724ff2',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f8655b724ff2')) {function content_5f8655b724ff2($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['WIDTHTYPE'] = new Smarty_variable($_smarty_tpl->tpl_vars['CURRENT_USER_MODEL']->value->get('rowheight'), null, 0);?><style type="text/css">.content-area-boru	{padding-left: 70px;width: 100%;min-height: 768px;padding-top: 20px;padding-right: 70px;background: #f9f9f9;}.block{background: #ffffff!important;}</style><div class="main-container main-container-<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
"><div id="modnavigator" class="module-nav"><div class="hidden-xs hidden-sm mod-switcher-container"><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("partials/Menubar.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</div></div><div class="detailViewContainer"><div class="content-area-boru"><div class="block"><div class="fieldBlockContainer"><h4 class="">Server Settings</h4><hr><table id="elasticServerSettings" align="center" class="table table-borderless"><tbody><tr><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><label class="fieldLabel alignMiddle"><b>Host</b></label></td><td class="fieldValue <?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
" ><input class="inputElement" type="text" name="bes_host" id="bes_host" value="<?php echo $_smarty_tpl->tpl_vars['BES_HOST']->value;?>
" placeholder="localhost"></td></tr><tr><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><label class="fieldLabel alignMiddle"><b>Port</b></label></td><td class="fieldValue <?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
" ><input class="inputElement" type="text" name="bes_port" id="bes_port" value="<?php echo $_smarty_tpl->tpl_vars['BES_PORT']->value;?>
" placeholder="9200"></td></tr><tr><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><label class="fieldLabel alignMiddle"><b>Prefix</b></label></td><td class="fieldValue <?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
" ><input class="inputElement" type="text" name="bes_prefix" id="bes_prefix" value="<?php echo $_smarty_tpl->tpl_vars['BES_PREFIX']->value;?>
" placeholder="vtiger"><input type="hidden" name="bes_prefix_orig" id="bes_prefix_orig" value="<?php echo $_smarty_tpl->tpl_vars['BES_PREFIX']->value;?>
"></td></tr><tr><td colspan="1" align="right"><button class="btn btn-success" onclick="BEsaveServerSettings()"><strong><?php echo vtranslate('LBL_SAVE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></button></td></tr></tbody></table></div></div><br><div class="block"><div class="fieldBlockContainer"><div class="col-sm-11"><h4 class="">Select Modules</h4></div><div style="margin-top: 7px"><button class="btn btn-success" onClick="BEsaveSettings()"><strong><?php echo vtranslate('LBL_SAVE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></button></div><hr><span class="pull-right"></span><table id="elasticModuleSettings"  align="center" class="table table-borderless"><tbody><?php  $_smarty_tpl->tpl_vars['BESMODULE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['BESMODULE']->_loop = false;
 $_smarty_tpl->tpl_vars['TABID'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['MODULES_ALL']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['BESMODULE']->key => $_smarty_tpl->tpl_vars['BESMODULE']->value){
$_smarty_tpl->tpl_vars['BESMODULE']->_loop = true;
 $_smarty_tpl->tpl_vars['TABID']->value = $_smarty_tpl->tpl_vars['BESMODULE']->key;
?><tr><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
" style="width:20px"><input class="modulesCheckBox alignTop" type="checkbox" name="modules_<?php echo $_smarty_tpl->tpl_vars['TABID']->value;?>
" id="modules_<?php echo $_smarty_tpl->tpl_vars['TABID']->value;?>
" value="1" <?php if (isset($_smarty_tpl->tpl_vars['ENABLED_MODULES']->value[$_smarty_tpl->tpl_vars['TABID']->value])){?>checked="checked"<?php }?>></td><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
" style="width:20px"><label class="pull-left fieldLabel alignMiddle"><b><?php echo vtranslate($_smarty_tpl->tpl_vars['BESMODULE']->value->get('label'),$_smarty_tpl->tpl_vars['BESMODULE']->value->getName());?>
</b></label></td><td class="fieldValue <?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><div id="table_<?php echo $_smarty_tpl->tpl_vars['TABID']->value;?>
" style="display:none; width:100%;"><h4 align="center">Select <?php echo vtranslate($_smarty_tpl->tpl_vars['BESMODULE']->value->get('label'),$_smarty_tpl->tpl_vars['BESMODULE']->value->getName());?>
 fields to search</h4><hr><table class="table table-borderless"><tbody><?php $_smarty_tpl->tpl_vars['COUNTER'] = new Smarty_variable(0, null, 0);?><?php  $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = false;
 $_smarty_tpl->tpl_vars['FIELD_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['BESMODULE']->value->getFields(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['FIELD_MODEL']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['FIELD_MODEL']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_MODEL']->key => $_smarty_tpl->tpl_vars['FIELD_MODEL']->value){
$_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = true;
 $_smarty_tpl->tpl_vars['FIELD_NAME']->value = $_smarty_tpl->tpl_vars['FIELD_MODEL']->key;
 $_smarty_tpl->tpl_vars['FIELD_MODEL']->iteration++;
 $_smarty_tpl->tpl_vars['FIELD_MODEL']->last = $_smarty_tpl->tpl_vars['FIELD_MODEL']->iteration === $_smarty_tpl->tpl_vars['FIELD_MODEL']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["fields"]['last'] = $_smarty_tpl->tpl_vars['FIELD_MODEL']->last;
?><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isActiveField()){?><?php $_smarty_tpl->tpl_vars["FIELD_ID"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getId(), null, 0);?><?php if ($_smarty_tpl->tpl_vars['COUNTER']->value%4==0){?><tr><?php }?><td width="25%" style=""><input class="modulesCheckBox alignTop" type="checkbox" name="fields_<?php echo $_smarty_tpl->tpl_vars['TABID']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['FIELD_ID']->value;?>
" id="fields_<?php echo $_smarty_tpl->tpl_vars['TABID']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['FIELD_ID']->value;?>
" value="1" <?php if (isset($_smarty_tpl->tpl_vars['ENABLED_MODULES']->value[$_smarty_tpl->tpl_vars['TABID']->value][$_smarty_tpl->tpl_vars['FIELD_ID']->value])){?>checked="checked"<?php }?>>&nbsp;<?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['BESMODULE']->value->getName());?>
</td></td><?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['fields']['last']||($_smarty_tpl->tpl_vars['COUNTER']->value+1)%4==0){?></tr><?php }?><?php $_smarty_tpl->tpl_vars['COUNTER'] = new Smarty_variable($_smarty_tpl->tpl_vars['COUNTER']->value+1, null, 0);?><?php }?><?php } ?></tbody></table></div></td></tr><?php } ?></tbody></table></div></div></div><div class="row-fluid"><div class="span12"></div></div></div>

<script>
	/*function selectModule(val) {

		jQuery.ajax({
		    url: 'index.php?module=GoogleMap&action=Ajax&get_cfg=1&field=default_radius&mod='+ val,
		    type: 'GET',
		    success: function(msg) {
			document.getElementById('default_radius').value= msg != 'No'? msg: 10;
		    }
		});
	}*/
	jQuery(":checkbox[name^='modules_']").change(function() {
		var arr = this.name.split("_");
		var tabid = arr[1];
		if(this.checked) {
			showTable(tabid);
		} else {
			hideTable(tabid);
		}
	});
	
	function showTable(tabid) {
		jQuery("#table_"+tabid).css("display","");
	}
	function hideTable(tabid) {
		jQuery("#table_"+tabid).css("display","none");
	}
	
	function uninstall(){
		var answer= confirm('Are you sure?')
		if(answer){
			window.location= 'index.php?module=GoogleMap&action=Uninstall';
		}
	}

jQuery( document ).ready(function() {
    jQuery(":checkbox[name^='modules_']").each(function() {	
		if(this.checked) {
			var arr = this.name.split("_");
			var tabid = arr[1];
			showTable(tabid);
		}
	});
	var js = new Vtiger_Index_Js();
    js.registerEvents();
});

</script>
<?php }} ?>