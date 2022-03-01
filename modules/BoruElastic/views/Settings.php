<?php	
/*$mycur = getcwd();
chdir(dirname(_FILE_));
require "Boru.php";
$boruLicenseValidation = new BoruLicense("GoogleMap");
$boruUserLimit = $boruLicenseValidation->message;
chdir($mycur);*/

class BoruElastic_Settings_View extends Vtiger_Index_View{

	function process(Vtiger_Request $request) {
        // check boru license
        $mycur = getcwd();
		chdir(dirname(_FILE_));
		require "Boru.php";
		$boruLicenseValidation = new BoruLicense("BoruElastic");
		$boruUserLimit = $boruLicenseValidation->message;
		chdir($mycur);
		$this->renderSettingsUI($request);
	}

	function renderSettingsUI(Vtiger_Request $request) {
		require_once('include/utils/utils.php');
/*		require_once('GoogleMapUtils.php');*/
		$adb = PearDatabase::getInstance();

		$default_language = VTWS_PreserveGlobal::getGlobal('default_language');
		global $current_language;
		if(empty($current_language)) $current_language = $default_language;
		$current_language = vtws_preserveGlobal('current_language',$current_language);
		$mod_strings_new = return_module_language($current_language,'BoruElastic');
		$app_strings = return_application_language($current_language);

		
		$smarty = $this->getViewer($request);
		$smarty->assign('CURRENT_USER_MODEL', Users_Record_Model::getCurrentUserModel());
		
		$thisModule = $_REQUEST['module'];
		$smarty->assign('MODULE_LBL',getTranslatedString($thisModule));
		
		$smarty->assign("MOD_NEW",$mod_strings_new);
		$smarty->assign("APP",$app_strings);

		$all_modules = $this->listModules();

		$smarty->assign("MODULES_ALL",$all_modules);
		
		$sql = "select * from vtiger_boruelastic_moduleconfig WHERE `enabled`=1";
		$result = $adb->query($sql);
		$enabled_modules = array();
		while($result && $row=$adb->fetch_row($result)) {
			$fields = explode(",",$row["fields"]);
			foreach($fields as $k=>$field) {
				$enabled_modules[$row["tabid"]][$field] = 1;
			}
			
		}
		$smarty->assign("ENABLED_MODULES",$enabled_modules);

		$host = $port = "";
		$sql = "select * from vtiger_boruelastic_serverconfig";
		$result = $adb->query($sql);
		while($result && $row=$adb->fetch_row($result)) {
			$host = $row["host"];
			$port = $row["port"];
			$prefix = $row["prefix"];
		}
		$smarty->assign("BES_HOST",$host);
		$smarty->assign("BES_PORT",$port);
		$smarty->assign("BES_PREFIX",$prefix);
		
		$smarty->view('Settings.tpl', $request->getModule());
	}
	
	
	function listModules() {
		require_once('include/utils/utils.php');
		global $adb;
		
		$sql = "SELECT * FROM vtiger_tab WHERE isentitytype=1 AND presence <> 1 ORDER BY `tablabel` ASC";
		$result = $adb->query($sql);
		$modules = array();
		while($result && $row=$adb->fetch_row($result)) {
			$modules[$row["tabid"]] = Vtiger_Module_Model::getInstanceFromArray($row);
		}
		return $modules;
	}
}

?>