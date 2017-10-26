<?php

$header="";
if($_SESSION["kanri_flg"]==0){
    $header.='<header>';
    $header.='<nav class="navbar navbar-default">';
    $header.='<div class="container-fluid">';
    $header.='<div class="navbar-header">';
    $header.='<a class="navbar-brand" href="index.php">';
    $header.='順位予想を登録';
    $header.='</a>';
    $header.='<a class="navbar-brand" href="select.php">';
    $header.='順位予想一覧';
    $header.='</a>';
    $header.='</a>';
    $header.='<a class="navbar-brand" href="logout.php">';
    $header.=$_SESSION["name"];
    $header.='さん[ログアウト]';
    $header.='</a>';
    $header.='</div>';
    $header.='</div>';
    $header.='</nav>';
    $header.='</header>';
}elseif($_SESSION["kanri_flg"]==1){
    $header.='<header>';
    $header.='<nav class="navbar navbar-default">';
    $header.='<div class="container-fluid">';
    $header.='<div class="navbar-header">';
    $header.='<a class="navbar-brand" href="index.php">';
    $header.='順位予想を登録';
    $header.='</a>';
    $header.='<a class="navbar-brand" href="select.php">';
    $header.='順位予想一覧';
    $header.='</a>';
    $header.='<a class="navbar-brand" href="u-register.php">';
    $header.='ユーザー登録';
    $header.='</a>';
    $header.='<a class="navbar-brand" href="u-select.php">';
    $header.='ユーザー一覧';
    $header.='</a>';
    $header.='<a class="navbar-brand" href="logout.php">';
    $header.=$_SESSION["name"];
    $header.='さん[ログアウト]';
    $header.='</a>';
    $header.='</div>';
    $header.='</div>';
    $header.='</nav>';
    $header.='</header>';
}
?>