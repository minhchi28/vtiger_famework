jQuery(document).ready(function(){
	BESinit();
});

function BESinit() {
	var params = {
		'module' : 'BoruElastic',
		'action': "Ajax",
		'mode' : 'checkEnabled'
	}
	AppConnector.request(params).then(
		function(responseData){
			if(responseData != null && responseData.result.enabled=='yes'){
				BESrebindSearch();
			}
		},

		function(textStatus, errorThrown){
		}
	);
}

function BESrebindSearch() {
	//jQuery('.adv-search').css('display','none');
	jQuery('#basicSearchModulesList_chzn').css('display','none');
	jQuery(".keyword-input").unbind("keypress");
	jQuery(".keyword-input").on('keyup', BESdoSearch);
	jQuery('.keyword-input').keypress(function(e) {
		var currentTarget = jQuery(e.currentTarget)
		if (e.which == 13) {
			//var val = jQuery(".keyword-input").val();
			//window.location.href = 'index.php?module=BoruElastic&view=List&query='+val;
			BESforceSearch();
		}
	});
}

function BESdoSearch(ev,clear) {
	clear = typeof force !== 'undefined' ? clear : false;
	
	var val = jQuery(".keyword-input").val();
	
	if(BESdoSearch.timeout) {
		clearTimeout(BESdoSearch.timeout)
	}
	
	var target=this;
	if(!clear && val != '') {
		BESdoSearch.timeout = setTimeout(function() {
			//BESexecuteSearch.call(target, ev);
		},800);
	}
}
function BESforceSearch() {
	BESdoSearch(null,true);
	BESexecuteSearch();
}

function BESexecuteSearch() {
	var val = jQuery(".keyword-input").val();
	if (val == '') {
		BESalertDialog('Error',app.vtranslate('JS_PLEASE_ENTER_SOME_VALUE'));
		jQuery(".keyword-input").focus();
		return false;
	}
	//var progress = jQuery.progressIndicator();
	app.helper.showProgress();
	//return false;
	BESsearch(val).then(function(data) {
		BESshowSearchResults(data);	
		/*progress.progressIndicator({
			'mode': 'hide'
		});*/
		app.helper.hideProgress();
	});
}

function BESshowSearchResults(data){
	var aDeferred = jQuery.Deferred();
	var postLoad = function(data) {
		var blockMsg = jQuery(data).closest('.content-search-quick');
		//app.showScrollBar(jQuery(data).find('.contents'));
		app.helper.showScroll(jQuery(data).find('.contents'));
		blockMsg.position({
			my: "left bottom",
			at: "left bottom",
			of: ".keyword-input",
			offset: "1 -29"
		});
		aDeferred.resolve(data);
	}
	var params = {};
	params.data = data ;
	params.cb = postLoad;
	params.css = {'width':'23%','text-align':'left'};
	//not showing overlay
	params.overlayCss = {'opacity':'0.2'};
	//app.showModalWindow(params);
	app.helper.showModal(data.result,params);
	return aDeferred.promise();
}

function BES_search(params) {
	var aDeferred = jQuery.Deferred();

	if(typeof params == 'undefined') {
		params = {};
	}
	params.module = 'BoruElastic';
	params.view = 'QuickSearch';
	params.mode = 'showSearchResults';

	AppConnector.request(params).then(
		function(data){
			aDeferred.resolve(data);
		},

		function(error,err){
			aDeferred.reject(error);
		}
	);
	return aDeferred.promise();
}
function BESsearch (value) {
	var params = {};
	params.value = value;
	
	return BES_search(params);
}

function BESalertDialog (header,message) {
	var str = ' \
		<div class="modal-content" style="max-width: 415px;margin: auto;"> \
		<div > \
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
		</div> \
	';
	//app.showModalWindow(str,{'text-align' : 'left'});
	app.helper.showModal(str,{'text-align' : 'left'});
}