<?php
try{
  require_once("connectBooks.php");
  $sql = "select * from member where memId=:memId";

  
  if( $member->rowCount() == 0 ){ //找不到
    //傳回空的JSON字串
    
  }else{ //找得到
    //取回一筆資料
    
    //送出json字串

  }	
}catch(PDOException $e){
  echo $e->getMessage();
}
?>