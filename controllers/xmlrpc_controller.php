<?php

class XmlrpcController extends BaserPluginAppController {
	var $autoRender = false;
	var $autoLayout = false;
	var $uses = array('User', 'BlogPost', 'BlogCategory');
	
	function index() {
		require_once dirname(dirname(__FILE__)).'/vendors/IXR_Library.php';
		require_once dirname(dirname(__FILE__)).'/models/xml_rpc_server.php';
		$server = new XmlRpcServer($this);
	}
	
	function executor(){
		$this->render();
	}
}
?>