<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Welcome</title>
<script type="text/javascript" src = "xmlhttprequest.js"></script>
<script type="text/javascript">

function $(id) {
	return document.getElementById(id);
}

window.onload = function () {
	
	$("upload_btn").onclick = function () {
		var id = $("note_id").value;
		var title = $("note_title").value;
		var content = $("note_content").value;
		var stick = $("note_stick").value;
		var lock = $("note_lock").value;
		var datetime = new Date().getTime();
		var never_download = $("never_download").value;
		var url = './upload.php';
		//var postStr = "note_id="+id+'&note_title='+title+'&note_content='+content+'&note_stick='+stick+'&note_lock='+lock+'&datetime='+new Date().getTime();
		var postStr = 'notes=[';

		postStr += '{"id":' + id + ',"title":' + '"' + title + '"' + ',"content":' + '"' + content + '"' + ',"stick":' + stick + ',"lock":' + lock + ',"datetime":' + datetime +'}';
		
		for (var i = 0; i < 10; i++) {
			postStr += ',{"id":' + '"' + id + '"' + ',"title":' + '"' + title + '"' + ',"content":' + '"' + content + '"' + ',"stick":' + stick + ',"lock":' + lock + ',"datetime":' + datetime +'}';
		}
		postStr += ']&never_download=' + never_download;
		alert(postStr);
		xmlhttp.open('post',url,true);
		xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		xmlhttp.onreadystatechange = function(){
			if(xmlhttp.readyState == 4){
				if(xmlhttp.status == 200){
					var msg = xmlhttp.responseText;
					if (msg == '') {
						alert("失败");
					}else{
						alert(msg + "行受影响");
					}
				}
			}
		}
		//发送请求
		xmlhttp.send(postStr);

	};
	
	$("download_btn").onclick = function () {
		url = './download.php';
		
		xmlhttp.open('get',url,true);
		xmlhttp.onreadystatechange = function(){
			if(xmlhttp.readyState == 4){
				if(xmlhttp.status == 200){
					var json = eval('(' + xmlhttp.responseText +')');
					
					var textarea = $("textarea1");
					
					var value = '';
					
					for (var i = 0; i < json.length; i++) {
						var note = json[i];
						for (var e in note) {
							value += e + "=" + note[e] + ",";
						}
						value += "\n";
					}
					textarea.value = value;
				}
			}
		}
		//发送请求
		xmlhttp.send(null);
	};
};


</script>
</head>
<body>
<h3>Upload</h3>
<hr/>
<span>id:</span><input value = "100" type = "text" id = "note_id" /><br/>
<span>title:</span><input value = "vvvvvvvvvvvvv" type = "text" id = "note_title" /><br/>
<span>content:</span><input value = "jjjjjjjjjj" type = "text" id = "note_content" /><br/>
<span>stick:</span><input value = "1" type = "text" id = "note_stick" /><br/>
<span>lock:</span><input value = "0" type = "text" id = "note_lock" /><br/>
<span>never_download:</span><input value = "1" type = "text" id = "never_download" /><br/>
<input type = "button" value = "upload" id = "upload_btn" />

<h3>downLoad</h3>
<hr/>
<input type = "button" value = "download" id = "download_btn" /><br/><br/>

<textarea rows="100" cols="100" id = "textarea1"></textarea>

</body>
</html>