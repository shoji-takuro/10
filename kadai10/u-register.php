<?php
session_start();

//0.外部ファイル読み込み
include("functions.php");
include("header.php");
ssidChk();
flgChk();

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

<!-- Head[Start] -->
<?= $header ?>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="u-insert.php">
  <div class="jumbotron">
   <fieldset>
    <legend>ユーザー登録</legend>
    <table>
        <tr>
            <th><label for="name">名前</label></th>
            <td><input type="text" name="name" id="name"></td>
        </tr>
        <tr>
            <th><label for="lid">ユーザーID<br>(半角英数字のみ)</label></th>
            <td><input type="text" name="lid" pattern="^[0-9A-Za-z]+$" id="lid"></td>
        </tr>
        <tr>
            <th><label for="lpw">パスワード<br>(半角英数字のみ)</label></th>
            <td><input type="password" name="lpw" pattern="^[0-9A-Za-z]+$" id="lpw"></td>
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
                <input type="radio" id="life1" name="life" value="1"><label for="life1">スーパー管理者</label>
            </td>
        </tr>
    </table>
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
