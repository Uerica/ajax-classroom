<?php
session_start();
try{
  require_once("connectBooks.php");
  $sql = "select * from member where memId=:memId and memPsw=:memPsw";
  $member = $pdo->prepare($sql);
  $member->bindValue(":memId", $_REQUEST["memId"]);
  $member->bindValue(":memPsw", $_REQUEST["memPsw"]);
  $member->execute();

  if( $member->rowCount()==0){ //查無此人, 帳密錯誤
	  echo "error";
  }else{ //登入成功
    //自資料庫中取回資料
  	$memRow = $member->fetch(PDO::FETCH_ASSOC);

  	//寫入SESSION
  	$_SESSION["memNo"] = $memRow["no"];
  	$_SESSION["memId"] = $memRow["memId"];
  	$_SESSION["memName"] = $memRow["memName"];
  	$_SESSION["email"] = $memRow["email"];

    //送出登入者的姓名資料
    echo $memRow["memName"];
  }
}catch(PDOException $e){
  echo $e->getMessage();
  //echo "系統異常,請通知系統維護人員";	
}
?>