

<?php 
    require_once('../mypage/userLogic.php');

    session_start();
    $result = UserLogic::checkLogin();
    if(!$result){
        $err = $_SESSION;
        UserLogic::logout();
    }else{
        header('Location: ./post_work.php');
    }
    

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/modal.css">
</head>
<body>

    <div class="modal-wrapper">
        <div class="modal">
            <div class="modal__form">
                <h2>本人確認</h2>
                    <?php if(isset($err['msg'])): ?>
                            <p><?php echo $err['msg'] ?></p>
                    <?php endif ?>
                <form action="./post_work.php" method="post">
                    <div>
                        <input type="email" placeholder="メールアドレス" name="email">
                        <?php if(isset($err['email'])): ?>
                            <p><?php echo $err['email'] ?></p>
                        <?php endif ?>
                    </div>
                    <div>
                        <input type="password" placeholder="パスワード" name="password">
                        <?php if(isset($err['password'])): ?>
                            <p><?php echo $err['password'] ?></p>
                        <?php endif ?>
                    </div>
                    <div>
                        <input class="btn" type="submit" value="投稿画面へ">
                    </div>
                </form>
                <a href="./search_novel.php">検索画面に戻る</a>
            </div>
        </div>
    </div>

</body>
</html>