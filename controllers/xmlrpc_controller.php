<?php

class XmlrpcController extends BaserPluginAppController {
	public $autoRender = false;
	public $autoLayout = false;
	public $uses = array('User', 'BlogPost', 'BlogCategory');
	
	/**
	 * XML-RCP サーバ機能
	 *
	 * @return	void
	 * @access	public
	 */
	public function index() {
		require_once dirname(dirname(__FILE__)).'/vendors/IXR_Library.php';
		require_once dirname(dirname(__FILE__)).'/models/xml_rpc_server.php';
		// 細かい処理はXmlRpcServerに移譲
		$server = new XmlRpcServer($this);
	}
	
	/**
	 * クライアント機能（動作確認用）
	 *
	 * @return	void
	 * @access	public
	 */
	function executor(){
		$this->render();
	}
}
?>