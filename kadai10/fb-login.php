<?php
session_start();
header("Content-type: text/html; charset=utf-8");
 
//設定ファイル
require_once("config.php");

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl('http://localhost/kadai10/callback.php', $permissions);

echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';

?>