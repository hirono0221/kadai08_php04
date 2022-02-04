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

//２.  DB接続します
$pdo = db_conn();

//X25．kanri_flgを確認
$_S = $_SESSION['kanri_flg'];

//３．データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_user_table");
$status = $stmt->execute();

//X４．データ表示
$view = "";
if ($_S == 1) {
    echo "<a href= bmselect.php>"."ブックマーク一覧（ログイン必要）"."</a>";

if ($status == false) {
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit("ErrorQuery:" . $error[2]);
} else {

    //Selectデータの数だけ自動でループしてくれる
    //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php    
    
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {

        $view .= '<table align="center">';

        $view .= '<td>'.$result['name'].'</td>'. '<td>'.$result['lid']. '</td>'.'<td>'.$result['lpw']. '</td>'. '<td>'.$result['kanri_flg']. '</td>'.'<td>'. $result['life_flg']. '</td>';

        $view .= '<td>'.'<a href="detail.php?id='.$result['id'] .'">';
        $view .= '<img src="https://free-icons.net/wp-content/uploads/2021/02/symbol065.png" alt="" height="50px" width="50px">';
        $view .= '</a>'.'</td>';

        $view .= '<td>'.'<a href="delete.php?id='.$result['id'] .'">';
        $view .= '<img src="https://free-icons.net/wp-content/uploads/2021/03/symbol079.png" alt="" height="50px" width="50px">';
        $view .= '</a>'.'</td>';

        $view .= '</p>';
        $view .= '</table>';
    }
}
} else {
    echo "<a  href= login.php>"."ログイン画面"."</a>";
}

// //４．データ表示
// $view = "";
// if ($status == false) {
//     //execute（SQL実行時にエラーがある場合）
//     $error = $stmt->errorInfo();
//     exit("ErrorQuery:" . $error[2]);
// } else {

//     //Selectデータの数だけ自動でループしてくれる
//     //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php    
    
//     while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {

//         $view .= '<table align="center">';

//         $view .= '<td>'.$result['name'].'</td>'. '<td>'.$result['lid']. '</td>'.'<td>'.$result['lpw']. '</td>'. '<td>'.$result['kanri_flg']. '</td>'.'<td>'. $result['life_flg']. '</td>';

//         $view .= '<td>'.'<a href="detail.php?id='.$result['id'] .'">';
//         $view .= '<img src="https://free-icons.net/wp-content/uploads/2021/02/symbol065.png" alt="" height="50px" width="50px">';
//         $view .= '</a>'.'</td>';

//         $view .= '<td>'.'<a href="delete.php?id='.$result['id'] .'">';
//         $view .= '<img src="https://free-icons.net/wp-content/uploads/2021/03/symbol079.png" alt="" height="50px" width="50px">';
//         $view .= '</a>'.'</td>';

//         $view .= '</p>';
//         $view .= '</table>';
//     }
// }
?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>登録ユーザー表示</title>
    <link href="css/bootstrap.min.css" rel="stylesheet"> -->
    <style>
        div {
        font-size: 16px;
        }
        table,tr,td,th{
        width: 100%;
        table-layout: fixed;
        border-bottom:1px solid #000000;
        }

        table {
        width: 100%;
        table-layout: fixed;
        }
    </style>
</head>

<body id="main">
    <!-- Head[Start] -->
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">ユーザー登録</a>
                </div>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->
    <div>
        <div class="container jumbotron">
              <a href="detail.php"></a>
              <table align="center">
                <tr>
                    <th>名前</th>
                    <th>ID</th>
                    <th>PW</th>
                    <th>管理者</th>
                    <th>退職者</th>
                    <th>更新</th>
                    <th>削除</th>
                </tr>
              </table>
            <?= $view ?>
        </div>
    </div>
    <!-- Main[End] -->
</body>

</html>