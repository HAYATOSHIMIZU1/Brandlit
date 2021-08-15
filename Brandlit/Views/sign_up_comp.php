<?php
session_start();
require_once(ROOT_PATH .'Models/User.php');

$email = $_POST['email'];
$password = $_POST['password'];
$userName = $_POST['name'];
$user = new UserLogic();
$params = $user->check($email);
if( $params['count'] > 0 ){
  $_SESSION['err'] = 'true';
  //$text = $params['count'];
  header('Location: sign_up.php');
}

$hascreated = $user->createUser($_POST);

if(!$hascreated){
    $err[] = '登録に失敗しました';
}

$_SESSION['user'] = $user->getUserByEmail($email);


 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="/css/style.css">
  <title>新規登録完了ページ</title>
  <script src="js/jquery-3.6.0.min.js"></script>
</head>
<body>
<div id="wrapper">
  <?php require_once(ROOT_PATH .'Views/header1.php');?>
  <div class="comptext">
    <p>ユーザー登録を完了しました。<br>ようこそ！<?php echo $userName;?>様！</p>
  </div>
  <div id="link">
    <p><a href="mypage.php">マイページへ</a></p>
    <p><a href="main.php">メインページへ</a></p>
  </div>
  <?php require_once(ROOT_PATH .'Views/footer.php');?>
</div>
</body>
</html>
