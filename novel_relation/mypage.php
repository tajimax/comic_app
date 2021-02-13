<?php
    session_start();
    require_once('../mypage/db_connect.php');
    require_once('../mypage/userLogic.php');

    $result = UserLogic::checkLogin();
    
    if(!$result) {
        header('Location: ./search_novel.php');
    }
    
    $login_user = $_SESSION['login_user'];

    $dbh = dbConnect();
    $author = $login_user['name'];

    $novels = $dbh -> prepare('SELECT * FROM novels_table WHERE author = :author');

    $novels -> bindValue(':author', $author, PDO::PARAM_STR);
    $novels -> execute();
    $novels = $novels -> fetchAll(PDO::FETCH_ASSOC);


    $illusts = $dbh -> prepare('SELECT * FROM comics_table WHERE author = :author');

    $illusts -> bindValue(':author', $author, PDO::PARAM_STR);
    $illusts -> execute();
    $illusts = $illusts -> fetchAll(PDO::FETCH_ASSOC);

    // タブリストを定義
    $tabs = array('投稿した作品');    
   
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
            <a class="header__logo" href="search_novel.php">
                <img class="header__logo" src="../images/header_logo.png" alt="logo">
            </a>
            <div class="btn-wrapper">
                <a class="btn" href="./logout.php">ログアウト</a>
                <a class="btn" href="./search_novel.php">検索画面へ</a>
            </div>
        </div>
    </header>


    <!----- マイページ一覧 ----->
    <section class="section-wrapper" id="top">
        <div class="commonInner flex-column">
            <div class="tab-wrapper">
                <!-- 小説かイラストか選択するタブ -->
                <div class="tab-nav flex">
                    <div class="tab-nav__item" v-on:click="change3('0')" v-bind:class="{'active': isActive3 === '0'}">小説</div>
                    <div class="tab-nav__item" v-on:click="change3('1')" v-bind:class="{'active': isActive3 === '1'}">イラスト</div>
                </div>
                <div class="tab-content">
                    <!-- 小説コンテンツ部分 -->
                    <div class="tab-content__item" v-if="isActive3 === '0'">
                        <div class="tab-wrapper">
                            <!-- コンテンツ部分 -->
                            <div class="tab-content2">
                                <div class="grid">
                                    <?php foreach($novels as $result): ?>
                                        <div class="posted-novel flex">
                                            <div class="posted-work__novel-img-wrapper">
                                                <img class="posted-work__img" src="../genre_thumbnails/<?php echo $result['genre'] ?>.jpg">
                                            </div>
                                            <div class="posted-work__novel-content-wrapper">
                                                <a class="posted-work__ttl" href="./brousing_novel.php?title=<?php echo $result['save_path'] ?>"><?php echo $result['title'] ?></a>
                                                <a class="posted-work__author" href="./otherUserPage.php?author=<?php echo $result['author'] ?>"><?php echo $result['author'] ?></a>
                                                <a class="posted-work__genre" href="#"><?php echo $result['genre'] ?></a>
                                                <form method="post" action="../mypage/delete.php">
                                                    <input type="hidden" name="title" value="<?php echo $result['title'] ?>">
                                                    <input class="btn" type="submit" value="削除する">
                                                </form>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- イラスト一覧 -->
                    <div class="tab-content__item" v-if="isActive3 === '1'">
                        <div class="tab-wrapper">
                            <div class="tab-content2">
                                <div class="grid2">
                                    <?php foreach($illusts as $comic): ?>
                                        <div class="posted-illust">
                                            <div class="posted-work__comic-img-wrapper">
                                                <img class="posted-work__img" src="<?php echo $comic['save_path'] ?>" alt="">
                                            </div>
                                            <div class="posted-work__novel-content-wrapper">
                                                <a class="posted-work__ttl" href="brousing.php?title=<?php echo $comic['save_path'] ?>"><?php echo $comic['title'] ?></a>
                                                <a class="posted-work__author" href="otherUserPage.php?author=<?php echo $comic['author'] ?>"><?php echo $comic['author'] ?></a>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="../vue/common.js"></script>
</body>
</html>