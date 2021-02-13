<?php 
session_start();

require_once('../mypage/db_connect.php');
require_once('../classes/comic_class.php');

// 画像を保存
// 画像のデータを定義
$file = $_FILES['file'];
$filename = basename($file['name']);
$tmp_path = $file['tmp_name'];
$file_err = $file['error'];
$filesize = $file['size'];

// アップロード先を指定
$upload_dir = '../illustrations/';
//保存したファイルを定義
$save_filename = date('YmdHis').$filename;


//画像ファイルのバリデーション
//ファイルのサイズが１MB未満か
if($filesize > 1048576 || $file_err == 2) {
    echo 'ファイルのサイズは１MB未満にして下さい。';
}

// 拡張は画像形式か
$allow_ext = array('jpg', 'jpeg', 'png');
$file_ext = pathinfo($filename, PATHINFO_EXTENSION);

if(!in_array(strtolower($file_ext), $allow_ext)){
    echo '画像ファイルを添付して下さい。';
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


$save_path = $upload_dir.$save_filename;
$save_filename = $save_filename;

if(count($err) === 0) {
    $newComic = new Comic($title, $author, $save_path, $save_filename);

    //データ接続及びエラー処理
    $dbh = dbConnect();
    
    //dbへタイトル、著者、ジャンル、投稿日を記録するSQL
    $stmt = $dbh -> prepare('INSERT INTO comics_table(`title`, `author` ,`save_path`, `save_filename`) VALUES(?, ?, ?, ?)');
    
    //インジェクション攻撃への対策にプレースホルダ設定
    $arr =[];
    $arr[] = $title;
    $arr[] = $author;
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
    <title>testdayo</title>
</head>
<body>
    <div>
        <?php if(count($err) > 0): ?>
            <?php foreach($err as $e): ?>
                <p><?php echo $e ?></p>
            <?php endforeach ?>
        <?php else: ?>
            <div>
                <p>title: <?php echo $newComic -> title ?></p>
                <p>author: <?php echo $newComic -> author ?></p>
                <p>-------------------------------------------</p>
                <a href="upload_comic.php">アップロード画面へ戻る</a>
                <a href="index.php">最初の画面に戻る</a>
                <a href="search.php">漫画を探す</a>
            </div>
        <?php endif ?>
    </div>
</body>
</html>












