function $id(id){
	return document.getElementById(id);
}	

    function showLoginForm(){
      //檢查登入bar面版上 spanLogin 的字是登入或登出
      //如果是登入，就顯示登入用的燈箱(lightBox)
      //如果是登出
      //將登入bar面版上，登入者資料清空 
      //spanLogin的字改成登入
      //將頁面上的使用者資料清掉
      if($id('spanLogin').innerHTML == "登入"){
        $id('lightBox').style.display = 'block';
      }else{  //................登出時，除了處理前端頁面，也要回server端清session

        //......................................
        var xhr = new XMLHttpRequest();
        xhr.onload=function(){
            if(xhr.status == 200){
              $id('memName').innerHTML = '&nbsp';
              $id('spanLogin').innerHTML = '登入';
            }else{
              alert(xhr.status);
            }
        }
        xhr.open("get", "ajaxLogout.php", true);
        xhr.send(null);
        //......................................
      }

    }//showLoginForm

    function sendForm(){
      //=====使用Ajax 回server端,取回登入者姓名, 放到頁面上   
      //.......................................................... 
      var xhr = new XMLHttpRequest();

      xhr.onload = function(){
          if( xhr.status == 200){
            if( xhr.responseText == "error"){
              alert("帳密錯誤");
            }else{ //登入成功
              $id("memName").innerHTML = xhr.responseText;
              //將登入表單上的資料清空，並隱藏燈箱
              $id('lightBox').style.display = 'none';
              $id('memId').value = '';
              $id('memPsw').value = '';
              $id('spanLogin').innerHTML = "登出";
            }
            
          }else{
            alert( xhr.status);
          }
      }

      xhr.open("post", "ajaxLogin.php", true);
      xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");
      var data_info = `memId=${$id("memId").value}&memPsw=${$id("memPsw").value}`;
      xhr.send(data_info);
      //..........................................................

    }

    function cancelLogin(){
      //將登入表單上的資料清空，並將燈箱隱藏起來
      $id('lightBox').style.display = 'none';
      $id('memId').value = '';
      $id('memPsw').value = '';
    }

    function init(){
      //檢查是否已登入, 如果已登入，取回登入者的資料
      var xhr = new XMLHttpRequest();
      xhr.onload = function(){
        if( xhr.responseText != "notLogin"){ //已登入
          document.getElementById("memName").innerHTML = xhr.responseText;
          document.getElementById("spanLogin").innerHTML = "登出";
        }
      }
      xhr.open("get", "getLoginInfo.php",true);
      xhr.send(null);

      //===設定spanLogin.onclick 事件處理程序是 showLoginForm

      $id('spanLogin').onclick = showLoginForm;

      //===設定btnLogin.onclick 事件處理程序是 sendForm
      $id('btnLogin').onclick = sendForm;

      //===設定btnLoginCancel.onclick 事件處理程序是 cancelLogin
      $id('btnLoginCancel').onclick = cancelLogin;

    }; //window.onload

    window.onload=init;