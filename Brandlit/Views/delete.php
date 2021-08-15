<?php
session_start();
$userName = $_SESSION['user']['name'];
$userEmail = $_SESSION['user']['email'];
$userID = $_SESSION['user']['id'];

 ?>
 <!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="/css/style.css">
  <title>削除ページ</title>
  <script src="js/jquery-3.6.0.min.js"></script>
</head>
<body>
<div id="wrapper">
  <?php require_once(ROOT_PATH .'Views/header1.php');?>
  <div id="form">
    <form action="delete_comp.php" method="post" id="delete">
      <div class="formwrapper">
        <p class="delp">Name:<?php echo $userName;?></p>
        <p class="delp">Email(ID):<?php  echo $userEmail;?></p>
        <p class="delp">上記のアカウントを削除してよろしいですか？</p>
        <input type="hidden" name="id" value="<?php $userID;?>" class="in" id="id">
        <input type="submit" value="削除する" class="btn">
        <p id="user"><a href="mypage.php">マイページに戻る</a>
      </div>
    </form>
  </div>
  <?php require_once(ROOT_PATH .'Views/footer.php');?>
</div>
<script type="text/javascript">
</script>
</body>
</html>
