<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>XML-RPC plugin excecuter</title>
<style>html{color:#000;background:#FFF}body,div,dl,dt,dd,ul,ol,li,h1,h2,h3,h4,h5,h6,pre,code,form,fieldset,legend,input,button,textarea,p,blockquote,th,td{margin:0;padding:0}table{border-collapse:collapse;border-spacing:0}fieldset,img{border:0}address,caption,cite,code,dfn,em,strong,th,var,optgroup{font-style:inherit;font-weight:inherit}del,ins{text-decoration:none}li{list-style:none}caption,th{text-align:left}h1,h2,h3,h4,h5,h6{font-size:100%;font-weight:normal}q:before,q:after{content:''}abbr,acronym{border:0;font-variant:normal}sup{vertical-align:baseline}sub{vertical-align:baseline}legend{color:#000}input,button,textarea,select,optgroup,option{font-family:inherit;font-size:inherit;font-style:inherit;font-weight:inherit}input,button,textarea,select{*font-size:100%}body{font:13px/1.231 arial,helvetica,clean,sans-serif;*font-size:small;*font:x-small}select,input,button,textarea,button{font:99% arial,helvetica,clean,sans-serif}table{font-size:inherit;font:100%}pre,code,kbd,samp,tt{font-family:monospace;*font-size:108%;line-height:100%}body{margin:10px}h1{font-size:138.5%}h2{font-size:123.1%}h3{font-size:108%}h1,h2,h3{margin:1em 0}h1,h2,h3,h4,h5,h6,strong,dt{font-weight:bold}optgroup{font-weight:normal}abbr,acronym{border-bottom:1px dotted #000;cursor:help}em{font-style:italic}del{text-decoration:line-through}blockquote,ul,ol,dl{margin:1em}ol,ul,dl{margin-left:2em}ol li{list-style:decimal outside}ul li{list-style:disc outside}dl dd{margin-left:1em}th,td{border:1px solid #000;padding:.5em}th{font-weight:bold;text-align:center}caption{margin-bottom:.5em;text-align:center}sup{vertical-align:super}sub{vertical-align:sub}p,fieldset,table,pre{margin-bottom:1em}button,input[type="checkbox"],input[type="radio"],input[type="reset"],input[type="submit"]{padding:1px}html{background-color:#FFF}body{background-color:#FFF;color:#222;font-family:Verdana,"Bitstream Vera Sans",sans-serif;font-size:100%;line-height:1.5;margin:0 auto;padding:10px}section{display:block}header{display:block;font-size:13px;min-height:2em}header h1{height:30px;margin-bottom:10px;margin-top:0;padding-left:40px;padding-top:5px}footer{display:block;font-size:77%;margin-top:4em;text-align:center}p{clear:both}fieldset{border:1px solid #999;padding:10px}legend{color:#999;font-size:77%;padding:.1em .3em;text-align:left}label{color:#222;float:left;margin-bottom:.1em;margin-right:.5em;margin-top:.1em;text-align:right;width:80px}.labelvert{margin:0 0 1em 0;padding:.1em 1em 0 0;width:auto}input[type=text],textarea{background-color:#fff;border:1px solid #bbb;margin:0;padding-left:3px;font-size:13px}input[type=button]{float:right;margin-right:25px}textarea{height:200px;width:95%;}#loader{background:url(loader.gif) no-repeat center 5px;height:30px;padding-top:50px;text-align:center;width:100%}#response p{clear:both}#response p span{clear:both;margin-bottom:1em;margin-top:.1em;min-height:20px;width:80px}#responseData{min-height:20px;border:1px solid #BBB;padding-left:3px;overflow:auto;position:relative}</style>
<script src="http://ajax.microsoft.com/ajax/jquery/jquery-1.8.2.min.js"></script>
<script>
$(function(){
	$("#loader_area").hide();
	$("#responseData").hide();
	
	$("#data_form").submit(function(){
		$("#button_area").hide();
		$("#responseData").slideUp().val('');
		$("#loader_area").show();
		$.ajax({
			type: 'POST',
			contentType: 'text/xml;charset=UTF-8',
			url: $("#data_form").attr('action'),
			data: $("#postputdata").val(),
			dataType:"text",
			success: function(res, status, xhr){
				$("#responseData").slideDown(function(){
					$(this).val(res);
				});
				$("#button_area").show();
				$("#loader_area").hide();
				$("#responseStatus").text(xhr.status+" "+xhr.statusText);
			}
		});
		return false;
	});
});
var i = 0;var loaderAry = new Array("―", "＼", "｜" ,"／");
function changeLoader(){ $("#loader_area").html(loaderAry[i]); i++; if (i >= 4) i = 0; }
setInterval("changeLoader()",80);
</script>
</head>

<body>
  <header>
	<h1 class="_msg_">XML-RPC plugin checker</h1>
  </header>
  <section id="request">
	<fieldset>
	  <legend class="_msg_">request</legend>
	  <?php echo $form->create(array('type' => 'post', 'action' => 'index', 'id'=> 'data_form')); ?>
		  <input type="hidden" name="http_method" value="post" >
		  <p id="data">
			<label for="postputdata" class="_msg_">data</label>
			<textarea name="data" id="postputdata" tabindex="4" onkeyup=""></textarea>
		  </p>
		  <p id="button_area">
			<input class="_msg_val_" type="submit" value="send" id="submit" tabindex="5">
			<input class="_msg_val_" type="reset" value="clear"> 
		  </p>
		  <p id="loader_area"></p>
	  <?php echo $form->end(); ?>
	</fieldset>
  </section>
  <hr id="sep" />

  <section id="response">
	<fieldset>
	  <legend class="_msg_">response</legend>
	  <div id="responsePrint">
		<p id="pstatus">
		  <label class="_msg_">status</label> 
		  <span id="responseStatus">&nbsp;</span>
		</p>
		<p id="respHeaders">
		  <label for="responseData" class="_msg_">data</label> 
		  <textarea name="responseData" id="responseData" tabindex="6"></textarea>
		</p>
	  </div>
	</fieldset>
  </section>
  <footer>
	<p>Copyright &copy; 2013 <a href="http://blog.gufii.net">gondoh </a></p>
  </footer>
</body>
</html>
