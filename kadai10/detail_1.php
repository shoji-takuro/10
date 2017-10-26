<?php

//0.外部ファイル読み込み
include("functions.php");

//1.GETでidを取得
$id = $_GET["id"];
$league = $_GET["league"]; //リーグ判別

//2.DB接続など
$pdo = db_con();

//２．データ登録SQL作成
if($league == "central"){
    $stmt = $pdo->prepare("SELECT * FROM central_league WHERE id=:id");
} else {
    $stmt = $pdo->prepare("SELECT * FROM pacific_league WHERE id=:id");
}
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false){
  queryError($stmt);
}else{
  //Selectデータの数だけ自動でループしてくれる
  $row = $stmt->fetch();
}

//リーグ表示
$leagueView="";
if($league == "central"){
    $leagueView='セ・リーグ';
} else {
    $leagueView='パ・リーグ';
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>プロ野球順位予想</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="select_1.php">順位予想一覧</a></div>
      </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div class="jumbotron">
    <div class="de">
      <h1>順位予想</h1>
       <table>
        <!-- 解説者 -->
        <tr>
            <th>解説者名</th>
            <td><?= $row["commentator"] ?></td>
        </tr>
        <!-- 画像 -->
        <tr>
            <th><label for="image">画像：</label></th>
            <td><img width="100" src="upload/<?= $row["image"] ?>"></td>
        </tr>
        <!-- 掲載・放送日 -->
        <tr>
            <th>掲載・放送日</th>
            <td><?= $row["indate"] ?></td>
        </tr>
        <!-- 出所 -->
        <tr>
            <th>出所</th>
            <td><?= $row["source"] ?></td>
        </tr>
        <!-- リーグを選択 -->
        <tr>
            <th>予想するリーグ</th>
            <td><?= $leagueView ?></td>
        </tr>
        <!-- 1位（リーグ選択の項目によって変化）-->
        <tr>
            <th>優勝</th>
            <td><?= $row["first"] ?></td>
        </tr>
        <!-- 2位（リーグ選択の項目によって変化）-->
        <tr>
            <th>2位</th>
            <td><?= $row["second"] ?></td>
        </tr>
        <!-- 3位（リーグ選択の項目によって変化）-->
        <tr>
            <th>3位</th>
            <td><?= $row["third"] ?></td>
        </tr>
        <!-- 4位（リーグ選択の項目によって変化）-->
        <tr>
            <th>4位</th>
            <td><?= $row["fourth"] ?></td>
        </tr>
        <!-- 5位（リーグ選択の項目によって変化）-->
        <tr>
            <th>5位</th>
            <td><?= $row["fifth"] ?></td>
        </tr>
        <!-- 6位（リーグ選択の項目によって変化）-->
        <tr>
            <th>6位</th>
            <td><?= $row["sixth"] ?></td>
        </tr>
        <!-- 備考 -->
        <tr>
            <th>持論</th>
            <td><?=$row["remarks"]?></td>
        </tr>
       </table>
    </div>
</div>
<!-- Main[End] -->

</body>
</html>