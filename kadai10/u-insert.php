<?php
session_start();

//0.外部ファイル読み込み
include("functions.php");
ssidChk();
flgChk();

//入力チェック(受信確認処理追加)
if(
  !isset($_POST["name"]) || $_POST["name"]=="" ||
  !isset($_POST["lid"]) || $_POST["lid"]=="" ||
  !isset($_POST["lpw"]) || $_POST["lpw"]=="" ||
  !isset($_POST["kanri"]) || $_POST["kanri"]=="" ||
  !isset($_POST["life"]) || $_POST["life"]==""
){
  exit('ParamError');
}

//1. POSTデータ取得
$name = $_POST["name"];
$lid = $_POST["lid"];
$lpw = $_POST["lpw"];
$kanri_flg = $_POST["kanri"];
$life_flg = $_POST["life"];

//2. DB接続します(エラー処理追加)
$pdo = db_con();

//パスワードハッシュ化
$pw = password_hash($lpw, PASSWORD_DEFAULT);

//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO bb_user_table(id, name, lid, lpw, kanri_flg, life_flg )VALUES(NULL, :name, :lid, :lpw, :kanri_flg, :life_flg )");
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
    $stmt->bindValue(':lpw', $pw, PDO::PARAM_STR);
    $stmt->bindValue(':kanri_flg', $kanri_flg, PDO::PARAM_INT);
    $stmt->bindValue(':life_flg', $life_flg, PDO::PARAM_INT);
    $status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  queryError($stmt);
}else{
  //５．index.phpへリダイレクト
  header("Location: u-register.php");
  exit;
}
?>
