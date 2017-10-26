<?php
session_start();
include("functions.php");
 
header("Content-type: text/html; charset=utf-8");
 
//設定ファイル
require_once("config.php");
 
if (isset($_SESSION['fb_access_token'])) {
	
	$accessToken = $_SESSION['fb_access_token'];
 
	$fb->setDefaultAccessToken($accessToken);
	
	try {
		//取得するユーザ情報の指定
		$response = $fb->get('/me?fields=id,name,first_name,last_name,email,gender');
		$profile = $response->getGraphUser();
		
	} catch(Facebook\Exceptions\FacebookResponseException $e) {
		// When Graph returns an error
		echo 'Graph returned an error: ' . $e->getMessage();
		exit;
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
		// When validation fails or other local issues
		echo 'Facebook SDK returned an error: ' . $e->getMessage();
		exit;
	}
	
	$fbId=$profile['id'];
	$name=$profile['name'];
    $email=$profile['email'];
 
}else{
	header("Location: logout.php");
	exit();
}


//通常のログイン処理
//1.  DB接続します
$pdo = db_con();

//2. データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM bb_user_table WHERE fbid=:fbid");
$stmt->bindValue(':fbid', $fbId, PDO::PARAM_INT);
$res = $stmt->execute();

//3. SQL実行時にエラーがある場合
if($res==false){
  queryError($stmt);
}

//4. 抽出データ数を取得
//$count = $stmt->fetchColumn(); //SELECT COUNT(*)で使用可能()
$val = $stmt->fetch(); //1レコードだけ取得する方法


//5. 該当レコードがあればSESSIONに値を代入
if( $val["fbid"] != "" ){
  $_SESSION["chk_ssid"]  = session_id();
  $_SESSION["kanri_flg"] = $val['kanri_flg'];
  $_SESSION["name"]      = $val['name'];
  header("Location: select.php");
}else{
  //新規会員登録(fb-entry.php)へ
  header("Location: fb-entry.php");
}

exit();
 


?>
 
<!--#_=_を排除する-->
<script type="text/javascript">
if (window.location.hash && window.location.hash == '#_=_') {
  if (window.history && history.pushState) {
      window.history.pushState("", document.title, window.location.pathname);
  } else {
    // Prevent scrolling by storing the page's current scroll offset
    var scroll = {
        top: document.body.scrollTop,
      left: document.body.scrollLeft
    };
    window.location.hash = '';
    // Restore the scroll offset, should be flicker free
    document.body.scrollTop = scroll.top;
    document.body.scrollLeft = scroll.left;
  }
}
</script>