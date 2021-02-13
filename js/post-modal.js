
(()=>{
    // ログインモーダルを表示
    // const $post_show = document.getElementById('post-show');
    const $post_modal = document.getElementById('post-modal');
    
    // $post_show.addEventListener('click', function() {
    //   $post_modal.classList.add('active');
    // })

    // ログインモーダルを閉じる
    const $closePost = document.getElementById('close-post-modal');

    $closePost.addEventListener('click', function() {
      $post_modal.classList.remove('active');
    })
})();