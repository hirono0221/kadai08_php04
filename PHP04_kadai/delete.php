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
$id = $_GET['id'];

//３. DB接続
$pdo = db_conn();

//４．データ登録SQL作成
$stmt = $pdo->prepare('DELETE FROM gs_user_table WHERE id = :id');
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute(); //実行

//５．データ登録処理後
if ($status === false) {
    sql_error($stmt);
} else {
    redirect('select.php');
}