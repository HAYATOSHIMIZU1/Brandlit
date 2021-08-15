<?php
session_start();
require_once(ROOT_PATH .'Controllers/Controller.php');
$userName = $_SESSION['user']['name'];

$update = new Controller();
$result = $update->newRecord();

if($result == true){
  $text = '記事の投稿を完了しました。<br>引き続き当サイトをご活用ください。';
  $root = 'mypage';
  $text2 = 'マイページへ';
} else {
  $text = 'エラー：記事の投稿に失敗しました。<br>投稿画面に戻ってやり直してください。';
  $root = 'article_up';
  $text2 = '投稿ページへ';
}
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="/css/style.css">
  <title>投稿完了ページ</title>
  <script src="js/jquery-3.6.0.min.js"></script>
</head>
<body>
<div id="wrapper">
  <?php require_once(ROOT_PATH .'Views/header1.php');?>
  <div class="comptext">
    <p><?php echo $text;?></p>
  </div>
  <div id="link">
    <p><a href="<?php echo $root;?>.php"><?php echo $text2;?></a></p>
    <p><a href="main.php">メインページへ</a></p>
  </div>
  <?php require_once(ROOT_PATH .'Views/footer.php');?>
</div>
</body>
</html>
