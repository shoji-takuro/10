<?php
session_start();

//0.外部ファイル読み込み
include("functions.php");
include("header.php");
ssidChk();

//

//1.  DB接続します
$pdo = db_con();

//2.データ登録SQL作成
//セ・リーグ
$stmt1 = $pdo->prepare("SELECT * FROM central_league");
$status1 = $stmt1->execute();
//パ・リーグ
$stmt2 = $pdo->prepare("SELECT * FROM pacific_league");
$status2 = $stmt2->execute();

//3
//セ・リーグ
$view1 = "";
if($status1==false){
    queryError($stmt1);
} else {
    while($result = $stmt1->fetch(PDO::FETCH_ASSOC)){
        $view1.='<tr>';
        $view1.='<td>';
        $view1.=$result["commentator"];
        $view1.='</td>';
        $view1.='<td>';
        $view1.= '<img width="100" src="upload/'.$result["image"].'">';
        $view1.='</td>';
        $view1.='<td>';
        $view1.=$result["indate"];
        $view1.='</td>';
        $view1.='<td>';
        $view1.=$result["source"];
        $view1.='</td>';
        $view1.='<td>';
        $view1.=$result["first"];
        $view1.='</td>';
        $view1.='<td>';
        $view1.=$result["second"];
        $view1.='</td>';
        $view1.='<td>';
        $view1.=$result["third"];
        $view1.='</td>';
        $view1.='<td>';
        $view1.=$result["fourth"];
        $view1.='</td>';
        $view1.='<td>';
        $view1.=$result["fifth"];
        $view1.='</td>';
        $view1.='<td>';
        $view1.=$result["sixth"];
        $view1.='</td>';
        $view1.='<td>';
        $view1.='<a href="detail.php?id='.$result["id"].'&league=central">';
        $view1.='[詳細&amp;更新]';
        $view1.='</a>';
        $view1.='</td>';
        $view1.='<td>';
        $view1.='<a href="delete.php?id='.$result["id"].'&league=central">';
        $view1.='[削除]';
        $view1.='</a>';
        $view1.='</td>';
        $view1.='</tr>';

    }
}

//パ・リーグ
$view2 = "";
if($status2==false){
    queryError($stmt2);
} else {
    while($result = $stmt2->fetch(PDO::FETCH_ASSOC)){
        $view2.='<tr>';
        $view2.='<td>';
        $view2.=$result["commentator"];
        $view2.='</td>';
        $view2.='<td>';
        $view2.= '<img width="100" src="upload/'.$result["image"].'">';
        $view2.='</td>';
        $view2.='<td>';
        $view2.=$result["indate"];
        $view2.='</td>';
        $view2.='<td>';
        $view2.=$result["source"];
        $view2.='</td>';
        $view2.='<td>';
        $view2.=$result["first"];
        $view2.='</td>';
        $view2.='<td>';
        $view2.=$result["second"];
        $view2.='</td>';
        $view2.='<td>';
        $view2.=$result["third"];
        $view2.='</td>';
        $view2.='<td>';
        $view2.=$result["fourth"];
        $view2.='</td>';
        $view2.='<td>';
        $view2.=$result["fifth"];
        $view2.='</td>';
        $view2.='<td>';
        $view2.=$result["sixth"];
        $view2.='</td>';
        $view2.='<td>';
        $view2.='<a href="detail.php?id='.$result["id"].'&league=pacific">';
        $view2.='[詳細&amp;更新]';
        $view2.='</a>';
        $view2.='</td>';
        $view2.='<td>';
        $view2.='<a href="delete.php?id='.$result["id"].'&league=pacific">';
        $view2.='[削除]';
        $view2.='</a>';
        $view2.='</td>';
        $view2.='</tr>';

    }
}

?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>プロ野球順位予想</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<?= $header ?>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron">
        <p>セ・リーグ順位予想</p>
        <table>
        <thead>
        <tr>
            <th width="120px">解説者</th>
            <th width="120px">画像</th>
            <th width="120px">掲載・放送日</th>
            <th width="120px">出所</th>
            <th width="100px">優勝</th>
            <th width="100px">2位</th>
            <th width="100px">3位</th>
            <th width="100px">4位</th>
            <th width="100px">5位</th>
            <th width="100px">6位</th>
            <th width="100px">詳細&amp;更新</th>
            <th width="60px">削除</th>
        </tr>
        </thead>
        <tbody>
        <?= $view1 ?>
        </tbody>

        </table>
        <p>パ・リーグ順位予想</p>
        <table>
        <thead>
        <tr>
            <th width="120px">解説者</th>
            <th width="120px">画像</th>
            <th width="120px">掲載・放送日</th>
            <th width="120px">出所</th>
            <th width="100px">優勝</th>
            <th width="100px">2位</th>
            <th width="100px">3位</th>
            <th width="100px">4位</th>
            <th width="100px">5位</th>
            <th width="100px">6位</th>
            <th width="100px">詳細&amp;更新</th>
            <th width="60px">削除</th>
        </tr>
        </thead>
        <tbody>
        <?= $view2 ?>
        </tbody>
        </table>
    </div>
</div>
<!-- Main[End] -->

</body>
</html>
