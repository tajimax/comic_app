(()=>{   

    // ログインモーダルを表示
    const $logout_show = document.getElementById('logout-show');
    const $logout_modal = document.getElementById('login-modal');
    
    $logout_show.addEventListener('click', function() {
      $logout_modal.classList.add('active');
    })
})();