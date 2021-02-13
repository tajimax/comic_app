<?php 
session_start();

require_once('../mypage/db_connect.php');
require_once('../classes/novel_class.php');

// 画像を保存
// 画像のデータを定義
$file = $_FILES['file'];
$filename = basename($file['name']);
$tmp_path = $file['tmp_name'];
$file_err = $file['error'];
$filesize = $file['size'];

// pdfの保存先を指定
$upload_dir = '../pdfs/';
//保存したファイルを定義
$save_filename = date('YmdHis').$filename;

//pdfファイルのサイズが１MB未満か
if($filesize > 1048576 || $file_err == 2) {
    echo 'ファイルのサイズは１MB未満にして下さい。';
}

// 拡張子はpdf形式か
$allow_ext = array('pdf');
$file_ext = pathinfo($filename, PATHINFO_EXTENSION);

if(!in_array(strtolower($file_ext), $allow_ext)){
    echo 'pdfファイルを添付して下さい。';
}

//ファイルはあるかどうか
if (is_uploaded_file($tmp_path)){
    if(move_uploaded_file($tmp_path, $upload_dir.$save_filename)) {
        echo $filename.'をアップしました。';
    }else{
        echo'ファイルを保存できませんでした。';
    }
}else {
    echo 'ファイルが選択されていません。';
}

$err = [];

// コミッククラスの引数を定義
if(!filter_input(INPUT_POST, 'title')) {
    $err[] = 'タイトルを入力して下さい';
}else {
    $title = $_POST['title'];
}

$author = $_SESSION['login_user']['name'];

if(!filter_input(INPUT_POST, 'genre')) {
    $err[] = 'ジャンルを入力して下さい';
}else {
    $genre = $_POST['genre'];
}

$save_path = $upload_dir.$save_filename;
$save_filename = $save_filename;

if(count($err) === 0) {
    $newNovel = new Novel($title, $author, $genre, $save_path, $save_filename);

    //データ接続及びエラー処理
    $dbh = dbConnect();
    
    //dbへタイトル、著者、ジャンル、投稿日を記録するSQL
    $stmt = $dbh -> prepare('INSERT INTO novels_table(`title`, `author`, `genre`, `save_path`, `save_filename`) VALUES(?, ?, ?, ?, ?)');
    
    //インジェクション攻撃への対策にプレースホルダ設定
    $arr =[];
    $arr[] = $title;
    $arr[] = $author;
    $arr[] = $genre;
    $arr[] = $save_path;
    $arr[] = $save_filename;

    //実際にSQLを実行
    $stmt -> execute($arr);
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
    <div class="login-modal-wrapper">
        <div class="modal">
            <div id="modal__form">
                <?php if(count($err) > 0): ?>
                    <?php foreach($err as $e): ?>
                        <p><?php echo $e ?></p>
                    <?php endforeach ?>
                <?php else: ?>
                    <div>
                        <p>title: <?php echo $newNovel -> title ?></p>
                        <p>author: <?php echo $newNovel -> author ?></p>
                        <p>-------------------------------------------</p>
                        <a href="../novel_relation/post_work.php">アップロード画面へ戻る</a>
                        <a href="../novel_relation/search_novel.php">漫画を探す</a>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>
</body>
</html>












