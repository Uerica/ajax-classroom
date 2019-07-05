<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Examples</title>
</head>
<body>

<?php 

//..................
foreach($_FILES["upFile"]["error"] as $i => $errorCode ){
	switch($_FILES["upFile"]["error"][$i]){
		case UPLOAD_ERR_OK:
		    if( file_exists("images") === false){  //若資料夾不存在
		    	mkdir("images"); //make directory
		    }
		    $from = $_FILES["upFile"]["tmp_name"][$i];
		    $to = "images//{$_FILES['upFile']['name'][$i]}";
		    if(copy($from, $to)){
		    	echo "上傳成功~<br>";
		    }else{
		    	echo "上傳失敗~<br>";
		    }
			break;
		case UPLOAD_ERR_INI_SIZE:
			echo "上傳檔案太大, 不可超過", ini_get("upload_max_filesize"), "<br>";
			break;
		case UPLOAD_ERR_FORM_SIZE:
		echo "上傳檔案太大, 不可超過", $_POST["MAX_FILE_SIZE"], "<br>";
			break;
		case UPLOAD_ERR_PARTIAL:
			echo "上傳檔案不完整<br>";
			break;
		case UPLOAD_ERR_NO_FILE:
			echo "没有上傳檔案<br>";
			break;		
	}	
}





?>

</body>
</html>