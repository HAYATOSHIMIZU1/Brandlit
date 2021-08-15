<?php
session_start();

$login_err = isset($_SESSION['login_err']) ? $_SESSION['login_err']: null;

$_SESSION = array();//sessionの中身の配列を消す
session_destroy();//セッションファイルを消す

 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="/css/style.css">
  <title>ログインページ</title>
  <script src="js/jquery-3.6.0.min.js"></script>
</head>
<body>
<div id="wrapper">
  <?php require_once(ROOT_PATH .'Views/header2.php');?>
  <div id="form">
    <form action="main.php" method="post" id="login">
      <div class="formwrapper">
        <p>ID(Emailアドレス)</p>
        <input type="email" name="email" size="50" value="" class="in" id="logID" required>
        <p id="none4" class="red">※@形式でIDを入力してください。</p>
        <p id="none00" class="red"><?php echo $login_err;?></p>
        <p>Password</p>
        <input type="password" name="password" size="50" value="" pattern="^[0-9A-Za-z]+$" minlength="8" maxlength="12"  class="in" id="pass" required>
        <p id="none5" class="red">※半角英数字の8～12文字でパスワードを入力してください。</p>
        <input type="submit" value="ログイン" class="btn">
      </div>
    </form>
  </div>
  <div id="link">
    <p><a href="sign_up.php">新規登録</a></p>
    <p><a href="varification.php">パスワードを忘れた方はこちら</a></p>
    <p><a href="main.php">非会員の方はこちら</a></p>
  </div>
  <?php require_once(ROOT_PATH .'Views/footer.php');?>
</div>
<script type="text/javascript">

  $(function(){
      $('#login').submit(function(){
        var count = 0;
        var logID_val = $('#logID').val();
        var pass_val = $('#pass').val();

        if( logID_val === "" || ( logID_val.match(/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/) != logID_val )){
          $('#none4').css('display','block');
          $(".popup").css('opacity','0');
          $(".formwrapper").css('pointer-events','auto');
          return false;
        }
        else{
          $('#none4').css('display','none');
        }
        if( pass_val === "" || ( pass_val.match(/^[a-zA-Z0-9]+$/) != pass_val)){
          $('#none5').css('display','block');
          $(".popup").css('opacity','0');
          $(".formwrapper").css('pointer-events','auto');
          return false;
        }
        else{
          $('#none5').css('display','none');
        }
    });

  });

</script>
</body>
</html>
