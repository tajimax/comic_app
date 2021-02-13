<?php

require_once('db_connect.php');

$title = $_POST['title'];

$dbh = dbConnect();
$delete = $dbh -> prepare('DELETE FROM novels_table WHERE title = :title');

//インジェクション攻撃への対策にプレースホルダ設定
$delete -> bindValue(':title', $title, PDO::PARAM_STR);

//sqlを実行
$delete -> execute();

header('Location: ../novel_relation/mypage.php');
