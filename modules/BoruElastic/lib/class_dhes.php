<?php
//requires dhrest
require_once(dirname(__FILE__)."/class_dhrest.php");

class dhes {
	private $config = array(
		"host"=>"localhost",
		"port"=>"9200",
		"auth"=>false, //http basic auth user:pass or false
	);
	public $ret_array = true;
	
	private $index;
	private $type;
	
	public $bulk_data = array();
	
	function __construct($config=array(),$index="",$type="") {
		if(!empty($config)) {
			$this->config["host"] = $config["host"];
			$this->config["port"] = $config["port"];
		}
		$this->setIndex($index);
		$this->setType($type);
	}
	
	function index($document=array(),$id="") {
		if(empty($document)) return false;
		
		$json = json_encode($document);
		
		$url = $this->url($this->index."/".$this->type);
		if($id != "") {
			$url.="/".$id;
			$return = $this->parse(dhrest::put($url,$json,$this->config["auth"]));
		} else {
			$return = $this->parse(dhrest::post($url,$json,$this->config["auth"]));
		}
		if($this->ret_array) return (array) $return;
		return $return;
	}
	function template($document,$name) {
		$url = $this->url($path."/_template/".$name);
		$return = $this->parse(dhrest::put($url,$document,$this->config["auth"]));
		if($this->ret_array) return (array) $return;
		return $return;
	}
	
	/*
		Action ARR:
		$action["index"] = array(
			"_index"=>docindex,
			"_type"=>doctype,
			"_id"=><recordid>, //optional
		);
	*/	
	function addBulkAction($action_arr,$param_arr=array()) {
		$this->bulk_data[] = json_encode($action_arr);
		if(!empty($param_arr)) $this->bulk_data[] = json_encode($param_arr);
	}
	function bulk($data=array()) {
		if(empty($data)) {
			$data = $this->bulk_data;
			$this->bulk_data = array();
		}
		$string = "";
		foreach($data as $k=>$ob) {
			$string.=$ob."\n";
		}
		$url = $this->url("_bulk");

		$return = $this->parse(dhrest::post($url,$string,$this->config["auth"]));

		if($this->ret_array) return (array) $return;
		return $return;
	}
	
	function search($args=array(),$path="",$size="",$from="",$search_type="") {
		if($path != "") {
			$url = $this->url($path."/_search");
		} else {
			$url = $this->url("_search");
		}
		
		$uri = array();
		
		if($size != "") $uri[] = "size=".$size;
		if($from != "") $uri[] = "from=".$from;
		if($search_type != "") $uri[] = "search_type=".$search_type;
		if(!empty($uri)) {
			$string = "?".implode("&",$uri);
			$url.=$string;
		}
		
		if(is_array($args)) $args=json_encode($args);

		$return = $this->parse(dhrest::post($url,$args,$this->config["auth"],600));
		if($this->ret_array) return (array) $return;
		return $return;
	}
	
	public function indexExists($index="") {
		if($index == "") $index = $this->index;
		$url = $this->url($index);
		$return = $this->parse(dhrest::head($url,"",$this->config["auth"]));
		
		if($this->status == 200) return true;
		return false;
	}
	
	public function templateExists($template) {
		$url = $this->url("_template/".$template);
		$return = $this->parse(dhrest::get($url,"",$this->config["auth"]));
		if(empty($return) || !isset($return[$template])) {
			return false;
		}
		return true;
	}
	
	public function setIndex($index) {
		$this->index = $index;
	}
	public function setType($type) {
		$this->type = $type;
	}
	
	function call($type,$path,$parms=array()) {
		$url = $this->url($path);
		if(is_array($parms)) $parms=json_encode($parms);
		
		switch(strtolower($type)) {
			case "get":
				$return = $this->parse(dhrest::get($url,$parms,$this->config["auth"]));
				break;
			case "post":
				$return = $this->parse(dhrest::post($url,$parms,$this->config["auth"]));
				break;
			case "put":
				$return = $this->parse(dhrest::put($url,$parms,$this->config["auth"]));
				break;
			case "delete":
				$return = $this->parse(dhrest::delete($url,$parms,$this->config["auth"]));
				break;
			case "head":
				$return = $this->parse(dhrest::head($url,$parms,$this->config["auth"]));
				break;
			default:
				$return = false;
				break;
		}
		if($return === false) return false;
		
		if($this->ret_array) return (array) $return;
		return $return;
	}
	function get($path,$parms=array()) {
		return $this->call("get",$path,$parms);
	}
	function post($path,$parms=array()) {
		return $this->call("post",$path,$parms);
	}
	function put($path,$parms=array()) {
		return $this->call("put",$path,$parms);
	}
	function delete($path,$parms=array()) {
		return $this->call("delete",$path,$parms);
	}
	function head($path,$parms=array()) {
		return $this->call("head",$path,$parms);
	}
	
	function url($path) {
		return "http://".$this->config["host"].":".$this->config["port"]."/".$path;
	}
	
	function parse($response) {
		$this->response = $response;
		$this->status = $response["status"];
		$this->header = $response["header"];
		if($this->ret_array)
			$this->data = json_decode($response["data"],true);
		else
			$this->data = json_decode($response["data"]);
		return $this->data;
	}
}
