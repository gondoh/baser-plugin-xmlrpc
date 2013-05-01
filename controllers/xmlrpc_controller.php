<?php

class XmlrpcController extends BaserPluginAppController {
	var $uses = array('User', 'BlogPost', 'BlogCategory');
	
	function beforeRender() {
		// Baserでレンダリグしない
		exit;
	}
	
	function index() {
		require_once dirname(dirname(__FILE__)).'/vendors/IXR_Library.php';
		require_once dirname(dirname(__FILE__)).'/models/xml_rpc_server.php';
		$server = new XmlRpcServer($this);
	}
}
?>