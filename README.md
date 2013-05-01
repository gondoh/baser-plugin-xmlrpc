BaserCMSでXML-RPCを利用し、新着情報を登録するpluginです。
テキストを投稿する機能しかないです。


[提供メソッド]
bc.newPage （記事の作成）

[提供予定メソッド] （上から優先度高）
bc.uploadFile  (ファイルアップロード)
bc.getCategories （カテゴリー取得）
bc.getTags （タグ取得）
bc.getPage （記事取得）
bc.getPages （記事一覧取得）


[設置方法]
1. ソースをダウンロードします。
2. xmlrpcという名前にリネームします。
3. /app/plugin/ リネームしたフォルダを放り込んでください。
4. Baserの管理画面のプラグイン管理より有効にしてください。
以上でサーバ機能が利用可能になります。


[クライアントからの利用]
以下のXMLデータをbaser設置サーバの /xmlrpc へPOSTしたらOKです。
<?xml version="1.0" encoding="utf-8"?>
<methodCall>
	<methodName>bc.newPage</methodName>
	<params>
		<param>
			<value>
				<string>1</string><!-- blog_id -->
			</value>
		</param>
		<param>
			<value>
				<string>account</string>
			</value>
		</param>
		<param>
			<value>
				<string>passwrod</string>
			</value>
		</param>
		<param>
			<value>
				<struct>
					<member>
						<name>title</name>
						<value>
							<string>記事タイトル</string>
						</value>
					</member>
					<member>
						<name>description</name>
						<value>
							<string>記事の概要</string>
						</value>
					</member>
					<member>
						<name>content</name>
						<value>
							<string>記事の本文</string>
						</value>
					</member>
					<member>
						<name>category_id</name>
						<value>
							<string>カテゴリID</string>
						</value>
					</member>
					<member>
						<name>dateCreated</name>
						<value>
							<string>2012/05/01 00:00:00</string><!-- strtotimeでパースするのでそれで読める形ならなんでも -->
						</value>
					</member>
				</struct>
			</value>
		</param>
		<param>
			<value>
				<int>1</int><!-- 公開状態 -->
			</value>
		</param>
	</params>
</methodCall>


