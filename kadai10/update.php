<?php
session_start();

//0.外部ファイル読み込み
include("functions.php");
ssidChk();

//入力チェック
if(
    !isset($_POST["commentator"]) || $_POST["commentator"]=="" ||
    !isset($_POST["date"]) || $_POST["date"]=="" ||
    !isset($_POST["source"]) || $_POST["source"]=="" ||
    !isset($_POST["selectLeague"]) || $_POST["selectLeague"]=="" ||
    !isset($_POST["first"]) || $_POST["first"]=="" ||
    !isset($_POST["second"]) || $_POST["second"]=="" ||
    !isset($_POST["third"]) || $_POST["third"]=="" ||
    !isset($_POST["fourth"]) || $_POST["fourth"]=="" ||
    !isset($_POST["fifth"]) || $_POST["fifth"]=="" ||
    !isset($_POST["sixth"]) || $_POST["sixth"]=="" ||
    !isset($_POST["remarks"]) || $_POST["remarks"]==""
){
    exit('ParamError');
}

//1.POSTでParamを取得
$id = $_POST["id"];
$commentator = $_POST["commentator"];//解説者
$date = $_POST["date"];//掲載・放送日
$source = $_POST["source"];//出所
$league = $_POST["selectLeague"];//出所
$first = $_POST["first"];//1位
$second = $_POST["second"];//2位
$third = $_POST["third"];//3位
$fourth = $_POST["fourth"];//4位
$fifth = $_POST["fifth"];//5位
$sixth = $_POST["sixth"];//6位
$remarks = $_POST["remarks"];//備考

//Fileアップロードチェック
if (isset($_FILES["upfile"] ) && $_FILES["upfile"]["error"] ==0 ) {
    //情報取得
    $file_name = $_FILES["upfile"]["name"];         //"1.jpg"ファイル名取得
    $tmp_path  = $_FILES["upfile"]["tmp_name"]; //"/usr/www/tmp/1.jpg"アップロード先のTempフォルダ
    $file_dir_path = "upload/";  //画像ファイル保管先

    
    //***File名の変更***
    $extension = pathinfo($file_name, PATHINFO_EXTENSION); //拡張子取得(jpg, png, gif)
    $file_name = date("YmdHis").md5(session_id()) . "." . $extension;  //ユニークファイル名作成
   

    $img="";  //画像表示orError文字を保持する変数
    // FileUpload [--Start--]
    if ( is_uploaded_file( $tmp_path ) ) {
        if ( move_uploaded_file( $tmp_path, $file_dir_path . $file_name ) ) {
            chmod( $file_dir_path . $file_name, 0644 );
        }
    }
    // FileUpload [--End--]
}
    
//2.DB接続など
$pdo = db_con();


//3.UPDATE gs_an_table SET ....; で更新(bindValue)
//　基本的にinsert.phpの処理の流れです。
if($league == "central" ){
    //セ・リーグ
    $stmt = $pdo->prepare("UPDATE central_league SET commentator=:commentator, indate=:date, source=:source, first=:first, second=:second, third=:third, fourth=:fourth, fifth=:fifth, sixth=:sixth, remarks=:remarks, image=:image WHERE id=:id");
    $stmt->bindValue(':commentator', $commentator, PDO::PARAM_STR);
    $stmt->bindValue(':date', $date, PDO::PARAM_STR);
    $stmt->bindValue(':source', $source, PDO::PARAM_STR);
    $stmt->bindValue(':first', $first, PDO::PARAM_STR);
    $stmt->bindValue(':second', $second, PDO::PARAM_STR);
    $stmt->bindValue(':third', $third, PDO::PARAM_STR);
    $stmt->bindValue(':fourth', $fourth, PDO::PARAM_STR);
    $stmt->bindValue(':fifth', $fifth, PDO::PARAM_STR);
    $stmt->bindValue(':sixth', $sixth, PDO::PARAM_STR);
    $stmt->bindValue(':remarks', $remarks, PDO::PARAM_STR);
    $stmt->bindValue(':image', $file_name, PDO::PARAM_STR);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $status = $stmt->execute();
} else {
    //パリーグ
    $stmt = $pdo->prepare("UPDATE pacific_league SET commentator=:commentator, indate=:date, source=:source, first=:first, second=:second, third=:third, fourth=:fourth, fifth=:fifth, sixth=:sixth, remarks=:remarks, image=:image WHERE id=:id");
    $stmt->bindValue(':commentator', $commentator, PDO::PARAM_STR);
    $stmt->bindValue(':date', $date, PDO::PARAM_STR);
    $stmt->bindValue(':source', $source, PDO::PARAM_STR);
    $stmt->bindValue(':first', $first, PDO::PARAM_STR);
    $stmt->bindValue(':second', $second, PDO::PARAM_STR);
    $stmt->bindValue(':third', $third, PDO::PARAM_STR);
    $stmt->bindValue(':fourth', $fourth, PDO::PARAM_STR);
    $stmt->bindValue(':fifth', $fifth, PDO::PARAM_STR);
    $stmt->bindValue(':sixth', $sixth, PDO::PARAM_STR);
    $stmt->bindValue(':remarks', $remarks, PDO::PARAM_STR);
    $stmt->bindValue(':image', $file_name, PDO::PARAM_STR);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $status = $stmt->execute();
}

if($status==false){
  queryError($stmt);
}else{
  //５．index.phpへリダイレクト
  header("Location: select.php");
  exit;
}

?>
