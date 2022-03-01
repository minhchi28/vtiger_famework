<?php
/*
Most of the elastic search stuff is in the preProcess so that the left side tabs can access counts/etc
*/
class BoruElastic_List_View extends Vtiger_Index_View {
	protected $listViewEntries = false;
	protected $listViewCount = false;
	protected $listViewLinks = false;
	protected $listViewHeaders = false;
	
	protected $enabledModules;
	protected $moduleModels;
	protected $searchResults;
	protected $selectedMod;
	protected $es;
	
	protected $userPrivilegesModel;
	protected $userModel;
	
	function __construct() {
		parent::__construct();
		$model = new BoruElastic_BoruElastic_Model();
		$enabledModules = $model->getAllModuleConfig(true);
		foreach($enabledModules as $enmod) {
			$this->enabledModules[$enmod["name"]] = $enmod;
		}
		$this->es = $model;
	}

	function checkPermission(Vtiger_Request $request) {
		//Return true as WebUI.php is already checking for module permission
		$mycur = getcwd();
		chdir(dirname(_FILE_));
		require "Boru.php";
		$boruLicenseValidation = new BoruLicense("BoruElastic");
		$boruUserLimit = $boruLicenseValidation->message;
		chdir($mycur);
		return true;
	}
	
	public function preProcess (Vtiger_Request $request, $display=true) {
		parent::preProcess($request, false);

                $viewer = $this->getViewer($request);

		$moduleName = $request->getModule();
		if(empty($moduleName)) $moduleName = "BoruElastic";
		
		$moduleModel = Vtiger_Module_Model::getInstance($moduleName);
		$this->userModel = Users_Record_Model::getCurrentUserModel();
		$this->userPrivilegesModel = $userPrivilegesModel = Users_Privileges_Model::getInstanceById($this->userModel->getId());
		$permission = $this->userPrivilegesModel->hasModulePermission($moduleModel->getId());
		$viewer->assign('MODULE', $moduleName);

		if(!$permission) {
			$viewer->assign('MESSAGE', 'LBL_PERMISSION_DENIED');
			$viewer->view('OperationNotPermitted.tpl', $moduleName);
			exit;
		}

		$linkParams = array('MODULE'=>$moduleName, 'ACTION'=>$request->get('view'));
		$linkModels = $moduleModel->getSideBarLinks($linkParams);

		$viewer->assign('QUICK_LINKS', $linkModels);
		
		$viewer->assign('CURRENT_USER_MODEL', $this->userModel);
		$viewer->assign('CURRENT_VIEW', $request->get('view'));
		
		
		//Elastic stuff here
		$this->searchResults = array();
		$query = $request->get("query");
		if(!empty($query)) {
			$data = $this->es->search($query);
			foreach($data["records"] as $crmid=>$record) {
				$setype = $record["_type"];
				if(Users_Privileges_Model::isPermitted($record["_type"], 'DetailView', $crmid) && isRecordExists($crmid)) {
					$array = array();
					$recordInstance = Vtiger_Record_Model::getInstanceById($crmid);
					$moduleName = $recordInstance->getModuleName();
					$this->searchResults[$moduleName][$crmid] = $recordInstance;
				}
			}
		}
		
		$relmod = $request->get("relmod");
		$this->selectedMod = "none";
		foreach($this->enabledModules as $k=>$enmod) {
			$moduleModel = Vtiger_Module_Model::getInstance($enmod["name"]);
			$permission = $this->userPrivilegesModel->hasModulePermission($moduleModel->getId());
			if(!$permission) {
				unset($this->enabledModules[$k]);
			} else {
				$this->enabledModules[$k]["model"] = $moduleModel;
				$this->enabledModules[$k]["headers"] = $this->getHeadersFromModuleModel($moduleModel);
				if(isset($this->searchResults[$enmod["name"]]))
					$this->enabledModules[$k]["count"] = count($this->searchResults[$enmod["name"]]);
				else
					$this->enabledModules[$k]["count"] = 0;
				if($relmod == $enmod["name"]) {
					$this->selectedMod = $enmod["name"];
				}
				
			}
		}
		
		$count = 0;
		foreach($this->searchResults as $moduleName=>$results) {
			$found = false;
			foreach($this->enabledModules as $k=>$enmod) {
				if($enmod["name"] == $moduleName) {
					$found=true;
					break;
				}
			}
			if(!$found)
				unset($this->searchResults[$moduleName]);
			else
				$count+=count($this->searchResults[$moduleName]);
		}
		$viewer->assign("COUNT",$count);
		$viewer->assign("QUERY",$query);
		$viewer->assign("ENABLED_MODULES",$this->enabledModules);
		$viewer->assign("MODSELECTED",$this->selectedMod);
		$viewer->assign('MATCHING_RECORDS', $this->searchResults);
		
		if($display) {
			$this->preProcessDisplay($request);
		}
	}
	
	/*function preProcessTplName(Vtiger_Request $request) {
		return 'SearchViewPre.tpl';
	}*/


	function process (Vtiger_Request $request) {
		$viewer = $this->getViewer ($request);
		$moduleName = $request->getModule();
		$moduleModel = Vtiger_Module_Model::getInstance($moduleName);

		$viewer->assign('VIEW', $request->get('view'));
		$viewer->assign('MODULE_MODEL', $moduleModel);
		$viewer->assign('CURRENT_USER_MODEL', $this->userModel);
		
		$query = $request->get("query");
		$viewer->assign("QUERY",$query);
		$viewer->assign("ENABLED_MODULES",$this->enabledModules);
		$viewer->assign("MODSELECTED",$this->selectedMod);
		$viewer->assign('MATCHING_RECORDS', $this->searchResults);
		
		$viewer->view('SearchView.tpl', $moduleName);
	}
	
	function postProcess(Vtiger_Request $request) {
		$viewer = $this->getViewer ($request);
		$moduleName = $request->getModule();

		$viewer->view('SearchViewPost.tpl', $moduleName);
		parent::postProcess($request);
	}
	
	
	public function getHeadersFromModuleModel($moduleModel) {
		$summaryFieldsList = $moduleModel->getSummaryViewFieldsList();

		$headerFields = array();
		if(count($summaryFieldsList) > 0) {
			foreach($summaryFieldsList as $fieldName => $fieldModel) {
				$headerFields[$fieldName] = $fieldModel;
			}
		} else {
			$headerFieldNames = $moduleModel->getRelatedListFields();
			foreach($headerFieldNames as $fieldName) {
				$headerFields[$fieldName] = $moduleModel->getField($fieldName);
			}
		}
		//echo "<pre>";
		//var_dump($headerFields);
		//exit();
		return $headerFields;
	}
}
