<?php
session_start();
require_once(ROOT_PATH .'Models/User.php');

$user = new UserLogic();
$email = $_POST['email'];
$password = $_POST['password'];
$userName = $_POST['name'];
$user = new UserLogic();
$params = $user->check($email);
if( $params['count'] > 0 ){
  $_SESSION['err'] = 'true';
  header('Location: sign_up.php');
}

$result = $user->updateUser($_POST);

if($result <= 1){
  $text = "プロフィールの編集を完了しました。<br>引き続き当サイトをご活用ください。";
  $root = "mypage";
  $text2 = "マイページへ";
} else if($result > 1) {
  $text = "エラー：プロフィールの編集ができませんでした。もう一度やり直してください。";
  $root = "edit";
  $text2 = "編集ページへ戻る";
}

$_SESSION['user'] = $user->getUserByEmail($email);

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="/css/style.css">
  <title>編集完了ページ</title>
  <script src="js/jquery-3.6.0.min.js"></script>
</head>
<body>
<div id="wrapper">
  <?php require_once(ROOT_PATH .'Views/header2.php');?>
  <div class="comptext">
    <p><?php echo $text;?></p>
  </div>
  <div id="link">
    <p><a href="<?php echo $root;?>.php"><?php echo $text2;?></a></p>
  </div>
  <?php require_once(ROOT_PATH .'Views/footer.php');?>
</div>
</body>
</html>
