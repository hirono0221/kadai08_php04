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
$stmt = $pdo->prepare('SELECT * FROM gs_bm_table WHERE id = :id');
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

<!--
HTML
以下にindex.phpのHTMLをまるっと貼り付ける！
(入力項目は「登録/更新」はほぼ同じになるから)
※form要素 input type="hidden" name="id" を１項目追加（非表示項目）
※form要素 action="update.php"に変更
※input要素 value="ここに変数埋め込み"
-->

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>ブックマークDBデータ登録</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>

<body>

    <!-- Head[Start] -->
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header"><a class="navbar-brand" href="bmselect.php">Bookマーク</a></div>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->
    <form method='post' action='bmupdate.php'>
        <div class="jumbotron">
            <fieldset>
                <legend>Bookマーク内容更新</legend>
                <label>書籍名：<input type="text" name="bookName" value=<?= $view['bookName'] ?>></label><br>
                <label>書籍URL：<input type="text" name="bookUrl" value=<?= $view['bookUrl'] ?>></label><br>
                <label>書籍コメント<textarea name="bookComment" rows="4" cols="40"><?= $view['bookComment'] ?></textarea></label><br>
                <input type="hidden" name="id" value=<?= $view['id'] ?>><br>
                <input type="submit" value="送信">
            </fieldset>
        </div>
    </form>
    <!-- Main[End] -->


</body>

</html>