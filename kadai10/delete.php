<?php
session_start();

//0.外部ファイル読み込み
include("functions.php");
ssidChk();

//GETでidを取得
$id = $_GET["id"];
$league = $_GET["league"];//リーグ判別

//1.  DB接続します
$pdo = db_con();

//２．データ削除SQL作成

if($league == "central"){
    $stmt = $pdo->prepare("DELETE FROM central_league WHERE id=:id");
} else {
    $stmt = $pdo->prepare("DELETE FROM pacific_league WHERE id=:id");
}
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

if($status==false){
  queryError($stmt);
}else{
  //５．index.phpへリダイレクト
  header("Location: select.php");
  exit;
}

?>