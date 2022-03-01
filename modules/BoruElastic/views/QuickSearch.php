<?php
class BoruElastic_QuickSearch_View extends Vtiger_Basic_View {

	function __construct() {
		parent::__construct();
		$this->exposeMethod('showSearchResults');
	}

	function checkPermission() { }

	function preProcess(Vtiger_Request $request) {
		return true;
	}

	function postProcess(Vtiger_Request $request) {
		return true;
	}
	
	function process(Vtiger_Request $request) {
		$mode = $request->get('mode');
		if(!empty($mode)) {
			$this->invokeExposedMethod($mode, $request);
		}
		return;
	}
	
	function showSearchResults(Vtiger_Request $request) {
		$viewer = $this->getViewer($request);
		$moduleName = $request->getModule();
		$query = $request->get('value');
		$model = new BoruElastic_BoruElastic_Model();
		
		$searchResults = array();
		$counts = array();
		$data = $model->search($query);
		
		$total = 0;
		foreach($data["records"] as $crmid=>$record) {
			$setype = $record["_type"];
			if(Users_Privileges_Model::isPermitted($record["_type"], 'DetailView', $crmid)) {
				$array = array();
				$recordInstance = Vtiger_Record_Model::getInstanceById($crmid);
				$moduleName = $recordInstance->getModuleName();
				$total++;
				if(!isset($counts[$moduleName])) $counts[$moduleName]=0;
				$counts[$moduleName]++;
				if(!isset($searchResults[$moduleName]) || count($searchResults[$moduleName])<5)
					$searchResults[$moduleName][$crmid] = $recordInstance;
			}
		}

		$viewer->assign("COUNTS", $counts);
		$viewer->assign("TOTAL", $total);
		$viewer->assign('MODULE', $moduleName);
		$viewer->assign('MATCHING_RECORDS', $searchResults);
		$viewer->assign('IS_ADVANCE_SEARCH', false);
		$viewer->assign('QUERY',$query);

		$viewer->view('SearchResultsQuick.tpl', "BoruElastic");
		//if(Users_Privileges_Model::isPermitted($row['setype'], 'DetailView', $row['crmid']))
	}
}