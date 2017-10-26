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

?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>プロ野球順位予想</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>


<!-- Main[Start] -->
<form method="post" action="fb-u-insert.php">
  <div class="jumbotron">
   <fieldset>
    <legend>facebookからのユーザー登録</legend>
    <table>
        <tr>
            <th><label for="name">名前</label></th>
            <td><input type="text" name="name" id="name" value="<?= $name ?>"></td>
        </tr>
        <tr>
            <th><label for="email">メールアドレス</label></th>
            <td><input type="text" name="email" id="email" value="<?= $email ?>"></td>
        </tr>
        <tr>
            <th>管理フラグ</th>
            <td>
                <input type="radio" id="kanri0" name="kanri" value="0"><label for="kanri0">管理者</label>
                <input type="radio" id="kanri1" name="kanri" value="1"><label for="kanri1">スーパー管理者</label>
            </td>
        </tr>
        <tr>
            <th>ライフフラグ</th>
            <td>
                <input type="radio" id="life0" name="life" value="0"><label for="life0">使用中</label>
                <input type="radio" id="life1" name="life" value="1"><label for="life1">使用しなくなった</label>
            </td>
        </tr>
    </table>
    <input type="hidden" name="fbId" value="<?= $fbId ?>">
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
