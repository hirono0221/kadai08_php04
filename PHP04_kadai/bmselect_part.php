<?php

// 0. SESSION開始！！
session_start();

//１．関数群の読み込み
require_once('funcs.php');

// ログインチェック処理！ このphpはログイン不要にする
// 以下、セッションID持ってたら、ok
// 持ってなければ、閲覧できない処理にする。
//funcs.phpを読み込まないとダメ
// loginCheck();

//２.  DB接続します
$pdo = db_conn();

//３．データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table");
$status = $stmt->execute();

//４．データ表示
$view = "";
if ($status == false) {
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit("ErrorQuery:" . $error[2]);
} else {
    //Selectデータの数だけ自動でループしてくれる
    //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {

        $view .= '<table>'; 

        $view .= '<p>';
        $view .= '<td>'.h($result['id']) . '</td>'. '<td>'. h($result['bookName']) . '</td>' . '<td>'. h($result['bookUrl']). '</td>'  .'<td>'. h($result['bookComment']).  '</td>';
      
        $view .= '</p>';
        $view .= '</table>';
    }
}
?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bookマーク表示</title>
    <link rel="stylesheet" href="css/range.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        table,tr,td,th{
            border: solid 1px black; border-collapse: collapse;
        }
        tr,td,th{
            width: 300px;
            max-width: 300px;
            height: 300px;
            word-wrap: break-word
        }
        th{
            background: silver;
        }
        p{
            text-align: center;
        }
    </style>
</head>

<body id="main">
    <!-- Head[Start] -->
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="menu.php">メニュー画面へ移動</a>
                </div>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->
    <div>
        <div class="container jumbotron">
            <a href="bmdetail.php"></a>
            <table align="center">
                <tr>
                    <th>ID</th>
                    <th>書籍名</th>
                    <th>書籍URL</th>
                    <th>書籍コメント</th>     
                </tr>
            </table>
          <?= $view ?>
        </div>
    </div>
    <!-- Main[End] -->
</body>

</html>