<?php
session_start();
$userName = $_SESSION['user']['name'];
$userID = $_SESSION['user']['id'];


 ?>
 <!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="/css/style.css">
  <title>投稿ページ</title>
  <script src="js/jquery-3.6.0.min.js"></script>
</head>
<body>
<div id="wrapper" class="bg">
  <?php require_once(ROOT_PATH .'Views/header1.php');?>
  <div id="form">
    <form action="article_up_comp.php" method="post" id="article">
      <div class="formwrapper">
        <p>CATEGORY</p>
        <select name="category" class="kadomaru" required>
          <option value="">カテゴリー選択</option>
          <option value="11">全て</option>
          <option value="1">20代(男性)</option>
          <option value="2">20代(女性)</option>
          <option value="3">30代(男性)</option>
          <option value="4">30代(女性)</option>
          <option value="5">40代以上(男性)</option>
          <option value="6">40代以上(女性)</option>
        </select>
        <p>BrandName</p>
        <input type="text" name="title" size="20" class="in" required id="title">
        <p>COMMENT</p>
        <textarea size="50" name="comment" cols="50" rows="10" required></textarea>
        <p>URL</p>
        <input type="text" name="siteURL" size="20" class="in" id="siteURL">
        <input type="button" value="確認" class="btn" id="open">
      </div>
      <div class="popup">
        <p>上記の内容で投稿してよろしいですか？</p>
        <input type="hidden" name="id" value="<?php echo $userID;?>">
        <div class="inlineB"><input type="submit" value="投稿する" class="btn"></div>
        <div class="inlineB"><input type="button" value="戻る" class="btn" id="close"></div>
      </div>
    </form>
  </div>
  <? require_once(ROOT_PATH .'Views/footer.php');?>
</div>
<script type="text/javascript">
  $(function(){

    $("#open").on("click", function() {
      $(".popup").css('opacity','1').fadeIn();
      $(".formwrapper").css('pointer-events','none');
    });

    $("#close").on("click", function() {
      $(".popup").css('opacity','0');
      $(".formwrapper").css('pointer-events','auto');
    });

  });

</script>
</body>
</html>
