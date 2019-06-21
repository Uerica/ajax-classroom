<?php
try{
  require_once("connectBooks.php");
  $sql = "select * from member where memId=:memId";
  $member = $pdo->prepare( $sql );
  $member->bindValue(":memId", $_REQUEST["memId"]);
  $member->execute();

  //如果找得資料，取回資料，送出xml文件
  if( $member->rowCount() == 0){
  	echo "notFound";
  }else{
  	$memRow = $member->fetch(PDO::FETCH_ASSOC);
  	$xmlStr = '<?xml version="1.0"?>';
  	$xmlStr .=  "<member>";
  	$xmlStr .=  "<帳號>{$memRow["memId"]}</帳號>";
  	$xmlStr .=  "<memName>{$memRow["memName"]}</memName>";
  	$xmlStr .=  "<birthday>{$memRow["birthday"]}</birthday>";
  	$xmlStr .=  "<email>{$memRow["email"]}</email>";
  	$xmlStr .=  "</member>";
  	header('Content-Type: application/xml; charset=utf-8');;
  	echo $xmlStr;
  }
}catch(PDOException $e){
  echo $e->getMessage();
}
?>
