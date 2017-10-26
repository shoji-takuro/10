<?php
/** 共通で使うものを別ファイルにしておきましょう。*/

//DB接続関数（PDO）
function db_con(){
  $dbname='pro_bb';
  $dbpass='';
  try {
    $pdo = new PDO('mysql:dbname='.$dbname.';charset=utf8;host=localhost','root',$dbpass);
  } catch (PDOException $e) {
    exit('DbConnectError:'.$e->getMessage());
  }
  return $pdo; //
}

//SQL処理エラー
function queryError($stmt){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
}

/**
* XSS
* @Param:  $str(string) 表示する文字列
* @Return: (string)     サニタイジングした文字列
*/
function h($str){
  return htmlspecialchars($str, ENT_QUOTES, "UTF-8");
}

//SessionCheck関数
function ssidChk(){
if(!isset($_SESSION["chk_ssid"]) ||
  $_SESSION["chk_ssid"]!=session_id()){
    echo "Login Error.";
    exit();
}else{
    session_regenerate_id(true);
    $_SESSION["chk_ssid"] = session_id();
}
}

//kanri_flgCheck関数
function flgChk(){
if($_SESSION["kanri_flg"]==0){
    echo "権限がありません。";
    exit();
}
}


?>