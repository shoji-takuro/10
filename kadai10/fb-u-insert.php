<?php

//0.外部ファイル読み込み
include("functions.php");

//入力チェック(受信確認処理追加)
if(
  !isset($_POST["name"]) || $_POST["name"]=="" ||
  !isset($_POST["fbId"]) || $_POST["fbId"]=="" ||
  !isset($_POST["email"]) || $_POST["email"]=="" ||
  !isset($_POST["kanri"]) || $_POST["kanri"]=="" ||
  !isset($_POST["life"]) || $_POST["life"]==""
){
  exit('ParamError');
}

//1. POSTデータ取得
$name = $_POST["name"];
$fbId = $_POST["fbId"];
$email = $_POST["email"];
$kanri_flg = $_POST["kanri"];
$life_flg = $_POST["life"];

//2. DB接続します(エラー処理追加)
$pdo = db_con();

//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO bb_user_table(id, name, email, kanri_flg, life_flg, fbid)VALUES(NULL, :name, :email, :kanri_flg, :life_flg, :fbid )");
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->bindValue(':fbid', $fbId, PDO::PARAM_INT);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':kanri_flg', $kanri_flg, PDO::PARAM_INT);
    $stmt->bindValue(':life_flg', $life_flg, PDO::PARAM_INT);
    $status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  queryError($stmt);
}else{
  //５．login.phpへリダイレクト
  header("Location: login.php");
  exit;
}
?>