/*********************************************************************************
 * The contents of this file are copyright to Target Integration Ltd and are governed
 * by the license provided with the application. You may not use this file except in 
 * compliance with the License.
 * For support please visit www.targetintegration.com 
 * or email support@targetintegration.com
 * All Rights Reserved.
 *********************************************************************************/

 function BEsaveServerSettings(type,id) {    
	var host = jQuery("#bes_host").val();
	var port = jQuery("#bes_port").val();
	var prefix = jQuery("#bes_prefix").val();
	var prefix_orig = jQuery("#bes_prefix_orig").val();
	
	
	if(host.length<=0 || port.length<=0 || prefix.length<=0) {
		//var data = alertDialog('Missing Data','Please specify an Elastic Server Host and Port, as well as an index prefix.');
		app.helper.showErrorNotification({"message":'Please specify an Elastic Server Host and Port, as well as an index prefix.'});
		//app.showModalWindow(data,{'text-align' : 'left'});
	} else {
		
		if(prefix_orig.length>0 && prefix != prefix_orig) {
			var conf=confirm("Changing the prefix will force a full re-index. If you have a lot of records, this could take a long time. Are you sure you want to continue?");
			if(!conf) {
				return false;
			}
		}
		
		var params = {
			'module' : 'BoruElastic',
			'action': "Ajax",
			'mode' : 'saveServerSettings',
			'host' : host,
			'port' : port,
			'prefix' : prefix
		}
		app.helper.showProgress();
		AppConnector.request(params).then(
			function(responseData){
				app.helper.hideProgress();
				if(responseData != null && responseData.result.success=='success'){
					app.helper.showAlertBox({'message':'Server settings have been saved.'});
				}
			},

			function(textStatus, errorThrown){
					app.helper.hideProgress();
			}
		);
	}
}
function BEsaveSettings(type,id) {    
	var enabled = {};
	jQuery(":checkbox[name^='modules_']").each(function() {	
		if(this.checked) {
			var arr = this.name.split("_");
			var tabid = arr[1];
			var that=this;
			
			var module = [];
			
			jQuery(":checkbox[name^='fields_"+tabid+"_']").each(function() {
				
				if(this.checked) {
					var farr = this.name.split("_");
					var fieldid = farr[2];
					console.log("Checked field for tabid "+tabid+": "+fieldid);
					module.push("f_"+fieldid);
				}
			});
			enabled["m_"+tabid] = module;
		}
	});
	var params = {
		'module' : 'BoruElastic',
		'action': "Ajax",
		'mode' : 'saveModuleSettings',
		'modules' : enabled
	}
	
	app.helper.showProgress();
	AppConnector.request(params).then(
		function(responseData){
			app.helper.hideProgress();
			if(responseData != null && responseData.result.success=='success'){
				app.helper.showAlertBox({'message':'Module settings have been saved.'});
			}
		},

		function(textStatus, errorThrown){
		}
	);
}
function alertDialog(header,message) {
	var str = ' \
		<div class="modelContainer"> \
			<div class="modal-header contentsBackground"> \
				<button title="Close" type="button" data-dismiss="modal" aria-hidden="true" class="close">x</button> \
				<h3>'+header+'</h3> \
			</div> \
			<div class="modal-body"> \
				<p align="center">'+message+'</p> \
			</div> \
			<div class="modal-footer quickCreateActions"> \
				<button data-dismiss="modal" type="button" class="btn btn-success" id="import-cms"><strong>Ok</strong></button> \
			</div> \
		</div> \
	';
	return str;
}