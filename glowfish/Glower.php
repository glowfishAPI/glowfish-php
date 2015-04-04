<?php

include(dirname(__FILE__) . '/frameworks/httpful.phar');
require_once(dirname(__FILE__) . '/config/config.php');

class Glower {
	private $_sid = null;
	private $_token = null;
	
	private $attributes			= array(
		"set_name"				=> "default",
	
		"fail_if_mistakes"		=> false,
		"delete_previous_data"	=> false,
		"save_data"				=> false,
		"stats"					=> false,
		"hold"					=> false,
		"update"				=> false,
		
		"max_number"			=> -1,
		"accuracy"				=> false,
		"group_max_number"		=> -1
	);

 	public function __construct($sid, $token){
	 	$this->_sid 		= $sid;
	 	$this->_token 	= $token;
 	}
 	
 	public function train($data_set = array(), $response = array()){
	 	$data = compact('data_set', 'response');
	 	return $this->_request('train', $data);
 	}
 	
 	public function train_csv($data_set = "", $response = ""){
	 	$attach = compact('data_set', 'response');
	 	return $this->_request('train/csv', array(), $attach);
 	}
 	
 	public function predict($data_set = array(), $response = array()){
	 	$data = compact('data_set', 'response');
	 	return $this->_request('predict', $data);
 	}
 	
 	public function predict_csv($data_set = "", $response = ""){
	 	$attach = compact('data_set', 'response');
	 	return $this->_request('predict/csv', array(), $attach);
 	}
 	
 	public function cluster($data_set = array()){
	 	$data = compact('data_set');
	 	return $this->_request('cluster', $data);
 	}
 	
 	public function cluster_csv($data_set = ""){
	 	$attach = compact('data_set');
	 	return $this->_request('cluster/csv', array(), $attach);
 	}
 	
 	public function feature_select($data_set = array(), $response = array()){
	 	$data = compact('data_set', 'response');
	 	return $this->_request('feature_select', $data);
 	}
 	
 	public function feature_select_csv($data_set = "", $response = ""){
	 	$attach = compact('data_set', 'response');
	 	return $this->_request('feature_select/csv', array(), $attach);
 	}
 	
 	public function filter_train($userids = array(), $productids = array(), $ratings = array()){
 		$data_set = array('userid': $userids, 'productid': $productids, 'rating': $ratings);
	 	$data = compact('data_set');
	 	return $this->_request('filter_train', $data);
 	}
 	
 	public function filter_train_csv($userids = "", $productids = "", $ratings = ""){
 		$data_set = array('userid': $userids, 'productid': $productids, 'rating': $ratings);
	 	$attach = compact('data_set');
	 	return $this->_request('filter_train/csv', array(), $attach);
 	}
 	
 	public function filter_predict($userids = array(), $productids = array(), $ratings = array()){
 		$data_set = array('userid': $userids, 'productid': $productids, 'rating': $ratings);
	 	$data = compact('data_set');
	 	return $this->_request('filter_predict', $data);
 	}
 	
 	public function filter_predict_csv($userids = "", $productids = "", $ratings = ""){
 		$data_set = array('userid': $userids, 'productid': $productids, 'rating': $ratings);
	 	$attach = compact('data_set');
	 	return $this->_request('filter_predict/csv', array(), $attach);
 	}
 	
 	private function _request($endpoint, $data = array(), $attachments = null){
 		foreach($this->attributes as $attribute => $value){
	 		$data[$attribute] = (!is_bool($value) ? $value : ($value ? "true" : "false"));
 		}
 		 	
	 	$request = Httpful\Request::post(API_ENDPOINT . API_VERSION . '/' . $endpoint . '/')
	 		->expectsJson()
	 		->authenticateWith($this->_sid, $this->_token)
	 		->body($data);
	 		
	 	if($attachments){
	 		$request->attach($attachments);
	 	}
	 	
	 	try {
	 		return $request->send();
	 	} catch(Exception $e){
	 		echo '<pre>';var_dump($e);echo '</pre>';
	 	}
 	}
 	
 	public function __set($key, $value){
	 	if(isset($this->attributes[$key])){
		 	$this->attributes[$key] = $value;
	 	}
 	}
 	
 	public function __get($key){
	 	if(isset($this->attributes[$key])){
		 	return $this->attributes[$key];
	 	}
	 	return null;
 	}
}