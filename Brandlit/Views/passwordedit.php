<?php
session_start();
require_once(ROOT_PATH .'Models/User.php');
$user = new UserLogic();
$arr = [];
$arr[] = $_POST['name'];
$arr[] = $_POST['email'];
$ninsyou = $user->usercheck($arr);

if($ninsyou === false) {
  $_SESSION['ninsyouerr'] = "エラーが起きました。やり直してください。";
  header('Location: varification.php');
}
if($ninsyou === 1){

} else if($ninsyou === 0) {
  $_SESSION['ninsyouerr'] = "名前・IDが一致するデータが存在しません。";
  header('Location: varification.php');
}

if( isset($_SESSION['err']) ){
  $err = 1;
} else {
  $err = 2;
}

 ?>
 <!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="/css/style.css">
  <title>パスワード変更ページ</title>
  <script src="js/jquery-3.6.0.min.js"></script>
</head>
<body>
<div id="wrapper">
  <?php require_once(ROOT_PATH .'Views/header2.php');?>
  <div id="form">
    <form action="passwordedit_comp.php" method="post" id="edit">
      <div class="formwrapper">
        <p>Password</p>
        <input type="password" name="password" size="12" pattern="^[0-9A-Za-z]+$" minlength="8" maxlength="12" class="in" id="pass" required>
        <p id="none3" class="red">※半角英数字で8～12文字で入力してください</p>
        <p>Password(確認用)</p>
        <input type="password" size="12" pattern="^[0-9A-Za-z]+$" minlength="8" maxlength="12" class="in" id="pass2" required>
        <p id="none4" class="red">※確認用パスワードが一致しません。同じパスワードを入力してください。</p>
        <input type="hidden" name="email" value="<?= $_POST['email']; ?>">
        <div class="inlineB"><input type="submit" value="変更" class="btn"></div>
      </div>
    </form>
  </div>
  <?php require_once(ROOT_PATH .'Views/footer.php');?>
</div>
<script type="text/javascript">
  $(function(){
      $('#edit').submit(function(){
        var pass_val = $('#pass').val();
        var pass2_val = $('#pass2').val();

        if( pass_val === "" || ( pass_val.match(/^[a-zA-Z0-9]+$/) != pass_val )){
          $('#none3').css('display','block');
          $(".popup").css('opacity','0');
          $(".formwrapper").css('pointer-events','auto');
          return false;
        } else {
            $('#none3').css('display','none');
          }
        if(pass_val != pass2_val){
          $('#none4').css('display','block');
          $(".popup").css('opacity','0');
          $(".formwrapper").css('pointer-events','auto');
          return false;
        } else {
          $('#none4').css('display','none');
        }
    });
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
