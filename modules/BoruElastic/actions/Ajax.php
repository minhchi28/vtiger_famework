<?php
/*********************************************************************************
** The contents of this file are subject to the vtiger CRM Public License Version 1.0
* ("License"); You may not use this file except in compliance with the License
* The Original Code is:  vtiger CRM Open Source
* The Initial Developer of the Original Code is vtiger.
* Portions created by vtiger are Copyright (C) vtiger.
* All Rights Reserved.
*
********************************************************************************/

class BoruElastic_Ajax_Action extends Vtiger_Action_Controller {
	function checkPermission(Vtiger_Request $request) {
		return;
	}
	public function process(Vtiger_Request $request) {
		parent::__construct();
		$mode = $request->get("mode");
		if($mode == "quickSearch") {
			$this->quickSearch($request);
		}
		if($mode == "checkEnabled") {
			$this->checkEnabled($request);
		}
		if($mode == "saveModuleSettings") {
			$this->saveModuleSettings($request);
		}
		if($mode == "saveServerSettings") {
			$this->saveServerSettings($request);
		}
	}
	function checkEnabled(Vtiger_Request $request) {
		$result["enabled"] = "yes";
		$response = new Vtiger_Response();
		$response->setResult($result);
		$response->emit();
	}
	function saveServerSettings(Vtiger_Request $request) {
		global $adb;
		$host = $request->get("host");
		$port = $request->get("port");
		$prefix = strtolower($request->get("prefix"));
		$prefix = preg_replace("/[^A-Za-z0-9 ]/", '', $prefix);
		
		$model = new BoruElastic_BoruElastic_Model();
		$conf = $model->getConfig();
		if($prefix != $conf["prefix"]) {
			$sql = "truncate table vtiger_boruelastic_rel";
			$adb->query($sql);
		}
		
		$sql = "delete FROM vtiger_boruelastic_serverconfig";
		$adb->query($sql);
		$sql = "insert into `vtiger_boruelastic_serverconfig` SET `host`=?, `port`=?, `prefix`=?";
		$adb->pquery($sql,array($host,$port,$prefix));
		$result["success"] = "success";
		$response = new Vtiger_Response();
		$response->setResult($result);
		$response->emit();
	}
	function saveModuleSettings(Vtiger_Request $request) {
		global $adb;
		
		$modules = $request->get("modules");
		$cleanmodules = array();
		$enabled_modules = array();
		$enabled_string = "";
		foreach($modules as $mk=>$mv) {
			
			list($m0,$tabid) = explode("_",$mk);
			
			$enabled_string.="?,";
			$enabled_modules[] = $tabid;
			
			$mstring = "";
			foreach($mv as $fk=>$fv) {
				list($f0,$fieldid) = explode("_",$fv);
				$cleanmodules[$tabid][] = $fieldid;
			}
			$mstring = implode(",",$cleanmodules[$tabid]);
			$sql = "insert into `vtiger_boruelastic_moduleconfig` (`tabid`,`enabled`,`fields`) VALUES (?,?,?) ON DUPLICATE KEY UPDATE `enabled`=?, `fields`=?";
			$adb->pquery($sql,array($tabid,1,$mstring,1,$mstring));
		}
		$enabled_string = trim($enabled_string,",");
		if($enabled_string != "") {
			$sql = "update vtiger_boruelastic_moduleconfig SET `enabled`=0 WHERE `tabid` NOT IN ($enabled_string)";
			$adb->pquery($sql,$enabled_modules);
		} else {
			$sql = "update vtiger_boruelastic_moduleconfig SET `enabled`=0";
			$adb->query($sql);
		}
		
		
		$result["success"] = "success";
		$result["modules"] = $cleanmodules;
		$response = new Vtiger_Response();
		$response->setResult($result);
		$response->emit();
	}
}
?>
