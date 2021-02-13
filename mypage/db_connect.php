<?php

function dbConnect() {
    //データ接続の準備

    $dsn = 'mysql:host=localhost;dbname=comic_app;charset=utf8';
    $user = 'comic_user';
    $password = 'shun0811';
    
    //データ接続とエラー処理
    try {
        $dbh = new PDO($dsn, $user, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dbh;
    } catch (PDOException $e) {
        echo 'データベースへの接続に失敗しました。' . $e->getMessage();
        exit();
    }
}

?>