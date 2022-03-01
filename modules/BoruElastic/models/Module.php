<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 * ************************************************************************************/

class BoruElastic_Module_Model extends Vtiger_Module_Model {

	/**
	 * Vince Winton
	 * Function to get Settings links
	 * @return <Array>
	 */
	function getSettingLinks() {
		$settingsLinks[] = array(
			'linktype' => 'MODULESETTING',
			'linklabel' => 'Settings',
            'linkurl' => 'index.php?module=BoruElastic&view=Settings',
			'linkicon' => ''
		);
		$settingsLinks[] = array(
            'linktype' => 'MODULESETTING',
            'linklabel' => 'Uninstall',
            'linkurl' => 'index.php?module=BoruElastic&view=Uninstall',
            'linkicon' => ''
        );
		return $settingsLinks;
	}
}
