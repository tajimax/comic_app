<?php 

require_once('db_connect.php');

class UserLogic {
    // ユーザーを登録する
    public static function createUser($userData) {
        $result = false;

        $sql = 'INSERT INTO users (name, email, password) VALUES (?, ?, ?)';    // 実行するsql文
        
        $arr = [];      // ユーザーデータを配列に格納
        $arr[] = $userData['userName'];
        $arr[] = $userData['email'];
        $arr[] = password_hash($userData['password'], PASSWORD_DEFAULT);

        try {
            $stmt = dbConnect() -> prepare($sql);
            $result = $stmt -> execute($arr);
            // ユーザーデータを配列に代入
            return $result;
        } catch (\Exception $e) {
            return $result;
        }
    }


    // ログイン処理
    public static function login($email, $password) {
        //結果
        $result = false;
        //ユーザーをemailから検索して取得
        $user = self::getUserByEmail($email);

        if(!$user) {
            $_SESSION['msg'] = 'emailが一致しません';
            return $result;
        }

        // パスワード照会
        if (password_verify($password, $user['password'])) {
            session_regenerate_id(true);
            $_SESSION['login_user'] = $user;
            $result = true;
            return $result;
        }

        $_SESSION['msg'] = 'パスワードが一致しません';
        return $result;
    }


    // emailからユーザーを取得
    public static function getUserByEmail($email) {
        $sql = 'SELECT * FROM users WHERE email = ?';
        
        $arr = [];
        $arr[] = $email;
        
        try {
            $stmt = dbConnect() -> prepare($sql);
            $stmt -> execute($arr);
            $user = $stmt -> fetch();
            return $user;
        } catch (\Exception $e) {
            return false;
        }
    }


    public static function checkLogin() {
        $result = false;

        if(isset($_SESSION['login_user']) && $_SESSION['login_user']['id'] > 0) {
            return $result = true;
        }

        return $result;
    }


    public static function logout() {
        $_SESSION = array();
        session_destroy();
    }
}