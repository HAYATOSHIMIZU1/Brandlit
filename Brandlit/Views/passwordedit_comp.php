<?php
session_start();
require_once(ROOT_PATH .'Models/User.php');

$arr = [];
$arr[] = $_POST['password'];
$arr[] = $_POST['email'];

$user = new UserLogic();
$result = $user->password_edit($arr);
$text = "パスワードの変更が完了しました。ログイン画面よりログインしてください。";
if( $result === false){
  $text = "エラー：パスワードが変更できませんでした。もう一度やり直してください。";
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="/css/style.css">
  <title>パスワード完了ページ</title>
  <script src="js/jquery-3.5.1.min.js"></script>
</head>
<body>
<div id="wrapper">
  <?php require_once(ROOT_PATH .'Views/header2.php');?>
  <div class="comptext">
    <p><?php echo $text;?></p>
  </div>
  <div id="link">
    <p><a href="index.php">ログイン画面</a></p>
  </div>
  <?php require_once(ROOT_PATH .'Views/footer.php');?>
</div>
</body>
</html>
