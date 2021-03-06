<?php
/**
 * baserCMS用 XML-RPCサーバ機能
 * 大まかな機能はThe Incutio XML-RPC Libraryを利用
 * 細かい実装部分
 *
 * @author gondoh
 */
class XmlRpcServer extends IXR_Server {
	private $controllerInstance;
	private $callableMethods = array(
		  'bc.newPage' => "this:newPage"
//		, 'bc.uploadFile' => "this:uploadFile"
//		, 'bc.getCategories' => "this:getCategories"
//		, 'bc.getTags' => "this:getTags"
//		, 'bc.getPage' => "this:getPage"
//		, 'bc.getPages' => "this:getPages"
	);
	
	public function __construct($controllerInstance) {
		$this->controllerInstance = $controllerInstance;
		parent::__construct($this->callableMethods);
	}
	
	/**
	 * ページ追加
	 * 
	 */
	protected function newPage($args){
		// TODO タグの登録機能がない
		$blogId     = $args[0];
		$account    = $args[1];
		$password   = $args[2];
		$title      = $args[3]["title"];
		$content    = $args[3]["content"];
		$detail     = $args[3]["detail"];
		$categoryId = intval($args[3]["categoryId"]) ? intval($args[3]["categoryId"]) : '';
		$date       = $args[3]["dateCreated"];
		$publish    = $args[4];
		
		// ユーザチェック
		$result = $this->checkUser($account, $password);
		
		// ユーザが確認できないよ
		if ($result == false) return new IXR_Error(4000, 'ユーザが確認できません。');
		
		// maxno取得
		$no = $this->controllerInstance->BlogPost->getMax('no',array('BlogPost.blog_content_id'=>$blogId))+1;
		
		$data = array(
			  'blog_content_id' => $blogId
			, 'no' => $no
			, 'name' =>  $title
			, 'content' =>  $content
			, 'detail' =>  $detail
			, 'category_id' =>  $categoryId
			, 'user_id' =>  $result["User"]["id"]
			, 'status' =>  !!$publish
			, 'posts_date' =>  date("Y-m-d H:i:s", strtotime($date))
		);
		$this->controllerInstance->BlogPost->create();
		if ($this->controllerInstance->BlogPost->save($data)){
			//var_dump($this->controllerInstance->BlogPost);
			return '記事を追加しました。';
		} else {
			 return new IXR_Error(4010, '登録に失敗しました。');
		}
	}
	
	// ユーザが存在するか確認する
	protected function checkUser($account, $password){
		//TODO 細かい権限確認してない
		return $this->controllerInstance->User->findByNameAndPassword(
				$account, sha1(Configure::read('Security.salt').$password));
	}
}
?>
