<?php
session_start();

require_once('../mypage/userLogic.php');

UserLogic::logout();

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

    <!-- ログインモーダル部分 -->
    <div class="login-modal-wrapper">
        <div class="modal">
            <div id="modal__form">
                <h2>ログアウト完了</h2>
                <a href="./search_novel.php">ログイン画面へ</a>
            </div>
        </div>
    </div>

</body>
</html>