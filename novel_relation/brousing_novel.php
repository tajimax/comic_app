<?php
    require_once('../mypage/db_connect.php');

    $save_path = $_GET['title'];

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
</head>
<body>
    <!----- ヘッダー部分 ----->
    <header class="header flex">
        <div class="commonInner flex">
            <a class="header__logo" href="./search_novel.php">
                <img class="header__logo" src="../images/header_logo.png" alt="logo">
            </a>
            <div class="btn-wrapper">
                <a class="btn" href="search_novel.php">検索画面へ</a>
            </div>
        </div>
    </header>

    

    <!-- 作品閲覧部分 -->
    <div class="brousing-work">
        <embed src="<?php echo $save_path ?>" type="application/pdf" width="100%" height="100%">
    </div>

    <script src="../js/mypage_modal.js"></script>
</body>
</html>