<?php
session_start();
require_once(ROOT_PATH .'/Models/User.php');

$userID = $_SESSION['user']['id'];
$user = new UserLogic();
$result = $user->deleteUser($userID);

if($result <= 1){
  $text = "ご利用ありがとうございました。";
  $root = "index";
  $text2 = "TOPへ戻る";
} else if($result > 1) {
  $text = "エラー：削除できませんでした。もう一度やり直してください。";
  $root = "mypage";
  $text2 = "マイページに戻る";
}

 ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="/css/style.css">
  <title>削除完了ページ</title>
  <script src="js/jquery-3.6.0.min.js"></script>
</head>
<body>
<div id="wrapper">
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
