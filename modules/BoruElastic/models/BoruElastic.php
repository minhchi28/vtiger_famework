<?php
require_once("modules/BoruElastic/lib/class_dhes.php");
class BoruElastic_BoruElastic_Model extends Vtiger_Base_Model {
	var $debug = true;
	var $prefix = "vtiger";
	var $elastic;
	function  __construct($values=array()) {
		parent::__construct($values);
		$esconfig = $this->getConfig();
		$this->es = new dhes($esconfig);
		$this->prefix = strtolower($esconfig["prefix"]);
	}
	
	function search($query,$size=500,$from=0,$type="") {
		if($type == "") 
			$type = "dfs_query_then_fetch";
		$allCfg = $this->getAllModuleConfig(true);
		$fieldarr = array();
		foreach($allCfg as $cfg) {
			$fields = $this->getFieldsFromCfg($cfg);
			foreach($fields as $field) {
				$fieldarr[] = $cfg["name"]."-".$field["columnname"];
			}
		}
		$query = '
			{
				"query": {
					"dis_max": {
						"queries": [
							{
								"multi_match": {
									"fields":'.json_encode($fieldarr).',
									"query": "'.$query.'",
									"type": "phrase",
									"boost": 5
								}
							},
							{
								"query_string": {
									"fields":'.json_encode($fieldarr).',
									"query": "'.$query.'*",
									"boost": 2
								}
							},
							{
								"query_string": {
									"fields":'.json_encode($fieldarr).',
									"query": "*'.$query.'"
								}
							}
						]
					}
				}
			}
		';

		$results = $this->es->search($query,$this->prefix."-*",$size,$from,$type);
		if(!isset($results["hits"])
			|| !isset($results["hits"]["total"])
			|| $results["hits"]["total"]<=0
			|| !isset($results["hits"]["hits"])
			|| !is_array($results["hits"]["hits"])
			|| count($results["hits"]["hits"])<=0
		){
			//No matches, return false;
			return false;
		}
		
		$result = array();
		$result["total"] = $results["hits"]["total"];
		$result["size"] = $size;
		$result["from"] = $from;
		$result["records"] = array();
		foreach($results["hits"]["hits"] as $k=>$record) {
			$result["records"][$record["_id"]] = $record;
		}
		return $result;
		//need to do this for each result before adding it to the results array
		//if(Users_Privileges_Model::isPermitted($row['setype'], 'DetailView', $row['crmid']))
	}
	
	function indexAllRecords($tabid,$cfg = array(),$reindex=false) {
		$this->printDebug(__METHOD__." > Start");
		global $adb;
		
		if(empty($cfg)) $cfg = $this->getModuleconfig($tabid);
		
		
		//Init the module model to save on doing it for every record returned.
		$module = Vtiger_Module_Model::getInstance($cfg["name"]);
		
		$moduleFields = $module->getFields();
		
		//Init a cache array to save on calls.
		$cacheArray = array();
		
		//Build a list of fields based on the module config in ES
		//$fields = $this->getFieldsFromCfg($cfg);
		
		//If we don't have any fields, dont waste time cycling through records.
		//if(count($fields)<=0) {
		//	$this->printDebug(__METHOD__." > 0 fields / End");
		//	return false;
		//}
		//$adb->SetDebug(true);
		//Here's the query we'll cycle with
		if(!$reindex) {
			//Only send new records
			$sql = "SELECT
					e.crmid,
					e.label,
					e.createdtime,
					e.smcreatorid,
					u1.user_name AS created_user,
					e.modifiedtime,
					e.modifiedby,
					u2.user_name AS modified_user,
					e.smownerid,
					u3.user_name AS assigned_user,
					e.deleted,
					sync.synctime
				FROM vtiger_crmentity e 
					LEFT JOIN vtiger_users u1 ON u1.id = e.smcreatorid 
					LEFT JOIN vtiger_users u2 ON u2.id = e.modifiedby 
					LEFT JOIN vtiger_users u3 ON u3.id = e.smownerid 
					LEFT JOIN vtiger_boruelastic_rel sync ON sync.crmid=e.crmid
				WHERE e.setype=?
				AND (sync.crmid IS NULL OR sync.synctime<=e.modifiedtime)
				ORDER BY e.crmid ASC LIMIT ?,?
			";
		} else {
			//send all records.
			$sql = "SELECT
					e.crmid,
					e.label,
					e.createdtime,
					e.smcreatorid,
					u1.user_name AS created_user,
					e.modifiedtime,
					e.modifiedby,
					u2.user_name AS modified_user,
					e.smownerid,
					u3.user_name AS assigned_user,
					e.deleted,
					sync.synctime
				FROM vtiger_crmentity e 
					LEFT JOIN vtiger_users u1 ON u1.id = e.smcreatorid 
					LEFT JOIN vtiger_users u2 ON u2.id = e.modifiedby 
					LEFT JOIN vtiger_users u3 ON u3.id = e.smownerid 
					LEFT JOIN vtiger_boruelastic_rel sync ON sync.crmid=e.crmid
				WHERE e.setype=?
				ORDER BY e.crmid ASC LIMIT ?,?
			";
		}
		
		
		//Now lets cycle through the records.. increasing $offset by $torun each time, until we have no records returned (numresults=0).
		$numresults = 1;
		$torun = 500;
		$offset = 0;
		$completed = 0;
		while($numresults>0) {
			//Reset the records array
			$records = array();
			$updaterecords = array();
			$deleterecords = array();
			//Run the query
			$result = $adb->pquery($sql,array($cfg["name"],$offset,$torun));
			$rows = $result->GetRows();
			
			//Numresults
			$numresults = count($rows);
			
			//If we have results lets do this thing
			if(is_array($rows) && $numresults>=1) {
				foreach($rows as $row) {
					$record = array();
					
					$record_synctime = $row["synctime"];
					
					if($row["deleted"]>=1) {
						
						$record["@crmid"] = $row["crmid"];
						$deleterecords[] = $record;
						
					
					} else {
						unset($row["deleted"]);
						unset($row["synctime"]);
						//Create a record object from the result
						$recordObj = Vtiger_Record_Model::getInstanceById($row["crmid"],$module);
						
						
						foreach($row as $kk=>$field) {
							if(!is_int($kk)) {
								$record["@".$kk] = strtolower($field);
							}
						}
						
						/*foreach($fields as $field) {
							$fieldcol = $field["columnname"];
							$record[$fieldcol] = $recordObj->get($fieldcol);
						}*/
						foreach($moduleFields as $k=>$field) {
							$uitype = $field->get('uitype');
							$fieldname = $field->getName();
							$fieldcol = $field->get('column');
							$value = $recordObj->get($fieldname);
							if($uitype == 10) {
								$value = $this->getReferenceDisplay($field,$value);
							} elseif($uitype == 53) {
								$value = getOwnerName($value);
							}
							$record[$cfg["name"]."-".$fieldcol] = $value;
						}
						if($record_synctime != "")
							$updaterecords[] = $record;
						else
							$records[] = $record;
					}
				}
				if(!empty($deleterecords))
					$this->deleteRecords($tabid,$deleterecords);
				if(!empty($records))
					$this->indexRecords($tabid,$records);
				if(!empty($updaterecords))
					$this->updateRecords($tabid,$updaterecords);
				$completed+=$numresults;
			} else {
				//Just error checking to keep us out of infinite loops
				$numresults = 0;
			}
			//Update the offset and do it again
			$offset+=$torun;
		}
		
		$this->printDebug("Synced $completed ".$cfg["name"]." records");
		$this->printDebug(__METHOD__." > End");
	}
	
	function indexRecords($tabid,$records=array()) {
		global $adb;
		
		$this->printDebug(__METHOD__." > Start");
		if(empty($records)) return array("success"=>false,"message"=>"no records");
		
		$cfg = $this->getModuleconfig($tabid);
		
		$valuestring = "";
		$valuearray = array();
		
		$index = $this->prefix."-".strtolower($cfg["name"]);
		
		foreach($records as $k=>$v) {
			$action["index"] = array(
				"_index"=>$index,
				"_type"=>$cfg["name"],
				"_id"=>$v["@crmid"],
			);
			$this->es->addBulkAction($action,$v);
			$valuestring.=",(?,NOW())";
			$valuearray[] = $v["@crmid"];
		}
		$query_start = "INSERT INTO vtiger_boruelastic_rel (`crmid`,`synctime`) VALUES ";
		$query_end= " ON DUPLICATE KEY UPDATE `synctime`=VALUES(`synctime`)";
		if(!empty($this->es->bulk_data)) {
			$ret = $this->es->bulk();
			$valuestring = trim($valuestring,",");
			//$sql = "insert into vtiger_boruelastic_rel SET `crmid`=?`es_indexed`=NOW() WHERE `crmid` IN ($crmstring)";
			$sql = $query_start.$valuestring.$query_end;
			$adb->pquery($sql,$valuearray);
		}
		$this->printDebug(__METHOD__." > End");
		return array("success"=>true,"count"=>count($crmarray));
		
	}
	function updateRecords($tabid,$records=array()) {
		global $adb;
		
		$this->printDebug(__METHOD__." > Start");
		if(empty($records)) return array("success"=>false,"message"=>"no records");
		
		$cfg = $this->getModuleconfig($tabid);
		
		$valuestring = "";
		$valuearray = array();
		
		$index = $this->prefix."-".strtolower($cfg["name"]);
		
		foreach($records as $k=>$v) {
			$action["update"] = array(
				"_index"=>$index,
				"_type"=>$cfg["name"],
				"_id"=>$v["@crmid"],
			);
			$array = array();
			$array["doc"] = $v;
			$array["doc_as_upsert"] = true;
			$this->es->addBulkAction($action,$array);
			$valuestring.=",(?,NOW())";
			$valuearray[] = $v["@crmid"];
		}
		$query_start = "INSERT INTO vtiger_boruelastic_rel (`crmid`,`synctime`) VALUES ";
		$query_end= " ON DUPLICATE KEY UPDATE `synctime`=VALUES(`synctime`)";
		if(!empty($this->es->bulk_data)) {
			$ret = $this->es->bulk();
			$valuestring = trim($valuestring,",");
			//$sql = "insert into vtiger_boruelastic_rel SET `crmid`=?`es_indexed`=NOW() WHERE `crmid` IN ($crmstring)";
			$sql = $query_start.$valuestring.$query_end;
			$adb->pquery($sql,$valuearray);
		}
		$this->printDebug(__METHOD__." > End");
		return array("success"=>true,"count"=>count($crmarray));
		
	}
	function deleteRecords($tabid,$records=array()) {
		global $adb;
		
		$this->printDebug(__METHOD__." > Start");
		if(empty($records)) return array("success"=>false,"message"=>"no records");
		
		$cfg = $this->getModuleconfig($tabid);
		
		$valuestring = "";
		$valuearray = array();
		
		$index = $this->prefix."-".strtolower($cfg["name"]);
		
		foreach($records as $k=>$v) {
			$action["delete"] = array(
				"_index"=>$index,
				"_type"=>$cfg["name"],
				"_id"=>$v["@crmid"],
			);
			$this->es->addBulkAction($action);
			$valuestring.=",(?,NOW())";
			$valuearray[] = $v["@crmid"];
		}
		$query_start = "INSERT INTO vtiger_boruelastic_rel (`crmid`,`synctime`) VALUES ";
		$query_end= " ON DUPLICATE KEY UPDATE `synctime`=VALUES(`synctime`)";
		if(!empty($this->es->bulk_data)) {
			$ret = $this->es->bulk();
			$valuestring = trim($valuestring,",");
			//$sql = "insert into vtiger_boruelastic_rel SET `crmid`=?`es_indexed`=NOW() WHERE `crmid` IN ($crmstring)";
			$sql = $query_start.$valuestring.$query_end;
			$adb->pquery($sql,$valuearray);
		}
		$this->printDebug(__METHOD__." > End");
		return array("success"=>true,"count"=>count($crmarray));
	}

	function updateModuleConfigVersion($tabid,$version) {
		global $adb;
		$sql = "update `vtiger_boruelastic_moduleconfig` SET `version`=? WHERE `tabid`=?";
		$adb->pquery($sql,array($tabid));
		return true;
	}
	
	//optional BOOLEAN (true/false) for enabled status
	function getAllModuleConfig($enabled="") {
		global $adb;
		$return = array();
		$sql = "select mc.*,t.name,t.tablabel from `vtiger_boruelastic_moduleconfig` mc inner join vtiger_tab t on t.tabid=mc.tabid";
		if(!empty($enabled)) {
			if($enabled===false)
				$sql.=" WHERE `enabled`=0";
			else
				$sql.=" WHERE `enabled`=1";
		}
		$result = $adb->query($sql);
		while($result && $row=$adb->fetch_row($result)) {
			foreach($row as $kk=>$field) {
				if(is_int($kk)) unset($row[$kk]);
			}
			$return[] = $row;
		}
		if(count($return) <= 0) return false;
		return $return;
	}
	function getModuleConfig($tabid) {
		global $adb;
		$sql = "select mc.*,t.name,t.tablabel from `vtiger_boruelastic_moduleconfig` mc inner join vtiger_tab t on t.tabid=mc.tabid WHERE mc.`tabid`=?";
		$result = $adb->pquery($sql,array($tabid));
		while($result && $row=$adb->fetch_row($result)) {
			foreach($row as $kk=>$field) {
				if(is_int($kk)) unset($row[$kk]);
			}
			return $row;
		}
		return false;
	}
	function getMaxFields() {
		global $adb;
		$sql = "SELECT MAX(fieldid) as fieldid,tabid FROM vtiger_field GROUP BY tabid";
		$result = $adb->query($sql);
		$return = array();
		while($result && $row=$adb->fetch_row($result)) {
			$return[$row["tabid"]] = $row["fieldid"];
		}
		return $return;
	}
	function getConfig() {
		global $adb;
		$sql = "select * from vtiger_boruelastic_serverconfig";
		$result = $adb->query($sql);
		while($result && $row=$adb->fetch_row($result)) {
			foreach($row as $kk=>$field) {
				if(is_int($kk)) unset($row[$kk]);
			}
			return $row;
		}
		return false;
	}
	function updateLastReindex($fieldid,$tabid) {
		global $adb;
		$sql = "update vtiger_boruelastic_moduleconfig SET `last_reindex`=NOW(), `max_fieldid`=? WHERE `tabid`=?";
		$adb->pquery($sql,array($fieldid,$tabid));
	}
	function createTemplate($prefix="") {
		if($prefix=="") $prefix = $this->prefix;
		
		$exists = $this->es->templateExists($prefix);
		if($exists) return true;
		
		$string='{
			"order" : 0,
			"template" : "'.$prefix.'-*",
			"settings" : {
				"index" : {
					"refresh_interval" : "5s"
				}
			},
			"mappings" : {
				"_default_" : {
					"dynamic_templates" : [
						{
							"strings": {
								"match_mapping_type": "string",
								"mapping": {
									"type": "string",
									"ignore_above" : 1024,
									"index" : "analyzed",
									"doc_values" : false
								}
							}
						},{
							"template1" : {
								"match_mapping_type":"*",
								"mapping" : {
									"ignore_above" : 1024,
									"index" : "analyzed",
									"type" : "{dynamic_type}",
									"doc_values" : true
								}
							}
						}
					],
					"_all" : {
						"enabled" : false
					},
					"properties" : {
						"@createdtime" : {
							"type" : "date",
							"format": "yyyy-MM-dd HH:mm:ss"
						},
						"@modifiedtime" : {
							"type" : "date",
							"format": "yyyy-MM-dd HH:mm:ss"
						},
						"@crmid" : {
							"type" : "integer",
							"index" : "not_analyzed"
						},
						"@smownerid" : {
							"type" : "integer",
							"index" : "not_analyzed"
						},
						"@smcreatorid" : {
							"type" : "integer",
							"index" : "not_analyzed"
						},
						"@modifiedby" : {
							"type" : "integer",
							"index" : "not_analyzed"
						},
						"@created_user" : {
							"type" : "string",
							"index" : "analyzed"
						},
						"@modified_user" : {
							"type" : "string",
							"index" : "analyzed"
						},
						"@assigned_user" : {
							"type" : "string",
							"index" : "analyzed"
						}
					}
				}
			}
		}';
		$this->printDebug("Creating ES template");
		return $this->es->template($string,$prefix);
	}
	function getFieldsFromCfg($cfg) {
		global $adb;
		$fieldarr = explode(",",$cfg["fields"]);
		$fieldstr = "";
		for($i=0;$i<count($fieldarr);$i++) {
			$fieldstr.=",?";
		}
		$fieldstr = trim($fieldstr,",");
		$sql = "select * from vtiger_field where fieldid IN ($fieldstr)";
		$result = $adb->pquery($sql,$fieldarr);
		return $result->GetRows();
	}
	function printDebug($var) {
		if(!$this->debug) return;
		if(is_array($var)) $string = print_r($var,true);
		else $string = $var;
		echo date("H:s:").">> ".$string."\n";
	}
	
	
	
	//helper functions
	function getReferenceDisplay($fieldModel,$value) {
		$referenceModule = $this->getReferenceModuleModel($fieldModel,$value);
		if($referenceModule && !empty($value)) {
			$referenceModuleName = $referenceModule->get('name');
			if($referenceModuleName == 'Users') {
				$db = PearDatabase::getInstance();
				$nameResult = $db->pquery('SELECT first_name, last_name FROM vtiger_users WHERE id = ?', array($value));
				if($db->num_rows($nameResult)) {
					return $db->query_result($nameResult, 0, 'first_name').' '.$db->query_result($nameResult, 0, 'last_name');
				}
			} else {
				$entityNames = getEntityName($referenceModuleName, array($value));
				return $entityNames[$value];
			}
		}
		return $value;
	}
	function getReferenceModuleModel($fieldModel,$value) {
		$referenceModuleList = $fieldModel->getReferenceList();
		$referenceEntityType = getSalesEntityType($value);
		if(in_array($referenceEntityType, $referenceModuleList)) {
			return Vtiger_Module_Model::getInstance($referenceEntityType);
		} elseif (in_array('Users', $referenceModuleList)) {
			return Vtiger_Module_Model::getInstance('Users');
		}
		return null;
	}
}
