<?php
session_start();

//0.外部ファイル読み込み
include("functions.php");
include("header.php");
ssidChk();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>プロ野球順位予想</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
  <script src="./ckeditor/ckeditor.js"></script>
</head>
<body onLoad="changeForm()"><!-- onLoadでページの読み込み完了時にfunctionNameを
実行 -->
<!-- Head[Start] -->
<?= $header ?>
<!-- Head[End] -->


<!-- Main[Start] -->
<form name="teamRank" method="post" action="insert.php" id="team-rank" enctype="multipart/form-data">
  <div class="jumbotron">
    <fieldset>
      <legend>順位予想</legend>
        <table>
           <!-- 解説者 -->
            <tr>
                <th><label for="commentator">解説者名</label></th>
                <td><input type="text" name="commentator" id="commentator"></td>
            </tr>
            <!-- 画像 -->
            <tr>
                <th><label for="image">画像：</label></th>
                <td><input type="file" name="upfile" id="image"></td>
            </tr>
            <!-- 掲載・放送日 -->
            <tr>
                <th><label for="date">掲載・放送日</label></th>
                <td><input type="date" name="date" id="date"></td>
            </tr>
            <!-- 出所 -->
            <tr>
                <th><label for="source">出所</label></th>
                <td><input type="text" name="source" id="source"></td>
            </tr>
            <!-- リーグを選択 -->
            <tr>
                <th><label for="lea">予想するリーグ</label></th>
                <td>
                    <select id="lea" name = "selectLeague" onChange="changeForm()">
                      <option value = "central">セ・リーグ</option>
                      <option value = "pacific">パ・リーグ</option>
                    </select>
                </td>
            </tr>
            <!-- 1位（リーグ選択の項目によって変化）-->
            <tr>
                <th><label for="one">優勝</label></th>
                <td><select id="one" name = "first"></select></td>
            </tr>
            <!-- 2位（リーグ選択の項目によって変化）-->
            <tr>
                <th><label for="two">2位</label></th>
                <td><select id="two" name = "second"></select></td>
            </tr>
            <!-- 3位（リーグ選択の項目によって変化）-->
            <tr>
                <th><label for="three">3位</label></th>
                <td><select id="three" name = "third"></select></td>
            </tr>
            <!-- 4位（リーグ選択の項目によって変化）-->
            <tr>
                <th><label for="four">4位</label></th>
                <td><select id="four" name = "fourth"></select></td>
            </tr>
            <!-- 5位（リーグ選択の項目によって変化）-->
            <tr>
                <th><label for="five">5位</label></th>
                <td><select id="five" name = "fifth"></select></td>
            </tr>
            <!-- 6位（リーグ選択の項目によって変化）-->
            <tr>
                <th><label for="six">6位</label></th>
                <td><select id="six" name = "sixth"></select></td>
            </tr>
            <!-- 備考 -->
            <tr>
                <th><label for="remarks">持論</label></th>
                <td>
                    <textarea name="remarks" id="remarks" rows="4" cols="40"></textarea>
                    <script>CKEDITOR.replace('remarks', {
                        // ツールバーに配置するボタンの種類を指定
                        toolbar: [
                          ["Link", "Unlink"],  // リンク
                          ["Bold", "Underline", "Strike"],               // 太字、打ち消し線
                          ["code"],                                      // 強調表示
                        ],
                      });
                    </script>
                </td>
            </tr>
        </table>
        <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->

<script>

function changeForm(){
    var league = document.forms.teamRank.selectLeague; //リーグ選択
    var first = document.forms.teamRank.first; //1位
    var second = document.forms.teamRank.second; //2位
    var third = document.forms.teamRank.third; //3位
    var fourth = document.forms.teamRank.fourth; //4位
    var fifth = document.forms.teamRank.fifth; //5位
    var sixth = document.forms.teamRank.sixth; //6位

    first.options.length = 0; // 選択肢の数がそれぞれに異なる場合は、これが重要になってくる
    second.options.length = 0;
    third.options.length = 0;
    fourth.options.length = 0;
    fifth.options.length = 0;
    sixth.options.length = 0;

    //セ・リーグ
    if (league.options[league.selectedIndex].value == "central"){
        
        //項目変更 1位
        first.options[0] = new Option("広島","広島",true,true);
        first.options[1] = new Option("巨人","巨人");
        first.options[2] = new Option("DeNA","DeNA");
        first.options[3] = new Option("阪神","阪神");
        first.options[4] = new Option("ヤクルト","ヤクルト");
        first.options[5] = new Option("中日","中日");
        
        //項目変更 2位
        second.options[0] = new Option("広島","広島");
        second.options[1] = new Option("巨人", "巨人", true, true);
        second.options[2] = new Option("DeNA","DeNA");
        second.options[3] = new Option("阪神","阪神");
        second.options[4] = new Option("ヤクルト","ヤクルト");
        second.options[5] = new Option("中日","中日");
        
        //項目変更 3位
        third.options[0] = new Option("広島","広島");
        third.options[1] = new Option("巨人","巨人");
        third.options[2] = new Option("DeNA", "DeNA", true, true);
        third.options[3] = new Option("阪神","阪神");
        third.options[4] = new Option("ヤクルト","ヤクルト");
        third.options[5] = new Option("中日","中日");
        
        //項目変更 4位
        fourth.options[0] = new Option("広島","広島");
        fourth.options[1] = new Option("巨人","巨人");
        fourth.options[2] = new Option("DeNA","DeNA");
        fourth.options[3] = new Option("阪神", "阪神", true, true);
        fourth.options[4] = new Option("ヤクルト","ヤクルト");
        fourth.options[5] = new Option("中日","中日");
        
        //項目変更 5位
        fifth.options[0] = new Option("広島","広島");
        fifth.options[1] = new Option("巨人","巨人");
        fifth.options[2] = new Option("DeNA","DeNA");
        fifth.options[3] = new Option("阪神","阪神");
        fifth.options[4] = new Option("ヤクルト", "ヤクルト", true, true);
        fifth.options[5] = new Option("中日","中日");
        
        //項目変更 6位
        sixth.options[0] = new Option("広島","広島");
        sixth.options[1] = new Option("巨人","巨人");
        sixth.options[2] = new Option("DeNA","DeNA");
        sixth.options[3] = new Option("阪神","阪神");
        sixth.options[4] = new Option("ヤクルト","ヤクルト");
        sixth.options[5] = new Option("中日", "中日", true, true);
    }

    else if (league.options[league.selectedIndex].value == "pacific"){
        
        //項目変更 1位
        first.options[0] = new Option("日ハム","日ハム", true, true);
        first.options[1] = new Option("ソフトバンク","ソフトバンク");
        first.options[2] = new Option("ロッテ","ロッテ");
        first.options[3] = new Option("西武","西武");
        first.options[4] = new Option("楽天","楽天");
        first.options[5] = new Option("オリックス","オリックス");
        
        //項目変更 2位
        second.options[0] = new Option("日ハム","日ハム");
        second.options[1] = new Option("ソフトバンク", "ソフトバンク", true, true);
        second.options[2] = new Option("ロッテ","ロッテ");
        second.options[3] = new Option("西武","西武");
        second.options[4] = new Option("楽天","楽天");
        second.options[5] = new Option("オリックス","オリックス");
        
        //項目変更 3位
        third.options[0] = new Option("日ハム","日ハム");
        third.options[1] = new Option("ソフトバンク","ソフトバンク");
        third.options[2] = new Option("ロッテ", "ロッテ", true, true);
        third.options[3] = new Option("西武","西武");
        third.options[4] = new Option("楽天","楽天");
        third.options[5] = new Option("オリックス","オリックス");
        
        //項目変更 4位
        fourth.options[0] = new Option("日ハム","日ハム");
        fourth.options[1] = new Option("ソフトバンク","ソフトバンク");
        fourth.options[2] = new Option("ロッテ","ロッテ");
        fourth.options[3] = new Option("西武", "西武", true, true);
        fourth.options[4] = new Option("楽天","楽天");
        fourth.options[5] = new Option("オリックス","オリックス");
        
        //項目変更 5位
        fifth.options[0] = new Option("日ハム","日ハム");
        fifth.options[1] = new Option("ソフトバンク","ソフトバンク");
        fifth.options[2] = new Option("ロッテ","ロッテ");
        fifth.options[3] = new Option("西武","西武");
        fifth.options[4] = new Option("楽天", "楽天", true, true);
        fifth.options[5] = new Option("オリックス","オリックス");
        
        //項目変更 6位
        sixth.options[0] = new Option("日ハム","日ハム");
        sixth.options[1] = new Option("ソフトバンク","ソフトバンク");
        sixth.options[2] = new Option("ロッテ","ロッテ");
        sixth.options[3] = new Option("西武","西武");
        sixth.options[4] = new Option("楽天","楽天");
        sixth.options[5] = new Option("オリックス", "オリックス", true, true);
    }
}

</script>
</body>
</html>
