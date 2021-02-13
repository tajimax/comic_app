
(()=>{

  // const autoLogin = ($result) => {
  //   if($result){
  //       window.location.href="../common_page/mypage.php";
  //   }else{
  //       document.getElementById('login-modal').classList.add('active');
  //   }
  // }


    // ログインモーダルを閉じる
    const $login_modal = document.getElementById('login-modal');
    const $close_modal = document.getElementById('close-login-modal');

    $close_modal.addEventListener('click', function() {
      $login_modal.classList.remove('active');
    })
})();