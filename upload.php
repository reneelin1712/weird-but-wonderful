<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Upload</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<style>
		#drop_zone {
			background-color: #EEE;
			border: #999 5px dashed;
			width: 290px;
			height: 200px;
			padding: 8px;
			font-size: 18px;
		}
	</style>


</head>

<body>
	<h2>File Upload </h2>
	<form id="upload_form" enctype="multipart/form-data" method="post">
		<input type="file" name="file1" id="file1"><br>
		

		<div >
		<label for="animal_name">
				<h3>Animal_name</h3>
			</label>
			<input type="text" name="animal_name" />
	</div>
	<div>
			<label for="description">
				<h3>Description</h3>
			</label>
			<textarea name="description" class="form-control" id="description" rows="3"></textarea>
		</div>
		<input type="button" value="Upload File" onclick="uploadFile()">
		
		<progress id="progressBar" value="0" max="100" style="width:300px;"></progress>
		<h3 id="status"></h3>
		<p id="loaded_n_total"></p>
		<h1>File Upload Drop Zone</h1>
		<div id="drop_zone" ondrop="drag_drop(event)" ondragover="return false">
	</form>
</body>
<script>
	/* Script written by Adam Khoury @ DevelopPHP.com */
	/* Video Tutorial: http://www.youtube.com/watch?v=EraNFJiY0Eg */
	function _(el) {
		return document.getElementById(el);
	}

	function uploadFile() {
		var file = _("file1").files[0];
		
		// var form = document.getElementById('upload_form');
	
		console.log(file);
		// alert(file.name+" | "+file.size+" | "+file.type);
		var formdata = new FormData();
		formdata.append("animal_name","try");
		formdata.append("file1", file);
		console.log(formdata);
		var ajax = new XMLHttpRequest();
		ajax.upload.addEventListener("progress", progressHandler, false);
		ajax.addEventListener("load", completeHandler, false);
		ajax.addEventListener("error", errorHandler, false);
		ajax.addEventListener("abort", abortHandler, false);
		ajax.open("POST", "upload_middleware.php");
		ajax.send(formdata);
	}

	function progressHandler(event) {
		_("loaded_n_total").innerHTML = "Uploaded " + event.loaded + " bytes of " + event.total;
		var percent = (event.loaded / event.total) * 100;
		_("progressBar").value = Math.round(percent);
		_("status").innerHTML = Math.round(percent) + "% uploaded... please wait";
	}

	function completeHandler(event) {
		_("status").innerHTML = event.target.responseText;
		_("progressBar").value = 0;
	}

	function errorHandler(event) {
		_("status").innerHTML = "Upload Failed";
	}

	function abortHandler(event) {
		_("status").innerHTML = "Upload Aborted";
	}

	function drag_drop(event) {
		event.preventDefault();
		var file = event.dataTransfer.files[0]
		// alert(file.name+" | "+file.size+" | "+file.type);
		var formdata = new FormData();
		formdata.append("file1", file);
		var ajax = new XMLHttpRequest();
		ajax.upload.addEventListener("progress", progressHandler, false);
		ajax.addEventListener("load", completeHandler, false);
		ajax.addEventListener("error", errorHandler, false);
		ajax.addEventListener("abort", abortHandler, false);
		ajax.open("POST", "upload_middleware.php");
		ajax.send(formdata);

	}
</script>

</html>