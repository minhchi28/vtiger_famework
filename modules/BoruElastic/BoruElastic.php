<?php
require_once 'vtlib/Vtiger/Module.php';

class BoruElastic {
	/**
	 * Invoked when special actions are performed on the module.
	 * @param String Module name
	 * @param String Event Type (module.postinstall, module.disabled, module.enabled, module.preuninstall)
	 */
	function vtlib_handler($modulename, $event_type) {
		if($event_type == 'module.postinstall') {
			self::addWidgetTo(array('Contacts','Accounts','Leads'));
			self::defaultValues();
		} else if($event_type == 'module.disabled') {
			// TODO Handle actions when this module is disabled.
		} else if($event_type == 'module.enabled') {
			// TODO Handle actions when this module is enabled.
		} else if($event_type == 'module.preuninstall') {
			// TODO Handle actions when this module is about to be deleted.
		} else if($event_type == 'module.preupdate') {
			// TODO Handle actions before this module is updated.
		} else if($event_type == 'module.postupdate') {		
			self::addWidgetTo(array('Contacts','Accounts','Leads'));	
		}
	}
	/**
	 * Add widget to other module.
	 * @param unknown_type $moduleNames
	 * @return unknown_type
	 */
	static function addWidgetTo($moduleNames, $widgetType='LISTVIEWSIDEBARWIDGET', $widgetName='Boru ElasticSearch') {
		if (empty($moduleNames)) return;
		
		include_once 'vtlib/Vtiger/Module.php';
		
		if (is_string($moduleNames)) $moduleNames = array($moduleNames);
		
		$commentWidgetCount = 0; 
		foreach($moduleNames as $moduleName) {
			$module = Vtiger_Module::getInstance($moduleName);
			if($module) {
				$module->addLink($widgetType, $widgetName, 'module=BoruElastic&view=Widget');
				++$commentWidgetCount;
			}
		}		
	}
	
	static function defaultValues() {
		global $adb;
		
	}
}
?>
