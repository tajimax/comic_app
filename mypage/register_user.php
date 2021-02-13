<?php 
session_start();



require_once('db_connect.php');
require_once('userLogic.php');

// エラーメッセージ
$err = [];

// $token = filter_input(INPUT_POST, 'csrf_token');

// if(!isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']) {
//     exit('不正なリクエストです');
// }

// unset($_SESSION['csrf_token']);

// バリデーション
if(!$userName = filter_input(INPUT_POST, 'userName')) {
    $err[] = 'ニックネームを入力して下さい';
}
if(!$email = filter_input(INPUT_POST, 'email')) {
    $err[] = 'メールアドレスを入力して下さい';
}
// 正規表現
$password = filter_input(INPUT_POST, 'password');
if (!preg_match('/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,100}+\z/i', $password)) {
    $err[] = 'パスワードは半角英小文字大文字数字をそれぞれ1種類以上含む8文字以上100文字以下にして下さい';
}
$password_conf = filter_input(INPUT_POST, 'password_conf');
if($password_conf !== $password) {
    $err[] = '確認用のパスワードと異なっています';
}

if (count($err) === 0) {
    $hasCreated = UserLogic::createUser($_POST);

    if(!$hasCreated) {
        $err[] = '登録に失敗しました。';
    }
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php if(count($err) > 0): ?>
        <?php foreach($err as $e): ?>
            <p><?php echo $e ?></p>
        <?php endforeach ?>
    <?php else: ?>
        <p>登録しました</p>
    <?php endif ?>
    <a href="signup_form.php">戻る</a>
</body>
</html>

