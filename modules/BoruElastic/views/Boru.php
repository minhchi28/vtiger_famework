<?php
class BoruLicense {
	var $module = "";
	var $cypher = "";
	var $featurestring = "";
	var $result = "";
	var $message = 100;
	var $expires = "";
	var $valid = false;
	var $file = "";
	var $productName = "";
	var $who = "";
	var $license = "";
	var $server = "";
	var $url = "";
	function BoruLicense($module="",$url="") {
		return true;
	}
	function install() {
		exit();
	}
	function printDeactivateLink() {
	}
	function deactivate() {
	}
	function setDefaults() {
	}
	function readLicenseFile() {
	
	}
	function validate() {
		return true;
	}
	function checkValidate() {
	}
	function createBoruFile($product,$who,$license,$features,$message="",$expires="") {
			
	}
	function encrypt($str){
	}
	function decrypt($str){
	}
	function write_file ($filename,$content) {
	}
}
function gssX($str_All, $start_str="included in output", $end_str="included in output") {
}
?>