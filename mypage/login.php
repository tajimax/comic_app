<?php

require_once('userLogic.php');

session_start();

// エラーメッセージ
$err = [];

// バリデーション
if(!$email = filter_input(INPUT_POST, 'email')) {
    $err['email'] = 'メールアドレスを入力して下さい';
}
if(!$password = filter_input(INPUT_POST, 'password')) {
    $err['password'] = "パスワードは半角英小文字大文字数字をそれぞれ1種類以上含む8文字以上100文字以下にして下さい";
}

if (count($err) > 0) {
    $_SESSION = $err;
    header('Location: ../novel_relation/search_novel.php');
    return;
}

// ログイン成功時の処理
$result = UserLogic::login($email, $password);

// ログイン失敗時の処理
if(!$result) {
    header('Location: ../novel_relation/search_novel.php');
    return;
}

header('Location: ../novel_relation/mypage.php');

?>