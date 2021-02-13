<?php 
    require_once('../mypage/userLogic.php');

    session_start();
    
    $result = UserLogic::checkLogin();

    if(!$result){
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
            header('Location: ./post_work.php');
            return;
        }
        
        // ログイン成功時の処理
        $result = UserLogic::login($email, $password);
        
        // ログイン失敗時の処理
        if(!$result) {
            header('Location: ./post_work.php');
            return;
        }
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

   <!-- 投稿モーダル部分 -->
    <div id="top">
        <div class="modal-wrapper">
            <div class="modal" style="background-color:white;">
                <div class="modal__form">
                        <?php if(isset($err['msg'])): ?>
                                <p><?php echo $err['msg'] ?></p>
                        <?php endif ?>
                    
                    <div class="tab-wrapper">
                        <div class="tab-nav flex">
                            <div class="tab-nav__item" v-on:click="change2('0')" v-bind:class="{'active': isActive2 === '0'}">小説を投稿</div>
                            <div class="tab-nav__item" v-on:click="change2('1')" v-bind:class="{'active': isActive2 === '1'}">イラストを投稿</div>
                        </div>
                        <div class="tab-content2">
                            <div class="tab-content2__item" v-if="isActive2 === '0'">
                                <form class="upload__form" action="../mypage/register_novel.php" method="post" enctype="multipart/form-data">
                                    <div class="upload__form_wrapper">
                                        <div class="upload__content">
                                            <input class="upload__form_item" type="text" placeholder="タイトル" name="title">
                                            <input type="hidden" name="MAX_FILE_SIZE" value="1048576">
                                        </div>
                                        <div class="upload__content">
                                            <label for="file">
                                                <input class="upload__form_item" type="file" accept="application/pdf" name="file" id="file">ファイルを選択してください
                                            </label>
                                        </div>
                                        <div class="upload__content">
                                            <select class="upload__form_item" type="text" placeholder="ジャンル" name="genre">
                                                <option disabled selected value>ジャンルを選択してください</option>
                                                <option value="恋愛">恋愛</option>
                                                <option value="バトル">バトル</option>
                                                <option value="ファンタジー">ファンタジー</option>
                                            </select>
                                        </div>
                                        <input class="btn" type="submit" value="投稿する">
                                    </div>
                                    <a href="./search_novel.php">検索画面に戻る</a>
                                </form>
                            </div>
                            <div class="tab-content2__item" v-if="isActive2 === '1'">
                                <form class="upload__form" action="../mypage/register_comic.php" method="post" enctype="multipart/form-data">
                                    <div class="upload__form_wrapper">
                                        <div class="upload__content">
                                            <input class="upload__form_item" type="text" placeholder="タイトル" name="title">
                                            <input type="hidden" name="MAX_FILE_SIZE" value="1048576">
                                        </div>
                                        <div class="upload__content">
                                            <input class="upload__form_item" type="file" accept="image/*" name="file">
                                        </div>
                                        <input class="btn" type="submit" value="投稿する">
                                    </div>
                                </form>
                                <a href="./search_novel.php">検索画面に戻る</a>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="../vue/common.js"></script>

</body>
</html>