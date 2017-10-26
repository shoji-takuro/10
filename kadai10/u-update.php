<?php
session_start();

//0.外部ファイル読み込み
include("functions.php");
ssidChk();
flgChk();

if(
  !isset($_POST["id"]) || $_POST["id"]=="" ||
  !isset($_POST["name"]) || $_POST["name"]=="" ||
  !isset($_POST["lid"]) || $_POST["lid"]=="" ||
  !isset($_POST["lpw"]) || $_POST["lpw"]=="" ||
  !isset($_POST["kanri"]) || $_POST["kanri"]=="" ||
  !isset($_POST["life"]) || $_POST["life"]==""
){
  exit('ParamError');
}

//1.POSTでParamを取得
$id = $_POST["id"];
$name = $_POST["name"];
$lid = $_POST["lid"];
$lpw = $_POST["lpw"];
$kanri_flg = $_POST["kanri"];
$life_flg = $_POST["life"];
    
//2.DB接続など
$pdo = db_con();

//パスワードハッシュ化
$pw = password_hash($lpw, PASSWORD_DEFAULT);

//3.UPDATE gs_an_table SET ....; で更新(bindValue)
//　基本的にinsert.phpの処理の流れです。
$stmt = $pdo->prepare("UPDATE bb_user_table SET name=:name, lid=:lid, lpw=:lpw, kanri_flg=:kanri_flg, life_flg=:life_flg WHERE id=:id");
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$stmt->bindValue(':lpw', $pw, PDO::PARAM_STR);
$stmt->bindValue(':kanri_flg', $kanri_flg, PDO::PARAM_INT);
$stmt->bindValue(':life_flg', $life_flg, PDO::PARAM_INT);
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