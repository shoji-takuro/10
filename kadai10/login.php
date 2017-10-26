<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<link rel="stylesheet" href="css/main.css" />
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>
    div{padding: 10px;font-size:16px;}
    .login {
        text-align: center;
        margin: 70px auto;
    }
    .btn {
        background: #3b5998;
        color: #fff;
        width: 200px;
        padding: 5px;
        border-radius: 5px;
        text-decoration: none;
        display: inline-block;
    }
    .btn:hover {
        opacity: 0.8;
    }
</style>
<title>ログイン</title>
</head>
<body>

<header>
  <nav class="navbar navbar-default">LOGIN</nav>
</header>

<!-- lLOGINogin_act.php は認証処理用のPHPです。 -->
<form name="form1" action="login_act.php" method="post" class="login">
ID:<input type="text" name="lid" />
PW:<input type="password" name="lpw" />
<input type="submit" value="LOGIN" />
</form>
<div class="login">
  <a href="fb-login.php" class="btn">Facebook Login</a>
</div>


</body>
</html>