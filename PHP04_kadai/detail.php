<?php

// 0. SESSION開始！！
session_start();

//１．関数群の読み込み
require_once('funcs.php');

// ログインチェック処理！
// 以下、セッションID持ってたら、ok
// 持ってなければ、閲覧できない処理にする。
//funcs.phpを読み込まないとダメ
loginCheck();

//２. POSTデータ取得
$id = $_GET['id']; //?id~**を受け取る

//３. DB接続
$pdo = db_conn();

//４．データ登録SQL作成
$stmt = $pdo->prepare('SELECT * FROM gs_user_table WHERE id = :id');
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//５．データ表示
$view = '';
if ($status === false) {
    // ここを修正
    sql_error($stmt);
} else {
    //データが取得できたら。
    $view = $stmt->fetch();
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
    <title>ユーザー登録更新</title>
</head>

<body>

    <!-- Head[Start] -->
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->
    <form method='post' action='insert.php'>
        <div class="jumbotron">
        <fieldset>
                <legend>ユーザー登録変更</legend>
                <label>名前：<input type="text" name="name" value=<?= $view['name']?>></label><br>
                <label>ID：<input type="text" name="lid" value=<?= $view['lid']?>></label><br>
                <label>PW：<input type="text" name="lpw" value=<?= $view['lpw']?>></label><br>
                <label>管理者：<input type="checkbox" name="kanri_flg"　checked value=<?= $view['kanri_flg']?>></label><br>
                <label>退職者：<input type="checkbox" name="life_flg" checked value=<?= $view['life_flg']?>></label><br>
                <input type="submit" value="送信">
            </fieldset>
        </div>
    </form>
    <!-- Main[End] -->

</body>

</html>