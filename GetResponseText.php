<?php
try{
  require_once("connectBooks.php");
  $sql = "select memId from member where memId = :memId";
  $member = $pdo->prepare($sql);
  $member->bindValue(":memId", $_REQUEST["memId"]);
  $member->execute();
  if( $member->rowCount() !=0){
    echo "帳號已存在，不可使用";
  }else{
    echo "此帳號可使用";
  } 
}catch(PDOException $e){
  echo "error";
}
?>