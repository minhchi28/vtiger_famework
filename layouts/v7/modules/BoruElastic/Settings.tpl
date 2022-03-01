{strip}
{assign var=WIDTHTYPE value=$CURRENT_USER_MODEL->get('rowheight')}
<style type="text/css">
.content-area-boru	{    
	padding-left: 70px;
    width: 100%;
    min-height: 768px;
    padding-top: 20px;
    padding-right: 70px;
    background: #f9f9f9;

}
.block{
	background: #ffffff!important;
}
</style>
<div class="main-container main-container-{$MODULE}">
<div id="modnavigator" class="module-nav">
    <div class="hidden-xs hidden-sm mod-switcher-container">
        {include file="partials/Menubar.tpl"|vtemplate_path:$MODULE}
    </div>
</div>
<div class="detailViewContainer">
	<div class="content-area-boru">
		<div class="block">
			<div class="fieldBlockContainer">
				<h4 class="">Server Settings</h4>
				<hr>
				<table id="elasticServerSettings" align="center" class="table table-borderless">
					
					<tbody>
					<tr>
						<td class="{$WIDTHTYPE}">
							<label class="fieldLabel alignMiddle"><b>Host</b></label>
						</td>
						<td class="fieldValue {$WIDTHTYPE}" >
							<input class="inputElement" type="text" name="bes_host" id="bes_host" value="{$BES_HOST}" placeholder="localhost">
						</td>
					</tr>
					<tr>
						<td class="{$WIDTHTYPE}">
							<label class="fieldLabel alignMiddle"><b>Port</b></label>
						</td>
						<td class="fieldValue {$WIDTHTYPE}" >
							<input class="inputElement" type="text" name="bes_port" id="bes_port" value="{$BES_PORT}" placeholder="9200">
						</td>
					</tr>
					<tr>
						<td class="{$WIDTHTYPE}">
							<label class="fieldLabel alignMiddle"><b>Prefix</b></label>
						</td>
						<td class="fieldValue {$WIDTHTYPE}" >
							<input class="inputElement" type="text" name="bes_prefix" id="bes_prefix" value="{$BES_PREFIX}" placeholder="vtiger">
							<input type="hidden" name="bes_prefix_orig" id="bes_prefix_orig" value="{$BES_PREFIX}">
						</td>
					</tr>
					<tr>
						<td colspan="1" align="right">
							<button class="btn btn-success" onclick="BEsaveServerSettings()"><strong>{vtranslate('LBL_SAVE', $QUALIFIED_MODULE)}</strong></button>
						</td>
					</tr>
					</tbody>
				</table>
			</div>
		</div>
		<br>
		<div class="block">
		<div class="fieldBlockContainer">
			<div class="col-sm-11">
				<h4 class="">Select Modules</h4>
			</div>
			<div style="margin-top: 7px">
				<button class="btn btn-success" onClick="BEsaveSettings()"><strong>{vtranslate('LBL_SAVE', $QUALIFIED_MODULE)}</strong></button>
			</div>
			<hr>
			<span class="pull-right">
							
						</span>
			<table id="elasticModuleSettings"  align="center" class="table table-borderless">
				
				<tbody>
				{foreach from=$MODULES_ALL key=TABID item=BESMODULE}
					<tr>
						<td class="{$WIDTHTYPE}" style="width:20px">
							<input class="modulesCheckBox alignTop" type="checkbox" name="modules_{$TABID}" id="modules_{$TABID}" value="1" {if isset($ENABLED_MODULES[$TABID])}checked="checked"{/if}>
						</td>
						<td class="{$WIDTHTYPE}" style="width:20px">
							<label class="pull-left fieldLabel alignMiddle"><b>{$BESMODULE->get('label')|vtranslate:$BESMODULE->getName()}</b></label>
						</td>
						<td class="fieldValue {$WIDTHTYPE}">
							<div id="table_{$TABID}" style="display:none; width:100%;">
								<h4 align="center">Select {$BESMODULE->get('label')|vtranslate:$BESMODULE->getName()} fields to search</h4>
								<hr>
								<table class="table table-borderless">
								<tbody>
								{assign var=COUNTER value=0}
								{foreach from=$BESMODULE->getFields() key=FIELD_NAME item=FIELD_MODEL name="fields"}
									{if $FIELD_MODEL->isActiveField()}
									{assign var="FIELD_ID" value=$FIELD_MODEL->getId()}
									{if $COUNTER % 4 == 0}
										<tr>
									{/if}
									<td width="25%" style="">
										<input class="modulesCheckBox alignTop" type="checkbox" name="fields_{$TABID}_{$FIELD_ID}" id="fields_{$TABID}_{$FIELD_ID}" value="1" {if isset($ENABLED_MODULES[$TABID][$FIELD_ID])}checked="checked"{/if}>&nbsp;
										{vtranslate($FIELD_MODEL->get('label'), $BESMODULE->getName())}</td>
									</td>
									{if $smarty.foreach.fields.last OR ($COUNTER+1) % 4 == 0}
										</tr>
									{/if}
									{assign var=COUNTER value=$COUNTER+1}
									{/if}
								{/foreach}
								</tbody>
								</table>
							</div>
						</td>
					</tr>
				{/foreach}
				</tbody>
			</table>
		</div>
		</div>

	</div>
	<div class="row-fluid">
		<div class="span12">
			
		</div>
	</div>
</div>
{/strip}
{literal}
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
{/literal}