<?php
session_start();

//0.外部ファイル読み込み
include("functions.php");
ssidChk();
flgChk();

$id = $_GET["id"];

//1.  DB接続します
$pdo = db_con();

//２．データ登録SQL作成
$stmt = $pdo->prepare("DELETE FROM bb_user_table WHERE id=:id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

if($status==false){
  queryError($stmt);
}else{
  //５．index.phpへリダイレクト
  header("Location: u-select.php");
  exit;
}

?>