<?php

// 0. SESSION開始！！
session_start();

//１．関数群の読み込み
require_once('funcs.php');

// //２．kanri_flgを確認
// $_S = $_SESSION['kanri_flg'];

//３.  DB接続
require_once('funcs.php');
$pdo = db_conn();

?>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="bmselect_part.php">ブックマーク一覧（ログイン不要）</a>
            <a class="navbar-brand" href="bmselect.php">ブックマーク一覧（ログイン必要）</a>           　         

            <!-- <?php
            if ($_S == 1) {
                echo "<a href= bmselect.php>"."ブックマーク一覧（ログイン必要）"."</a>";
            } else {
                echo "<a  href= login.php>"."ログイン画面"."</a>";
            }
            ?> -->
            <!-- <a class="navbar-brand" href="select.php">ユーザー一覧</a>　 -->
            <a class="navbar-brand" href="login.php">ログイン</a>               
            <a class="navbar-brand" href="logout.php">ログアウト</a>            
        </div>
    </div>
</nav>